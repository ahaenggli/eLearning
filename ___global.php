<?php
/* Initial */
session_start();
error_reporting(E_ALL);

//var_dump($_GET);
/* Klassen laden */
    function getFile($base_dir, $class){
        if (!(strpos($class, '//') !== false)) $class = $class.'\\'.$class;
        $relative_class = ($class);
        $file = $base_dir . str_replace('\\', '/', $relative_class). '.php';
        return $file;
    }

    spl_autoload_register(function ($class)
    {
        $base_dir = __DIR__ . '/class/';
        $file = getFile($base_dir, $class);//$base_dir . str_replace('\\', '/', $relative_class). '.php';
        $file2= getFile($base_dir.'ahaenggli/', $class);
		
        if (file_exists($file)) require_once($file);
        elseif (file_exists($file2)) require_once($file2);
		elseif (file_exists($base_dir.$class.'.php')) require_once($base_dir.$class.'.php');
        //else echo $file;
    });

// Falls Config existiert -> laden
if(file_exists(__DIR__."/content/conf.php"))
   require_once(__DIR__."/content/conf.php");
else die("Datei existiert nicht: ".__DIR__."/content/conf.php");

if (!class_exists('Project')) die ("Ableitung der Klasse DefaultProject fehlt noch.");

$__Project = new Project();

$page = (!isset($_GET['p']) OR $_GET['p']=='index' OR ($_GET['p']=='neues' && (isset($_GET['id']) && !is_numeric($_GET['id']))) or empty($_GET['p']))? $__Project::DefaultPage: $_GET['p'];

// Falls indiv. ergänzung für global.php existiert -> laden
if(file_exists(__DIR__."/content/global.php"))
   require_once(__DIR__."/content/global.php");

?>