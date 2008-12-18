<?php
 
class Menu{

static function xlinkValid($link, $menu_items){
global $__Project;
$valid = false;

foreach($menu_items as $menu=>$item){
if($link == self::URL($item[$__Project->Lang])
   || $link == self::URL($item[$__Project->Lang]).'/'
   || $link == '/'.self::URL($item[$__Project->Lang]).'/'
   ) $valid =true;
else echo '_________________________________________________________ '.$link.'||'.self::URL($item[$__Project->Lang]).'/<br>';
}

return $valid;
}


static function array_insert(&$array, $position, $insert)
{
    if (is_int($position)) {
        array_splice($array, $position, 0, $insert);
    } else {
        $pos   = array_search($position, array_keys($array));
        $array = array_merge(
            array_slice($array, 0, $pos),
            $insert,
            array_slice($array, $pos)
        );
    }
}

static function my_menu($menu_items = array(), &$page, $sub_level = 0, $aktiv_level = 0, $parent = '', &$Titel_links, &$menu_h){
//global  $__PageRoot, $__RequestExistsInMenu, $__RequestURI, $__Lang;
global $__Project, $isACP;

$return = NULL;
 
    foreach($menu_items as $menu=>$item){
       if($sub_level==0) $aktiv_level++;

       $desc = $item[$__Project->Lang];
       $link_file = $menu; 

       $aktiv_page = false;
       $aktiv_tag = '#aktiv'.$aktiv_level.'#';

       $link_anzeigen = (utils::contains($item[$__Project->Lang], '<!--- #inaktiv# --->'))? false : true;
       if(isset($item['visible']) && !$item['visible']) $link_anzeigen = false;

       $link_base = self::URL($desc).'/';
       $tparent = $parent.$link_base;
       $link = $__Project->BasisPage.''.$link_base;
       if($sub_level > 0) $link = $tparent;
       
       //if($tparent == $__RequestURI) $__RequestExistsInMenu = true;
       //if( utils::contains($__RequestURI, $tparent)) $__RequestExistsInMenu = true;

       $menu_h.=($link_anzeigen==false)? '': "\n".' <li'.$aktiv_tag.'>'."\n  ".'<a href="'.$link.'">'.$desc.'</a>';

	   //echo $aktiv_level.'.)b-> '.self::URL($page).'/' .'=='.$link_base.'<br>';
	   //echo $aktiv_level.'.)a-> '.$__Project->RequestURI .'=='. $__Project->BasisPage.$tparent.'<br>';
	   
	   /* ($tparent == $__Project->RequestURI)*/
       if (self::URL($page).'/' == $link_base && (utils::contains($tparent						, $__Project->RequestURI) || 
									          utils::contains($__Project->BasisPage.$tparent, $__Project->RequestURI)
	   )) $aktiv_page = true;

       if ($aktiv_page) $Titel_links = $desc;
       if ($aktiv_page) $page = $link_file;
       if ($aktiv_page) $menu_h = str_replace($aktiv_tag, ' class="active" ', $menu_h);
       elseif($sub_level!=0 && !is_array($item)) $menu_h = str_replace($aktiv_tag, '', $menu_h);

       if ($aktiv_page) $return = $link;

        if(isset($item['items']) && is_array($item['items'])){
        $tmenu_h = "";
        self::my_menu($item['items'], $page, $sub_level+1, $aktiv_level, $link/*$tparent*/, $Titel_links, $tmenu_h);

        if(!empty($tmenu_h)){
         $menu_h.= '<ul class="nav nav-second-level" style="padding-left:'.(1*($sub_level)).'em;">'.$tmenu_h.'</ul>';
		 
 		 
        }

        }

	$menu_h = str_replace($aktiv_tag, '', $menu_h);
    $menu_h.=($link_anzeigen==false)? '': "</li>";

    }
return $return;
}

static function URL($url=""){

$url = str_replace('.shtml', '', $url);
$url = str_replace('.html', '', $url);
$url = strtolower($url);
$url = strip_tags($url);
$url = html_entity_decode($url);
$url = strtolower($url);
$url = trim($url);

$url = str_replace(' ', '-', $url);
$url = str_replace('/', '-', $url);
$url = str_replace('ä', 'ae', $url);
$url = str_replace('ö', 'oe', $url);
$url = str_replace('ü', 'ue', $url);
$url = str_replace('Ä', 'ae', $url);
$url = str_replace('Ö', 'oe', $url);
$url = str_replace('Ü', 'ue', $url);

$url =  str_replace('„', '', $url);
$url =  str_replace("“", "", $url);
$url =  str_replace('„', '', $url);
$url =  str_replace("”", "", $url);
$url =  str_replace("'", "", $url);
$url =  str_replace('"', "", $url);

$url = str_replace('(', '', $url);
$url = str_replace(')', '', $url);
$url = str_replace('<', '', $url);
$url = str_replace('>', '', $url);
$url = str_replace('=', '', $url);
$url = str_replace(':', '', $url);
$url = str_replace('+', '', $url);
$url = str_replace('!', '', $url);
$url = str_replace('&', '-', $url);
$url = str_replace('--', '-', $url);
$url = str_replace('--', '-', $url);
$url = str_replace('--', '-', $url);

$url = preg_replace("/[^A-Za-z0-9 _+-]/", '', $url);
$url = urlencode($url);
$url = str_replace('%E4', 'ae', $url);
$url = str_replace('%F6', 'oe', $url);
$url = str_replace('%FC', 'ue', $url);



//echo urlencode('äö');
return $url;
}
}

