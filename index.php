<?php
// Alle Fehler ausgeben
error_reporting(E_ALL);
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler");
else ob_start();
header('Content-Type: text/html; charset=utf-8');
include_once("___global.php");

$__PageRoot = Project::PageRoot;
if(utils::right($__PageRoot, 1) === '/') $__PageRoot = utils::left($__PageRoot, strlen($__PageRoot)-1);

$_Year = Date("Y");

$inhalt = "";
$title = "";
$MyDesc = "";
$keywords = "";

$add_js = "";
$add_css = "";

/* Navigationsmenü erstellen*/
$menu = "";
$Titel_links = "";

require_once("___menu.php");


if(is_array($menu_items_def) && count($menu_items_def) > 0)
$_AktiveURL = Menu::my_menu($menu_items_def, $page, 0, 0, '', $Titel_links, $menu);
//if(empty($page) || !isset($menu_items_def[$page])) header('Location: '.Project::PageRoot.'/'.$__Project->Lang.'/'.Menu::URL($menu_items_def['_default'][$__Project->Lang]));
//$menu = "";
//Menu::my_menu($menu_items_def, $page, 0, 0, '/', $Titel_links, $menu);

$Titel_links = (!empty($Titel_links)) ? $Titel_links : ucfirst($page);
$title = strip_tags($Titel_links);//.' [STV Mutationen]';

/*
if(!isset($_UserControl) && $page != 'login'){
//header('Location: '.Project::PageRoot.'/'.$__Project->Lang.'/'.Menu::URL($menu_items_def['login'][$__Project->Lang]));
exit;
}
*/

// if(isset($_UserControl) && $page == 'login' || $__Project->RequestURI == '/') header('Location: '.Project::PageRoot.'/'.$__Project->Lang.'/'.Menu::URL($menu_items_def['_default'][$__Project->Lang]));

if(is_array($__Project::Languages) && is_array($menu_items_def) && count($menu_items_def) > 0){
$_LinkDE = Project::PageRoot.'/de/'.Menu::URL($menu_items_def[$page]['de']);
$_LinkFR = Project::PageRoot.'/fr/'.Menu::URL($menu_items_def[$page]['fr']);
$_Link   = Project::PageRoot.'/'.$__Project->Lang.'/'.Menu::URL($menu_items_def[$page][$__Project->Lang]);
}
$_LinkBasisLang =Project::PageRoot.'/'.$__Project->Lang;

/* Nicht existierende Links ins Menü auf 404 bringen*/
/*if(!isset($menu_items_def[$page]) || !Menu::linkValid($__Project->RequestURI, $menu_items_def)) {
          http_response_code(404);
          header("HTTP/1.0 404 Not Found");
          $page = 'error_404';
          $Titel_links = '404 Not Found';
          $title = '404 Not Found';
          eval("\$inhalt .=\"".tpl::gettemplate("error_404.tpl")."\";");
         }
*/

/* Bereits eingeloggt? Falls nein, LogIn seite zeigen*/
//if(!isset($_User) && $page != 'login' && $__Project->Lang=='de') header('LOCATION: '.Project::PageRoot.'/'.$__Project->Lang.'/anmelden/');
//if(!isset($_User) && $page != 'login' && $__Project->Lang=='fr') header('LOCATION: '.Project::PageRoot.'/'.$__Project->Lang.'/se-connecter/');


/* Inhalt laden */
  if(!isset($_GET['beforData'])) $_GET['beforData'] = 'nonExistentApp';
  $beforData     = $_GET['beforData'];
  $beforData_len = strlen($beforData);
  $beforData_Sla = strpos($beforData, '/', 0);
  if($beforData_Sla === false) $beforData_Sla = $beforData_len;
  $beforData     = utils::left($beforData, $beforData_Sla);
  $beforData     = preg_replace("/[^A-Za-z0-9.-]/", '', $beforData);
  
  function findKeyBySubArrayValue($array, $key, &$value){
	  foreach($array as $kk => $vv){
		  if(is_array($vv)){
			  //print_r($vv);
			  if(isset($vv[$key]) && menu::url($vv[$key]) === $value){ 
			  $value = $kk;
			  return true;
			  }
		  }
	  }
  }
  
  findKeyBySubArrayValue($menu_items_def, 'de', $beforData);
  //var_dump($beforData);
  //var_dump(__DIR__."/content/".$page.".php");
  
 // exit;
//  if(isset($menu_items_def[$beforData]))
	 // print_r($menu_items_def[$beforData]);
if(file_exists(__DIR__."/content/".$__Project->REQUEST_PAGE.".php")) require_once(__DIR__."/content/".$__Project->REQUEST_PAGE.".php");
elseif(file_exists(__DIR__."/content/".str_replace('\\', '/', $page).".php")) require_once(__DIR__."/content/".str_replace('\\', '/', $page).".php");
elseif(file_exists("./modules/".$page."/".$page.".php")) require_once("./modules/".$page."/".$page.".php");
else eval("\$inhalt .=\"".tpl::gettemplate($page.".tpl")."\";");

$MyDesc =  str_replace("\r\n", "\n", strip_tags($inhalt));
$MyDesc =  str_replace("\r", "\n", strip_tags($MyDesc));
$MyDesc =  str_replace("\n", "", strip_tags($MyDesc));
$MyDesc =  str_replace("\"", "", strip_tags($MyDesc));
$MyDesc =  str_replace("„", "", strip_tags($MyDesc));
$MyDesc =  str_replace("„", "", strip_tags($MyDesc));
$MyDesc =  str_replace("“", "", strip_tags($MyDesc));

while(str_replace("  ", " ", strip_tags($MyDesc)) <> $MyDesc) $MyDesc =  str_replace("  ", " ", strip_tags($MyDesc));
$MyDesc = trim($MyDesc);

$keywords = (html_entity_decode($MyDesc, ENT_COMPAT, 'UTF-8'));

$keywords =  str_replace(",", "", strip_tags($keywords));
$keywords =  str_replace("!", "", strip_tags($keywords));
$keywords =  str_replace("?", "", strip_tags($keywords));
$keywords =  str_replace(".", "", strip_tags($keywords));
$keywords =  str_replace(":", "", strip_tags($keywords));
$keywords =  str_replace("\"", "", strip_tags($keywords));
$keywords =  str_replace("@", "", strip_tags($keywords));
$keywords =  str_replace("/", "", strip_tags($keywords));
$keywords =  str_replace("(", "", strip_tags($keywords));
$keywords =  str_replace(")", "", strip_tags($keywords));

$keywords = explode(' ', $keywords);

foreach ($keywords as $key=>&$value) {
    if (strlen($value) < 5) {
        unset($keywords[$key]);
    }
}
$keywords = array_unique($keywords);
$keywords = implode(', ', $keywords);

//if(utils::right($__Project->BasisPage, 1) != '/') $__Project->BasisPage.='/';
//$inhalt = str_replace('./', $__Project->BasisPage, $inhalt);


$zurueck = 'zur&uuml;ck';
if($__Project->Lang == 'fr') $zurueck = 'retour';

if($isACP && file_exists(__DIR__.'/modules/templates/acp/__design.tpl')) eval("tpl::out(\"".tpl::gettemplate("/acp/__design.tpl")."\");");
else eval("tpl::out(\"".tpl::gettemplate("__design.tpl")."\");");

if(isset($db))
$db->close();
?>