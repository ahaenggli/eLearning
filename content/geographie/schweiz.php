<?php

$inhalt = "";
$file = './';


$title = "Europa > Schweiz > Kantone, Hauptorte, Autokennzeichen &amp; Wappen";
$vars ="Aargau|AG|Aarau|215|60|0
Appenzell Ausserrhoden|AR|Herisau|320|73|1
Appenzell Innerrhoden|AI|Appenzell|335|84|2
Basel-Land|BL|Liestal|180|65|3
Basel-Stadt|BS|Basel|165|35|4
Bern|BE|Bern|165|150|5
Freiburg[]Fribourg|FR|Freiburg[]Fribourg|110|170|6
Genf|GE|Genf|10|240|7
Glarus|GL|Glarus|300|125|8
Graubünden|GR|Chur|330|170|9
Jura|JU|Delsberg[]Delémont|120|75|10
Luzern|LU|Luzern|205|110|11
Neuenburg|NE|Neuenburg|80|125|12
Nidwalden|NW|Stans|240|135|13
Obwalden|OW|Sarnen|220|145|14
St. Gallen|SG|St. Gallen|330|100|15
Schaffhausen|SH|Schaffhausen|255|20|16
Schwyz|SZ|Schwyz|270|120|17
Solothurn|SO|Solothurn|152|95|18
Thurgau|TG|Frauenfeld|295|45|19
Tessin|TI|Bellinzona|280|220|20
Uri|UR|Altdorf|258|160|21
Waadt[]Vaud|VD|Lausanne|65|175|22
Wallis|VS|Sion|150|250|23
Zug|ZG|Zug|254|105|24
Zürich|ZH|Zürich|255|70|25"; 
$array = explode("\n", ($vars));  

$select = '<ul id="numeric" style="list-style:none;">';


$ui=0;
$wap = array();
$wap[]='--';
foreach($array as $aa){$ab = explode('|', $aa); $s = ($ui==0)?'':'';$ui++;
$select.='<li ID="'.$ab[1].'"><img style="border: 1px solid #204407;" src="'.Project::PageRoot."/content/geographie".'/wappen/'.strtolower($ab[1]).'.gif" alt="??"></li>';
$wap[] = strtolower($ab[1]);
}
$select.='</ul>';


if(!isset($_POST['geo'])){ $_POST['submit']='123456789';}

if(isset($_POST['submit']))
{
shuffle($array);shuffle($array);
$bild = Project::PageRoot."/content/geographie/img.php?img=ch&amp;cord=";
$i=1;
$ida="";

foreach ($array as $ar)
{
$row = explode('|', $ar);
$bild.=$i.':'.$row[3].':'.$row[4].'|';
$ida.='|'.($row[5]);
$i++;
}

eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_img.tpl", __DIR__)."\";");
eval("\$inhalt .=\"".tpl::gettemplate("./tpl/ch_hs.tpl", __DIR__)."\";");
$foreach = explode('|', $ida);$i=0;

foreach($foreach as $id){ $id = trim($id);
if(is_numeric($id)){ eval("\$inhalt .=\"".tpl::gettemplate("./tpl/ch_hs_form.tpl", __DIR__)."\";");}
$i++;
}
$_SESSION['geo']= $bild;

eval("\$inhalt .=\"".tpl::gettemplate("./tpl/ch_hs_form_end.tpl", __DIR__)."\";");
}





 if(isset($_POST['submit2']))
 {
  $bild = str_replace('&', '&amp;', $_POST['geo']);
eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_img.tpl", __DIR__)."\";");
eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_loes.tpl", __DIR__)."\";");

 $angabe= $_POST['angabe'];
 @$stadt = $_POST['stadt'];
@$kz = $_POST['kz'];
@$wa = $_POST['wappen'];
 $nr    = '1';
 $id = $_POST['id'];
 $richtig=0;
 $falsch=0; // Falsch geschriebene
 $fragen=0;
//$wa = explode('|', $wa);
function getz($array, $was){$i=0;
  foreach($array as $ar){
  $ex = explode('|', $ar);
   if(trim($ex[5])==$was) return $i;
   $i++;
  }
}

for ($i=0; $i<count($id); $i++)
{
$nnn = $i;
$loesung = "";
$row = explode('|', $array[getz($array, $id[$i])]);


if($_POST['mool']=='0'){
$row[0] = explode('[]', $row[0]);
$row[0]=$row[0][0];
$loesung = $row[0];
$fragen++;
if($angabe[$i]=='') $angabe[$i]='---';

similar_text($angabe[$i], $row[0], $similiar);
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

if($_POST['moos']=='0' AND $_POST['mool']=='0') {$loesung = $loesung.' / ';}

if($_POST['moos']=='0')
{

$row[2] = explode('[]', $row[2]);
$l2 = @$row[2][1];
$row[2] = $row[2][0];
//$loesung = $row[0];

$fragen++;
if($stadt[$i]=='')$stadt[$i]='---';

similar_text($stadt[$i], $row[2], $ProzentualeAehnlichkeit);
$ueb=number_format($ProzentualeAehnlichkeit, 2, ",", ".");
similar_text($stadt[$i], $l2, $ProzentualeAehnlichkeit);
$ueb2=number_format($ProzentualeAehnlichkeit, 2, ",", ".");

if($ueb > 60 OR $ueb2 > 60 )
{
$richtig++;
  if($ueb == 100 OR $ueb2 == 100){$colorb ="green";}
    else {$colorb = "blue"; $falsch++;}
   }
 else
 {
 $colorb = "red";
 }
$stadt[$i] = ($_POST['mool']=='0')?" "."<span style=\"color:grey\">/</span> ".$stadt[$i]: " ".$stadt[$i];
$loesung = $loesung.$row[2];

}

if($_POST['mook']=='0') {$loesung = $loesung.' / ';}

if($_POST['mook']=='0')
{
$fragen++;
if($kz[$i]=='')$kz[$i]='--';

if($kz[$i] == $row[1])
{
$richtig++;
$colorc ="green";
}
 else
 {
 $colorc = "red";
 }
$kz[$i] = ($_POST['mook']=='0')?" "."<span style=\"color:grey\">/</span> ".$kz[$i]: " ".$kz[$i];
$loesung = $loesung.$row[1];

}

if($_POST['moow']=='0') {$loesung = $loesung.'';}

if($_POST['moow']=='0')
{
$fragen++;
if($wa[$i]=='') $wa[$i]='---';

if($wa[$i] == $row[1])
{
$richtig++;
$colord ="green";
}
 else
 {
 $colord = "red";
 }
$wa[$i] = ($_POST['moow']=='0')?" "."<img src=\"".Project::PageRoot."/content/geographie"."/wappen/".strtolower($wa[$i]).'.gif" alt="'.$wa[$i].'"> ': " ";
$loesung = '<img src="'.Project::PageRoot."/content/geographie".'/wappen/'.strtolower($row[1]).'.gif" alt="'.strtolower($row[1]).'"> '.$loesung;

}else $wa[$i]='';

if(!isset($colora))$colora = "grey";
if(!isset($colorb))$colorb = "grey";
if(!isset($colorc))$colorc = "grey";

eval("\$inhalt .=\"".tpl::gettemplate("./tpl/ch_loesung.tpl", __DIR__)."\";");
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
eval("\$inhalt .=\"".tpl::gettemplate("./tpl/geo_ende.tpl", __DIR__)."\";");
}


   ?>
