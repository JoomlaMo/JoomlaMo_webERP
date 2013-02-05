<?php
/**
 * @version	1.0
 * @package	barcode
 * @author Mo Kelly
 * @author mail	mokelly@rockwall-computer.com
 * @copyright	Copyright (C) 2009 Mo Kelly - All rights reserved.
 * @license		GNU/GPL
 */
 
// no direct access
defined('_JEXEC') or die('Restricted access');
// echo "stop";exit;

// echo "admin controller";exit;
//DEVNOTE: 
// specific controller?
// Require specific controller if requested
//if no controller then default controller = 'inventory'
$controller = JRequest::getVar('controller','barcode' ); 
//set the controller page  
require_once (JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php');
// echo "require controller - Main Program<BR>";
// exit;
// Create the controller inventory Controller 
$classname  = $controller.'controller';
// echo $classname. "= classname - Main Program<BR>";
//create a new class of classname and set the default task:display
$controller = new $classname( array('default_task' => 'display') );
// echo "<BR>dump from  - Main Program<BR>";
// Perform the Request task
// echo JRequest::getVar('task' ) . "hello";exit;
$controller->execute( JRequest::getVar('task' ));

// Redirect if set by the controller
$controller->redirect(); 
?>
