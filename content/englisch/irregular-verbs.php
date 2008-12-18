<?php
DEFINE("OK_Grafik", '<img src="'.Project::PageRoot."/content/englisch/ok.png"   .'">');
DEFINE("ER_Grafik", '<img src="'.Project::PageRoot."/content/englisch/cross.png".'">');
$_ANZAHL_VERBEN = 21;

if(isset($_POST['new'])){ unset($_SESSION['verbs']); unset($_POST);  }

$arrVerben = array (
'be|was[]were|been|sein',
'beat|beat|beaten|schlagen',
'become|became|become|werden',
'begin|began|begun|anfangen',
'bend|bent|bent|biegen',
'bet|bet|bet|wetten',
'bite|bit|bitten|beissen',
'blow|blew|blown|blase',
'break|broke|broken|zerbrechen',
'bring|brought|brought|bringen',
'broadcast|broadcast|broadcast|verbreiten',
'build|built|built|bauen',
'burn|burnt|burnt|verbrennen[]brennen',
'burst|burst|burst|bersten',
'buy|bought|bought|kaufen',
'catch|caught|caught|fangen',
'choose|chose|chosen|auswählen',
'come|came|come|kommen',
'cost|cost|cost|kosten',
'creep|crept|crept|kriechen',
'cut|cut|cut|schneiden',
'deal with|dealt with|dealt with|sich befassen',
'dig|dug|dug|graben',
'do|did|done|machen',
'draw|drew|drawn|zeichnen',
'dream|dreamt|dreamt|träumen',
'drink|drank|drunk|trinken',
'drive|drove|driven|fahren',
'eat|ate|eaten|essen',
'fall|fell|fallen|fallen',
'feed|fed|fed|füttern',
'feel|felt|felt|fühlen',
'fight|fought|fought|kämpfen',
'find|found|found|finden',
'flee|fled|fled|fliehen',
'fly|flew|flown|fliegen',
'forbid|forbade|forbidden|verbieten',
'forget|forgot|forgotten|vergessen',
'forgive|forgave|forgiven|vergeben',
'freeze|froze|frozen|gefrieren',
'get|got|got|bekommen[]gelangen',
'give|gave|given|geben',
'go|went|gone|gehen',
'grow|grew|grown|wachsen[]anbauen',
'hang|hung|hung|hängen',
'have|had|had|haben',
'hear|heard|heard|hören',
'hide|hid|hidden|verstecken',
'hit|hit|hit|schlagen',
'hold|held|held|halten',
'hurt|hurt|hurt|verletzen',
'keep|kept|kept|halten',
'kneel|knelt|knelt|knien',
'know|knew|known|wissen',
'lay|laid|laid|legen',
'lead|led|led|führen',
'lean|leant|leant|anlehnen',
'learn|learnt|learnt|lernen',
'leave|left|left|verlassen',
'lend|lent|lent|ausleihen',
'let|let|let|lassen',
'lie|lay|lain|liegen',
'light|lit|lit|anzünden',
'lose|lost|lost|verlieren',
'make|made|made|machen',
'mean|meant|meant|bedeuten',
'meet|met|met|treffen',
'pay|paid|paid|bezahlen',
'put|put|put|stellen[]legen',
'read|read|read|lesen',
'ride|rode|ridden|reiten',
'ring|rang|rung|läuten[]klingeln[]anrufen',
'rise|rose|risen|aufstehen[]sich erheben[]aufgehen',
'run|ran|run|rennen',
'say|said|said|sagen',
'see|saw|seen|sehen',
'seek|sought|sought|suchen',
'sell|sold|sold|verkaufen',
'send|sent|sent|schicken',
'set|set|set|setzen',
'sew|sewed|sewn[]sewed|nähen',
'shake|shook|shaken|schütteln',
'shine|shone|shone|scheinen',
'shoot|shot|shot|erschiessen[]schiessen',
'show|showed|showed[]shown|zeigen',
'shrink|shrank|shrunk|schrumpfen',
'shut|shut|shut|schliessen',
'sing|sang|sung|singen',
'sink|sank|sunk|sinken',
'sit|sat|sat|sitzen',
'sleep|slept|slept|schlafen',
'slide|slid|slid|gleiten[]rutschen',
'smell|smelt|smelt|riechen',
'speak|spoke|spoken|sprechen',
'spell|spelt|spelt|buchstabieren',
'spend|spent|spent|ausgeben',
'spit|spat|spat|spucken',
'split up|split up|split up|aufteilen[]zerreissen',
'spread|spread|spread|ausbreiten',
'spring|sprang|sprung|springen',
'stand|stood|stood|stehen',
'steal|stole|stolen|stehlen',
'stick|stuck|stuck|anheften[]feststecken',
'sting|stung|stung|stechen',
'stink|stank|stunk|stinken',
'strike|struck|struck|schlagen',
'swear|swore|sworn|schwören',
'sweep|swept|swept|wischen[]fegen',
'swim|swam|swum|schwimmen',
'swing|swung|swung|schwingen',
'take|took|taken|nehmen',
'teach|taught|taught|lehren',
'tear|tore|torn|zerreissen',
'tell|told|told|erzählen',
'think|thought|thought|denken',
'throw|threw|thrown|werfen',
'understand|understood|understood|verstehen',
'wake|woke|woken|wecken',
'wear|wore|worn|tragen',
'weep|wept|wept|weinen',
'win|won|won|gewinnen',
'write|wrote|written|schreiben');

