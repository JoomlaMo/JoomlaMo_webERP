<?php
/**
* @package UserStatus
* @version 1.5
* @copyright Copyright (C) 2009 Mo Kelly. All rights reserved.
   
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

defined( '_JEXEC' ) or die( 'Restricted access' );

$controller = JRequest::getVar('controller','userstatus' ); 

require_once (JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php');
$controllerlist = " userstatus,userstatus_detail,locations,locations_detail";
If(!strpos($controllerlist, $controller)){
	$controller = 'userstatus';
}
$classname  = $controller.'controller';

$controller = new $classname( array('default_task' => 'display') );

$controller->execute( JRequest::getVar('task' ));

$controller->redirect(); 
?>
