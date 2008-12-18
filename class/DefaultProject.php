<?php

class DefaultProject
{
    // Globale statische Variablen
    const  PageRoot = 'http://192.168.1.9/projects/basis';
    const  TPL_Dir = __DIR__.'/templates/';
    const  ROOT = __DIR__;
    const  Languages = array('de', 'fr');
    const  DefaultLang = 'de';
    const  DefaultPage = 'startseite';

    // Globale dyn. Variablen
    public $Lang = "de";
    public $RequestURI = self::PageRoot;
    public $RequestExistsInMenu = false;
    public $BasisPage = "";

    function __construct(){
    //print "Im BaseClass Konstruktor\n";
      $this->Lang = (isset($_GET['lang']) && in_array($_GET['lang'], self::Languages))? $_GET['lang']:self::DefaultLang;
      $this->RequestURI = str_replace('/'.$this->Lang.'/', '/', trim($_SERVER['REQUEST_URI']));
      $this->RequestExistsInMenu = (!empty($this->RequestURI) && $this->RequestURI!=='/')? false:true;
      $this->BasisPage = self::PageRoot.'/'.$this->Lang.'/';
    }

    function removeDoubleSlashes($str){
      while(strrpos($str, '//')!==false) $str = str_replace($str, '//', '/');
      return $str;
    }
}

?>