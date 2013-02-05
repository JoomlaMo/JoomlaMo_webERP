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

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.controller' );
require_once( JPATH_COMPONENT_SITE . DS . 'models' .DS.'helper.php' );
// echo 'stop     in inventory.php controllers Line #' . __LINE__ . '  <br>';exit;
class InventoryController extends JController
{
	function __construct( $default = array())
	{
		parent::__construct( $default );
	}
	function display()
	{
		// echo "<BR>display - controller<BR>";
		parent::display();
		JRequest::setVar( 'view', 'inventory' );
		JRequest::setVar( 'layout', 'default'  );
	}
	function add(){
		$link = 'index.php?option=com_jinventory&controller=inventory_detail';
		$this->setRedirect($link, $msg);
	}
	function edit(){
		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$link = 'index.php?option=com_jinventory&controller=jinventory_detail&cid=' . $cid;
		$this->setRedirect($link, $msg);
	}
	function delete(){
		global $mainframe;

		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('inventory_detail');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_jinventory' );
	} 
}	
?>