<?php
class tpl{

      static function out($print)
      {
             echo((($print)));
      }

      static function gettemplate($tpl, $dir = NULL)
      {
             global $__Project;

             $file = "";
             if(!isset($dir)) $dir=Project::TPL_Dir;
             if(utils::right($dir, 1) !== '/') $dir.='/';


             if(file_exists($dir.$__Project->Lang.'/'.$tpl)) $file = Project::TPL_Dir.$__Project->Lang.'/'.$tpl;
             elseif(file_exists($dir.$tpl)) $file = $dir.$tpl;
             //elseif(file_exists($dir.$__Project->Lang.'/'.$__Project::DefaultPage.'.tpl') ) $file = $dir.$__Project->Lang.'/'.$__Project::DefaultPage.'.tpl';
             else{
				//die("Datei nicht gefunden: ".$dir.$tpl."\r\n".'<br>');
				if(utils::contains($tpl, '.html.tpl')) header("Location:".Project::PageRoot.'/'.str_replace('.html.tpl', '', $tpl).'/', true, 301);
				//else header("Location:".Project::PageRoot.'/'.Project::DefaultPage, true, 301);
			 }
             return (str_replace('%%', '"', str_replace("\"", "\\\"", implode("", file($file)))));
      }


}
?>