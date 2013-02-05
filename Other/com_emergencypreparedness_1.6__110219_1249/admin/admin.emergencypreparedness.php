<?php
/**
* @package emergencypreparedness
* @version 1.5
* @copyright Copyright (C) 2009 Mo Kelly. All rights reserved.
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

$controller = JRequest::getVar('controller','assettype' ); 

require_once (JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php');

$classname  = $controller.'controller';

$controller = new $classname( array('default_task' => 'display') );

$controller->execute( JRequest::getVar('task' ));

$controller->redirect(); 
?>
