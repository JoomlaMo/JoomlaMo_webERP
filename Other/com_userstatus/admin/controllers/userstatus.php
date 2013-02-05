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
class UserstatusController extends JController
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
		
	function delete(){
		$this->_table_prefix = 'jos_sts_';
		$post	= JRequest::get('post');
		$cid = JRequest::getVar('cid');
		foreach($cid as $count=>$id){
			$query = "DELETE FROM " . $this->_table_prefix . "userstatus WHERE id='" . $id . "'";
			$result = mysql_query($query) or die("$query Query in userstatus failed : " . mysql_error());		                                                         
		}
		// echo "<BR>display - controller<BR>";
		parent::display();
	}
}	
?>