<?php
/**
* @package JInventory
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

$controller = JRequest::getVar('controller','inventory' ); 
$controllerlist = " createorders,createreceipts,inventory,inventory_detail,stockcount,usage";
If(!strpos($controllerlist, $controller)){
	$controller = 'inventory';
}
// echo $controller. "= controller - Main Program<BR>";
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
// var_dump($controller);
// Perform the Request task
$controller->execute( JRequest::getVar('task' ));

// Redirect if set by the controller
$controller->redirect(); 
?>
