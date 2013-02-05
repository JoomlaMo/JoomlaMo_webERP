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
require_once( JPATH_COMPONENT . DS . 'models' .DS.'helper.php' );
//DEVNOTE: import CONTROLLER object class
jimport( 'joomla.application.component.controller' );
JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jinventory'.DS.'tables');
// echo 'stop     in usage.php controllers Line #' . __LINE__ . '  <br>';exit;
class JinventoryControllerUsage extends JController
{

	/**
	 * Custom Constructor
	 */
	function __construct( $default = array())
	{
		parent::__construct( $default );
		JRequest::setVar( 'view', 'usage' );
		JRequest::setVar( 'layout', 'form'  );
	}
	function save()
	{		
		$post			= JRequest::get('post');
		$cid			= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$post['id'] = $cid[0];
		$partnumber = $post['partnumber'];
		$model 		=& $this->getModel('usage');
		If(!$model->checkpart()){
			$msg = JText::_( 'ERROR INVALID PART NUMBER '.$post['partnumber'] );
		}else{
			if ($model->store($post)) {
				$msg = JText::_( 'USAGE SAVED-'. $partnumber);
							
  				// Check the table in so it can be edited.... we are done with it anyway
	  			$model->checkin();
			} else {
				$msg = JText::_( '************************ERROR SAVING INVENTORY-'.$partnumber."***************************" );
			}
		}
		parent::display();
   }
}
