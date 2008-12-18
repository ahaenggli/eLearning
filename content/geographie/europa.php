<?php

$file = "";
$db = new SQLite3(__DIR__.'/GeoData.db3');

$title = "Europa > ";
$_POST['lernen']=0;
switch($_GET['europe']){
case 'laender':  
               $_GET['lernen'] = 1;
			   $title.='L&auml;nder &amp; Hauptst&auml;dte';
               break;
case 'stroeme':  
               $_GET['lernen'] = 2;
			   $title.='Str&ouml;me';
               break;
case 'gebirge':  
               $_GET['lernen'] = 3;
			   $title.='Gebirge';
               break;
case 'meerengen':  
               $_GET['lernen'] = 4;
			   $title.='Meerengen';
               break;
case 'inseln':  
               $_GET['lernen'] = 5;
			   $title.='(Halb-)Inseln';
               break;
case 'meere':  
               $_GET['lernen'] = 6;
			   $title.='Meere';
               break;
}


if(isset($_POST['submit'])OR(isset($_GET['lernen'])AND is_numeric($_GET['lernen']))AND!isset($_POST['submit2']))
{

if(!is_numeric($_POST['lernen'])) $_POST['lernen']=1;
$_POST['lernen'] = (isset($_GET['lernen'])AND is_numeric($_GET['lernen']))? $_GET['lernen']:$_POST['lernen'];
$res = $db->query('SELECT `id`, `left`, `top` FROM geo WHERE typ="'.$_POST['lernen'].'" ORDER BY RANDOM();');

$bild = Project::PageRoot."/content/geographie/img.php?img=europe&amp;cord=";
$i=1;
$ida="";
while($row = $res->fetchArray())
{
$bild.=$i.':'.($row['left']-160).':'.($row['top']-180).'|';
$ida.='|'.$row['id'];
$i++;
}
eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_img.tpl",__DIR__)."\";");

if($_POST['lernen']!='1') eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_neutral.tpl",__DIR__)."\";");
   else eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_land.tpl",__DIR__)."\";");

$foreach = explode('|', $ida);$i=0;
foreach($foreach as $id){
if(is_numeric($id)){ if($_POST['lernen']!='1') eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_neutral_form.tpl",__DIR__)."\";");
   else eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_land_form.tpl",__DIR__)."\";");}
$i++;
}
$_SESSION['geo']= $bild;
if($_POST['lernen']!='1') eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_neutral_form_end.tpl",__DIR__)."\";");
   else eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_land_form_end.tpl",__DIR__)."\";");
}

if(!isset($_POST['submit'])AND!isset($_GET['lernen'])AND!isset($_POST['submit2'])) eval("\$inhalt .=\"".tpl::gettemplate("./tpl/europa_auswahl.tpl",__DIR__)."\";");




 if(isset($_POST['submit2']))
 {
 $bild = $_POST['geo'];
eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_img.tpl",__DIR__)."\";");
eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_loes.tpl",__DIR__)."\";");

 $angabe= $_POST['angabe'];
 @$stadt = $_POST['stadt'];
 $nr    = '1';
 $id = $_POST['id'];
 $richtig=0;
 $falsch=0; // Falsch geschriebene
 $fragen=0;
for ($i=0; $i<=count($id)-1; $i++)
{
$loesung = "";
$res = $db->query( 'SELECT `id`, `name`, `left`, `top`, `typ`, `stadt` FROM geo WHERE id = \''.$id[$i].'\' LIMIT 1;');
$row = $res->fetchArray();

if(!isset($_POST['mool']) || $_POST['mool']=='0'){
$loesung = $row['name'];
$fragen++;
if($angabe[$i]=='')$angabe[$i]='---';

similar_text($angabe[$i], $row['name'], $similiar);
$ueb = number_format($similiar, 2, ",", ".");

if($ueb > 60)
{
  if($ueb == 100){$colora ="green";}
    else{ $colora = "blue"; $falsch++;}

$richtig++;
}else{
$colora = "red";
}
}
//if($row->typ!=1){ $_POST['moos']='1';}


if(isset($_POST['moos']) && isset( $_POST['mool']) && $_POST['moos']=='0' AND $_POST['mool']=='0') {$loesung = $loesung.' / ';}

if(isset($_POST['moos']) && $_POST['moos']=='0')
{
$fragen++;
if($stadt[$i]=='')$stadt[$i]='---';

similar_text($stadt[$i], $row['stadt'], $ProzentualeAehnlichkeit);
$ueb=number_format($ProzentualeAehnlichkeit, 2, ",", ".");

if($ueb > 60)
{
$richtig++;
  if($ueb == 100){$colorb ="green";}
    else {$colorb = "blue"; $falsch++;}
   }
 else
 {
 $colorb = "red";
 }
$stadt[$i] = ($_POST['mool']=='0')?" "."<span style=\"color:grey\">/</span> ".$stadt[$i]: " ".$stadt[$i];
$loesung = $loesung.$row['stadt'];

}
if(!isset($colora))$colora = "grey";
if(!isset($colorb))$colorb = "grey";

eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_loesung.tpl",__DIR__)."\";");
$nr++;

}
$note = ((5/$fragen)*$richtig)+1;
$gg = explode('.', $note);
$vrtl = $note-$gg[0];
if($vrtl>=0.875) $note = $gg[0]+1;
elseif($vrtl>=0.625)$note = $gg[0]+0.75;
elseif($vrtl>=0.375)$note = $gg[0]+0.5;
elseif($vrtl>=0.125)$note = $gg[0]+0.25;
else $note = $gg[0];
if ($fragen-1 == $richtig) $note = $gg[0]+0.75;
eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_ende.tpl",__DIR__)."\";");
}
   $db->close();
?>