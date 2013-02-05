<?php


defined( '_JEXEC' ) or die( 'Restricted access' );

$controller = JRequest::getVar('controller','userstatus' ); 

require_once (JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php');

$classname  = $controller.'controller';

$controller = new $classname( array('default_task' => 'display') );

$controller->execute( JRequest::getVar('task' ));

$controller->redirect(); 
?>
