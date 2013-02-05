<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.helper');

$controller = JRequest::getVar('controller','inventory' ); 
require_once (JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php');
JTable::addIncludePath(JPATH_SITE.DS.'components'.DS.'com_emergencypreparedness'.DS.'tables');
$classname  = 'emergencypreparedness'.'controller'.$controller;
$controller = new $classname( array('default_task' => 'display') );
$controller->execute(JRequest::getVar('task', null, 'default', 'cmd'));
$controller->redirect();
?>
