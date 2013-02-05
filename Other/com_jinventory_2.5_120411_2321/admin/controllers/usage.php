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

class usageController extends JController
{

	function __construct( $default = array())
	{
		parent::__construct( $default );
	}

	function cancel()
	{
		$this->setRedirect( 'index.php' );
	}


	function display() {
		parent::display();
	}
	function publish()
	{
		$cid 	= JRequest::getVar( 'cid', array(0), 'post', 'array' );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to publish' ) );
		}

		$model = $this->getModel('usage');
		if(!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_jinventory&controller=usage' );
	}

	/** function unpublish
	*
	* Unpublish all items specified by array cid
	* and set Redirection to the list of items
	* 			
	* @param array cid - array of id
	* @return set Redirection
	*/

	function unpublish(){
	   $this->setRedirect( 'index.php?option=com_jinventory&controller=usage' );
	
	   // Initialize variables
	   $db  =& JFactory::getDBO();
	   $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
	   $task = JRequest::getVar( 'task' );
	   $unpublish = ($task == 'unpublish');
	   $n = count( $cid );
	      
	   if (empty( $cid )) {
	      return JError::raiseWarning( 500, JText::_( 'No items selected' ) );
	   }
	   
	   JArrayHelper::toInteger( $cid );
	   $cids = implode( ',', $cid );
	
	   $query = 'UPDATE #__jinv_usage' .
	   			  ' SET published = 0 
	   			  WHERE id IN ( '. $cids.'  )';
	   
	   $db->setQuery( $query );
	   if (!$db->query()) {
	   	JError::raiseError(500, JText::_( $db->getErrorMsg() ) );
			return false;
	   }
	}
}	
?>