if($_ANZAHL_VERBEN > count($arrVerben)) $_ANZAHL_VERBEN = count($arrVerben)-1;

$inhalt = '
(Die komplette Liste ist drin, aber es werden immer nur 20 W&ouml;rter abgefragt) <br> <br> 
<form method="post">
<table style="border-collapse: separate; border-spacing: 0.25em;">
<tr><th>Nr. </th> <th>Infnitive</th> <th>Past simple</th> <th>Past participle</th> <th>German</th> <th></th></tr>';
$r=0;


if(isset($_POST['kor'])){

for($i=1;$i<$_ANZAHL_VERBEN;$i++){

$ex = explode('|', $_SESSION['verbs'][$i-1]);
$ex[0] = explode('[]', ($ex[0]).'[]-[]-');
$ex[1] = explode('[]', ($ex[1]).'[]-[]-');
$ex[2] = explode('[]', ($ex[2]).'[]-[]-');
$ex[3] = explode('[]', ($ex[3]).'[]-[]-');

 $e0 = $ex[0][0];
 $e1 = $ex[1][0];           
 $e2 = $ex[2][0];    
 $e3 = $ex[3][0];
 
if (in_array($_POST['i'][$i] , $ex[0])) $c0='1px solid#00DD00'; 
else $c0='2px solid red';

if (in_array($_POST['ps'][$i] , $ex[1])) $c1='1px solid#00DD00'; 
else $c1='2px solid red';

if (in_array($_POST['pp'][$i] , $ex[2])) $c2='1px solid#00DD00'; 
else $c2='2px solid red';

if (in_array($_POST['ger'][$i] , $ex[3])) $c3='1px solid#00DD00'; 
else $c3='2px solid red';

if (
(in_array($_POST['i'][$i] , $ex[0])) AND 
(in_array($_POST['ps'][$i] , $ex[1])) AND 
(in_array($_POST['pp'][$i] , $ex[2])) AND 
(in_array($_POST['ger'][$i] , $ex[3]))){ $ico = OK_Grafik;$r++;}
else $ico = ER_Grafik;


$inhalt.= '<tr> <th>'.$i.'</th><td>
<input size="18" style="border:'.$c0.';" name="i['.$i.']" type="text" value="'.$_POST['i'][$i].'"></td> <td>
<input size="18" style="border:'.$c1.';" name="ps['.$i.']" type="text" value="'.$_POST['ps'][$i].'"></td><td>
<input size="18" style="border:'.$c2.';" name="pp['.$i.']" type="text" value="'.$_POST['pp'][$i].'"></td><td>
<input size="18" style="border:'.$c3.';" name="ger['.$i.']" type="text" value="'.$_POST['ger'][$i].'"></td> <td>'.$ico.'</td></tr>';

}
$n = round(((5/20)*$r+1)*4)/4;

}       



