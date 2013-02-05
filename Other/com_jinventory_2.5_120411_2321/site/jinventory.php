<?php
/**
* @package JInventory
* @version 1.5
* @copyright Copyright (C) 2008 Mo Kelly. All rights reserved.
   
*	This program is free software: you can redistribute it and/or modify    
*	it under the terms of the GNU General Public License as published by
*  the Free Software Foundation, either version 3 of the License, or
*  (at your option) any later version.*
*
*  This program is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.*

*  You should have received a copy of the GNU General Public License
*  along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/ 


defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.helper');
// echo 'stop     in jinventory main controller Line #' . __LINE__ . '  <br>';exit;

$post			= JRequest::get('request');
If(array_key_exists('view', $post)){
	$controller = $post['view'];
}else{
	$controller = JRequest::getVar('controller','usage' );
}
$controllerlist = " usage,inventory";
If(!strpos($controllerlist, $controller)){
	$controller = 'usage';
}
require_once (JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php');
JTable::addIncludePath(JPATH_SITE.DS.'components'.DS.'com_jinventory'.DS.'tables');
$classname  = 'Jinventory'.'controller'.$controller;
$controller = new $classname( array('default_task' => 'display') );
$controller->execute(JRequest::getVar('task', null, 'default', 'cmd'));
$controller->redirect();
?>
