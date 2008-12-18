<?php
$inhalt ="";
$title = "Afrika > Fl&uuml;sse &amp; Seen";
$file = "";
$db = new SQLite3(__DIR__.'/GeoData.db3');

if(!isset($_POST['submit2']) && !isset($_POST['submit'])) $_POST['submit']='123456789';

if(isset($_POST['submit']))
{
$res = $db->query('SELECT `id`, `left`, `top` FROM geo WHERE typ="10" ORDER BY RANDOM();');

$bild = Project::PageRoot."/content/geographie/img.php?img=africafluesse&amp;cord=";
$i=1;
$ida="";
while($row = $res->fetchArray())
{
$bild.=$i.':'.($row['left']).':'.($row['top']).'|';
$ida.='|'.$row['id'];
$i++;
}
eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_img.tpl",__DIR__)."\";");
eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_neutral.tpl",__DIR__)."\";");
$foreach = explode('|', $ida);$i=0;
foreach($foreach as $id){
if(is_numeric($id)){ eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_neutral_form.tpl",__DIR__)."\";");}
$i++;
}
$_SESSION['geo']= $bild;
eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_neutral_form_end.tpl",__DIR__)."\";");
}





 if(isset($_POST['submit2']))
 {
 $bild = $_SESSION['geo'];
eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_img.tpl",__DIR__)."\";");
eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_loes.tpl",__DIR__)."\";");

 $angabe= $_POST['angabe'];
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
if(!isset($colora))$colora = "grey";
if(!isset($colorb))$colorb = "grey";
$stadt[$i]=null;
eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_loesung.tpl",__DIR__)."\";");
$nr++;
}
$note = ((5/$fragen)*$richtig)+1;
$gg = explode('.', $note);
$vrtl = $note-$gg[0];
if($vrtl>=0.875) $note = $gg[0]+1;
elseif($vrtl>=0.625) $note = $gg[0]+0.75;
elseif($vrtl>=0.375)$note = $gg[0]+0.5;
elseif($vrtl>=0.125)$note = $gg[0]+0.25;
else $note = $gg[0];
if ($fragen-1 == $richtig) $note = $gg[0]+0.75;
eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_ende.tpl",__DIR__)."\";");
}
   $db->close();
?>