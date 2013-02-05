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

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.controller' );
require_once( JPATH_COMPONENT_SITE . DS . 'models' .DS.'helper.php' );

class CreatereceiptsController extends JController
{

	function __construct( $default = array())
	{
		parent::__construct( $default );
	}

	function cancel()
	{
		$this->setRedirect( 'index.php' );
	}
	function save()
	{			
		$this->_table_prefix = "#__jinv_";
		$post	= JRequest::get('post');
		$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$post['id'] = $cid[0];
		$Receipts = $post["Received"];
		$Reference = $post["reference"];
		// var_dump($post) . "<BR>post<BR>";
		$model = $this->getModel('createreceipts');
		// var_dump($model) . "<BR>model<BR>";
		if ($model->store($Receipts,$Reference)) {
			$msg = JText::_( 'Receipts Saved' );
		} else {
			$msg = JText::_( 'Error Saving Receipts' . $this->_error);
		}
		$this->setRedirect( 'index.php?option=com_jinventory&controller=inventory',$msg );
	}

	function display() {

		parent::display();
	}
}	
?>