elseif(isset($_POST['loes'])){


for($i=1;$i<$_ANZAHL_VERBEN;$i++){

$ex = explode('|', $_SESSION['verbs'][$i-1]);
$ex[0] = explode('[]', ($ex[0]).'[]-[]-');
$ex[1] = explode('[]', ($ex[1]).'[]-[]-');
$ex[2] = explode('[]', ($ex[2]).'[]-[]-');
$ex[3] = explode('[]', ($ex[3]).'[]-[]-');

if (in_array($_POST['i'][$i] , $ex[0])){ $e0 = $ex[0][0];$c0='1px solid#00DD00';} else{ $e0 = $ex[0][0];$c0='2px solid red';}
if (in_array($_POST['ps'][$i] , $ex[1])){ $e1 = $ex[1][0];$c1='1px solid#00DD00';} else{ $e1 = $ex[1][0];$c1='2px solid red';}
if (in_array($_POST['pp'][$i] , $ex[2])){ $e2 = $ex[2][0];$c2='1px solid#00DD00';} else {$e2 = $ex[2][0];$c2='2px solid red';}
if (in_array($_POST['ger'][$i] , $ex[3])){ $e3 = $ex[3][0];$c3='1px solid#00DD00';} else {$e3 = $ex[3][0];$c3='2px solid red';}

if (
(in_array($_POST['i'][$i] , $ex[0])) AND 
(in_array($_POST['ps'][$i] , $ex[1])) AND 
(in_array($_POST['pp'][$i] , $ex[2])) AND 
(in_array($_POST['ger'][$i] , $ex[3]))){ $ico = OK_Grafik;$r++;}
else $ico = ER_Grafik;

$inhalt.= '<tr> <td>'.$i.'</td><td>
<input size="18" style="border:'.$c0.';" name="i['.$i.']" type="text" value="'.$e0.'"></td> <td>
<input size="18" style="border:'.$c1.';" name="ps['.$i.']" type="text" value="'.$e1.'"></td><td>
<input size="18" style="border:'.$c2.';" name="pp['.$i.']" type="text" value="'.$e2.'"></td><td>
<input size="18" style="border:'.$c3.';" name="ger['.$i.']" type="text" value="'.$e3.'"></td> <td>'.$ico.'</td></tr>';



}
$n = round(((5/20)*$r+1)*4)/4;

}




else{
$_SESSION['verbs'] =(!isset($_SESSION['verbs']))? $arrVerben:$_SESSION['verbs'];


shuffle($_SESSION['verbs']);


for($i=1;$i<$_ANZAHL_VERBEN;$i++){
$zz = rand(0,3);
$ex = explode('|', $_SESSION['verbs'][$i-1]);
$ex[0] = explode('[]', ($ex[0]).'[]-[]-');
$ex[1] = explode('[]', ($ex[1]).'[]-[]-');
$ex[2] = explode('[]', ($ex[2]).'[]-[]-');
$ex[3] = explode('[]', ($ex[3]).'[]-[]-');


if ($zz == 0){ $e0 = $ex[0][0]; $c0='green';}else{ $e0 = ''; $c0='red';}
if ($zz == 1){ $e1 = $ex[1][0]; $c1='green'; }else{ $e1 = ''; $c1='red';}
if ($zz == 2){ $e2 = $ex[2][0]; $c2='green'; }else{ $e2 = ''; $c2='red';}
if ($zz == 3){ $e3 = $ex[3][0]; $c3='green'; }else{ $e3 = ''; $c3='red';}

$inhalt.= '<tr> <th>'.$i.'</th><td><input size="18" name="i['.$i.']" type="text" value="'.$e0.'"></td> <td>
<input size="18" name="ps['.$i.']" type="text"  value="'.$e1.'"></td><td><input size="18" name="pp['.$i.']" type="text" value="'.$e2.'"></td><td>
<input size="18" name="ger['.$i.']" type="text" value="'.$e3.'"></td> </tr>';
}


}


$inhalt.= '</table><input size="18" type="submit" name="kor" class="formbutton" value="Korrigieren"><input size="18" type="submit" name="loes" class="formbutton" value="L&ouml;sung"><input size="18" type="submit" name="new" class="formbutton" value="Neue &Uuml;bung"></form>';
if(isset($n)) $inhalt.= '<table><td align="center"><h4><b>Points: '.$r.' | Mark: '.$n.'</b></h4></td></table>';
?>