/*
   function my_htaccess($array, $parent){
    foreach($array as $key => $item){
     $ex = explode('|', $key);
     echo 'RewriteRule ^(.*)'.$ex[0].'$ '.$parent.'/'.my_url($ex[1]).'/ [R=301,L]<br>'."\n";
     if(is_array($item)) my_htaccess($item, $parent.'/'.my_url($ex[1]));
    }
   
   }

   function my_xml($array, $parent, &$out = array()){
   
    foreach($array as $key => $item){
     $ex = explode('|', $key);
     //echo 'RewriteRule ^(.*)/'.$ex[0].'$ '.$parent.'/'.my_url($ex[1]).'/ [R=301,L]<br>'."\n";
     $out[] = $parent.'/'.my_url($ex[1]).'/'; 
     if(is_array($item)) my_xml($item, $parent.'/'.my_url($ex[1]), $out);
    }
   }
      
*/

/*
function my_menu_h($menu_items = array(), &$page, $sub_level = 0, $aktiv_level = 0, $parent = '/', &$Titel_links, &$menu_h){
global  $__PageRoot, $__RequestExistsInMenu, $__RequestURI;
    
    foreach($menu_items as $menu=>$item){
       if($sub_level==0) $aktiv_level++;
       $ex = explode('|', $menu);
       $aktiv_page = false;
       $aktiv_tag = '#aktiv'.$aktiv_level.'#';
       $link_anzeigen = ((!is_array($item) && $item == '0') || contains($menu, '<!--- #inaktiv# --->'))? false : true;
       $link_file = $ex[0];
       $link_base = my_url($ex[1]);
       $link = $__PageRoot.$parent.$link_base;
       $tparent = $parent.$link_base.'/';
       if($tparent == $__RequestURI) $__RequestExistsInMenu = true;
       //else echo $tparent .'='. $__RequestURI.'<br>';
       $desc = $ex[1];
    
       $menu_h.=($link_anzeigen==false || $sub_level != 0)? '': "\n\n".'<ul>';
       $menu_h.=($link_anzeigen==false)? '': "\n".' <li>'."\n  ".'<a href="'.$link.'/"'.$aktiv_tag.'>'.$desc.'</a>';
       
       if (my_url($page) == $link_base && ($tparent == $__RequestURI)) $aktiv_page = true;
       if ($aktiv_page) $Titel_links = $desc;
       if ($aktiv_page) $page = $link_file;
       if ($aktiv_page) $menu_h = str_replace($aktiv_tag, ' style="color:red;" ', $menu_h);       
       elseif($sub_level!=0 && !is_array($item)) $menu_h = str_replace($aktiv_tag, '', $menu_h);

        if(is_array($item)){
        $tmenu_h = "";
        my_menu($item, $page, $sub_level+1, $aktiv_level, $tparent, $Titel_links, $tmenu_h);
        if(!empty($tmenu_h)){
        if(contains($tmenu_h,'color:red;')){
         $menu_h = str_replace($aktiv_tag, ' style="color:red;" ', $menu_h);
         $Titel_links = '<a href="'.$link.'/">'.$desc.'</a> &gt; '.$Titel_links;
         
        } 
         $menu_h.="\n  <ul>".$tmenu_h."\n  </ul>";
        }
        $tmenu_h = "";
        }   
    //if($sub_level==0 || is_array($item)) 
    $menu_h = str_replace($aktiv_tag, '', $menu_h);

    $menu_h.=($link_anzeigen==false)? '': "</li>";
    $menu_h.=($link_anzeigen==false || $sub_level != 0)? '': "\n"."\n".'</ul>';    
    }

}*/
?>