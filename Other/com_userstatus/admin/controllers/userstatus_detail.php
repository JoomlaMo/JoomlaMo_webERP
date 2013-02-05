<?php
/**
* @package UserStatus
* @version 1.5
* @copyright Copyright (C) 2010 Mo Kelly. All rights reserved.
   
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
JRequest::setVar('view', 'userstatus_detail');
class userstatus_detailcontroller extends JController
{
	function __construct( $default = array())
	{
		parent::__construct( $default );
		$view =& $this->getView( 'userstatus_detail', 'html' );
		$view->setModel( $this->getModel(), true );
		$this->addModelPath( JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_userstatus' . DS . 'models' );
		// $view->setModel( $this->getModel( 'weberp') );
	}
	function display()
	{
		parent::display();
	} 
	function save()
	{	
		$post	= JRequest::get('post');
		$model = $this->getModel('userstatus_detail');
		$model->createuserstatus_detail();
		$this->setRedirect( "index.php?option=com_userstatus&controller=userstatus",$msg );
		parent::display();
	}
}	
?>
