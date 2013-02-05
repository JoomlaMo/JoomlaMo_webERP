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
jimport( 'joomla.application.component.controller' );

class CreateordersController extends JController
{
	function __construct( $default = array())
	{
		parent::__construct( $default );
	}
	function display()
	{
		// echo "<BR>display - controller<BR>";
		parent::display();
	}
	function save()
	{	
		$db =& JFactory::getDBO();
		$this->_table_prefix = '#__jinv_';
		$query = 'SELECT max(reference) FROM ' . 
		            $this->_table_prefix . 
		            'orders';
		$db->setQuery( $query );
		If($row = $db->loadResult()){
			// var_dump($row);
			$row = $db->loadResult();
			$Reference = $row+1;
			var_dump($row);echo "<BR><BR>row<BR><BR><BR>";
		}else{
			$Reference = 1;
		}
		$post	= JRequest::get('post');
		$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$post['id'] = $cid[0];
		$Orders = $post["Order"];
		$model = $this->getModel('createorders');
		if ($model->store($Orders,$Reference)) {
			$msg = JText::_( 'Inventory Saved' );
		} else {
			$msg = JText::_( 'Error Saving Inventory' . $this->_error);
		}
		$this->setRedirect( 'index.php?option=com_jinventory&controller=createreceipts',$msg );
	}

}
