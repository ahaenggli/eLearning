<?php

class Project extends DefaultProject{	
    // Globale statische Variablen
    const  PageRoot = 'https://www.***.net/eLearning';
    const  TPL_Dir = __DIR__.'/templates/';
    const  ROOT = __DIR__;
    const  Languages = null;
    const  DefaultLang = 'de';
    const  DefaultPage = 'startseite';
	const  ShowActiveSubmenu = true;
	const  ShowActiveSubmenuLevels = 1;
    // Globale dyn. Variablen
    public $Lang = "de";
    public $REQUEST_URI = self::PageRoot;
	public $REQUEST_PAGE = self::PageRoot;
	
    public $RequestExistsInMenu = false;
    public $BasisPage = "";
	function __construct() {

		   //parent::__construct();
		   //print "Im SubClass Konstruktor\n";
		  $this->Lang = 'de';//(isset($_GET['lang']) && in_array($_GET['lang'], self::Languages))? $_GET['lang']:self::DefaultLang;
		  $this->RequestURI = str_replace('/'.$this->Lang.'/', '/', trim($_SERVER['REQUEST_URI']));
		  
		  $this->REQUEST_URI  = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		  $this->REQUEST_PAGE = str_replace(self::PageRoot, '', $this->REQUEST_URI);
		  if(utils::right($this->REQUEST_PAGE, 1) == '/') $this->REQUEST_PAGE = utils::left($this->REQUEST_PAGE, strlen($this->REQUEST_PAGE)-1);
		  
		  //$this->RequestExistsInMenu = (!empty($this->RequestURI) && $this->RequestURI!=='/')? false:true;
		  $this->BasisPage = self::PageRoot.('/');//.parent;//::removeDoubleSlashes('/'.$this->Lang.'/');
	}
}

?>