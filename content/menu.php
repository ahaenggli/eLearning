<?php
$menu_items_def = array();


$menu_items_def = array ('startseite' => array('de'=>'Startseite'),
												
		 'englisch' => array('de'=>'Englisch',
											    'items'=>array(
                                                          'englisch\irregular-verbs' => array('de'=>'Irregular verbs')
                                                )),
											
                         //'mathe' => array('de'=>'Mathematik'),
				
						 'geographie' => array('de'=>'Geographie',
						 'items'=>array(				  'geografie' => array('de'=>'Übersicht'),
                                                          
														  'europa' => array('de'=>'Europa',
																			'items'=>array(
																			'geographie\schweiz' => array('de'=>'Schweiz'),
																			
																			'geographie\europa-land' => array('de'=>'Länder & Hauptstädte'),
																			'geographie\europa-stroeme' => array('de'=>'Str&ouml;me'),
																			'geographie\europa-gebirge' => array('de'=>'Gebirge'),
																			'geographie\europa-meerengen' => array('de'=>'Meerengen'),
																			'geographie\europa-meere' => array('de'=>'Meere'),
																			'geographie\europa-inseln' => array('de'=>'(Halb-)Inseln')
																				)
																			),															  
														  'afrika' => array('de'=>'Afrika',
																			'items'=>array(
																			'geographie\afrika' => array('de'=>'Länder & Hauptstädte'),
																			'geographie\afrika-fluesse' => array('de'=>'Flüsse & Seen')
																				)
																			),
														  'amerika' => array('de'=>'Amerika',
																			'items'=>array(
																			'geographie\amerika' => array('de'=>'Länder & Hauptstädte')
																							),
																			),
														  'asien' => array('de'=>'Asien',
																			'items'=>array(
																			'geographie\asien' => array('de'=>'Länder & Hauptstädte'),
																			'geographie\asien-fluesse' => array('de'=>'Flüsse & Seen')
																				)
																			)
																		
                                                )),
						 'quellen' => array('de'=>'Quellen'),

                       //  'links' => array('de'=>'Links'),
                         //'kontakt' => array('de'=>'Kontakt'),


);

	$add_js = '<script language="JavaScript" type="text/javascript" src="'.Project::PageRoot.'/content/geographie/js.js" ></script>
<script type="text/javascript" src="'.Project::PageRoot.'/content/geographie/dad.js"></script>

<style type="text/css">
<!--
.DragContainer, .OverDragContainer {
min-height: 45px;
min-width: 45px;
}

.DragBox, .OverDragBox, .DragDragBox, .miniDragBox {
height: 45px;
width: 45px;

}

.OverDragContainer {
	background-color: #eee;
}

.OverDragBox, .DragDragBox {
  background-color: #000000;
}

.DragDragBox {
 /* background-color: #ff99cc;*/
 display:none;
}

.miniDragBox {
  float: left;
  margin: 0 5px 5px 0;
  width: 20px;
  height: 20px;
}
-->
</style>';
?>