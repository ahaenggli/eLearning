<?php

/* Menu aufbauen */
$menu_items_def = array ('startseite' => array('de'=>'Startseite',
                                             'fr'=>'Page dAccueil',
                                             'visible' => true)
);

// Falls indiv. Ergänzung für menu.php existiert -> laden
if(file_exists("./content/menu.php"))
   require_once("./content/menu.php");
?>