<?php

class utils{

static function utf8($output){
if(!mb_check_encoding($output, 'UTF-8') OR !($output === mb_convert_encoding(mb_convert_encoding($output, 'UTF-32', 'UTF-8' ), 'UTF-8', 'UTF-32'))) 
			{
			$output = mb_convert_encoding($output, 'UTF-8', 'pass'); 
			}
return $output;			
}

static function isNull($Str1, $Str2){
  if(!isset($Str1) || $Str1 === '' || $Str1 == null) return $Str2;
  return $Str1;
}

static function frmShow($string){
$string = stripslashes($string);
return $string;
}

static function left($str, $length) {
    return substr($str, 0, $length);
}

static function right($str, $length) {
    return substr($str, -$length);
}

// returns true if $needle is a substring of $haystack
static function contains($haystack, $needle)
{
    return strpos($haystack, $needle) !== false;
}

}

  function str_ok($str){
     
     //$str = utf8_encode($str);
     $str = htmlspecialchars($str, ENT_QUOTES,'UTF-8',false); 
     $str = str_replace(array("\\r\\n", "\\r", "\\n", "\\n\\r"), "\n", $str);
     $str = stripslashes($str);
     
     //$str = utf8_decode($str);
     return $str;
    }
    
    
function remove($string, $what, $to = ''){
return str_replace($what, $to, $string);
}



function check_mobile() {
  $agents = array(
    'Windows CE', 'Pocket', 'Mobile',
    'Portable', 'Smartphone', 'SDA',
    'PDA', 'Handheld', 'Symbian',
    'WAP', 'Palm', 'Avantgo',
    'cHTML', 'BlackBerry', 'Opera Mini',
    'Nokia'
  );

  // Prüfen der Browserkennung
  for ($i=0; $i<count($agents); $i++) {
    if(isset($_SERVER["HTTP_USER_AGENT"]) && strpos($_SERVER["HTTP_USER_AGENT"], $agents[$i]) !== false)
      return true;
  }

  return false;
}

function sicherung($txt){
//$txt = utf8_decode($txt);
$txt = str_replace("\"", "", $txt);
$txt = strip_tags($txt);
return $txt;
}



function ranul($s){
    $s = str_replace("/", "_", $s) ;
    return $s;
    }
function umlaute(&$inhalt){

   $inhalt =  str_replace('Â„', '&bdquo;', $inhalt);
   $inhalt =  str_replace("Â“", "&rdquo;", $inhalt);
   
   $inhalt =  str_replace('„', '&bdquo;', $inhalt);
   $inhalt =  str_replace("“", "&rdquo;", $inhalt);

   
    $inhalt = str_replace("ö","&ouml;",$inhalt);
    $inhalt = str_replace("ä","&auml;",$inhalt);
    $inhalt = str_replace("ü","&uuml;",$inhalt);
    $inhalt = str_replace("Ö","&Ouml;",$inhalt);
    $inhalt = str_replace("Ä","&Auml;",$inhalt);
    $inhalt = str_replace("Ü","&Uuml;",$inhalt);
    }


function save($name, $text){

 $datei = fopen($name,"w+");
  fwrite($datei, $text);
  fclose($datei);
  @chmod($name, 0777);
}

function delete ($path) {
    // schau' nach, ob das ueberhaupt ein Verzeichnis ist
    if (!is_dir ($path)) {
        return -1;
    }
    // oeffne das Verzeichnis
    $dir = @opendir ($path);
    
    // Fehler?
    if (!$dir) {
        return -2;
    }
    
    // gehe durch das Verzeichnis
    while (($entry = @readdir($dir)) !== false) {
        // wenn der Eintrag das aktuelle Verzeichnis oder das Elternverzeichnis
        // ist, ignoriere es
        if ($entry == '.' || $entry == '..') continue;
        // wenn der Eintrag ein Verzeichnis ist, dann 
        if (is_dir ($path.'/'.$entry)) {
            // rufe mich selbst auf
            $res = delete ($path.'/'.$entry);
            // wenn ein Fehler aufgetreten ist
            if ($res == -1) { // dies duerfte gar nicht passieren
                @closedir ($dir); // Verzeichnis schliessen
                return -2; // normalen Fehler melden
            } else if ($res == -2) { // Fehler?
                @closedir ($dir); // Verzeichnis schliessen
                return -2; // Fehler weitergeben
            } else if ($res == -3) { // nicht unterstuetzer Dateityp?
                @closedir ($dir); // Verzeichnis schliessen
                return -3; // Fehler weitergeben
            } else if ($res != 0) { // das duerfe auch nicht passieren...
                @closedir ($dir); // Verzeichnis schliessen
                return -2; // Fehler zurueck
            }
        } else if (is_file ($path.'/'.$entry) || is_link ($path.'/'.$entry)) {
            // ansonsten loesche diese Datei / diesen Link
            $res = @unlink ($path.'/'.$entry);
            // Fehler?
            if (!$res) {
                @closedir ($dir); // Verzeichnis schliessen
                return -2; // melde ihn
            }
        } else {
            // ein nicht unterstuetzer Dateityp
            @closedir ($dir); // Verzeichnis schliessen
            return -3; // tut mir schrecklich leid...
        }
    }
    
    // schliesse nun das Verzeichnis
    @closedir ($dir);
    
    // versuche nun, das Verzeichnis zu loeschen
    $res = @rmdir ($path);
    
    // gab's einen Fehler?
    if (!$res) {
        return -2; // melde ihn
    }
    
    // alles ok
    return 0;
}
/*Hi, na?*/
?>