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
jimport('joomla.application.component.model');
class Tablelocations_detail extends JTable
{
	var $id = 0;
	var $description 	= null;
	var $address 		= null;
	var $city 			= null;
	var $county 		= null;
	var $state 			= null;
	var $zip 			= null;
	var $notes 			= null;
	var $params 		= null;
	function Tablelocations_detail(& $db){	
	  $this->_table_prefix = '#__sts_';			
		parent::__construct($this->_table_prefix.'locations', 'id', $db);		
	}
	function bind($array, $ignore = '')
	{
		if (key_exists( 'params', $array ) && is_array( $array['params'] )) {
			$registry = new JRegistry();
			$registry->loadArray($array['params']);
			$array['params'] = $registry->toString();
		}
		return parent::bind($array, $ignore);
	}
	function check()
	{	
		if (trim($this->id) == '') {
			$this->_error = JText::_('Id must have a value.');
			return false;
		}
		if (trim($this->description) == '') {
			$this->_error = JText::_('Description must have a value.');
			return false;
		}
		if (trim($this->address) == '') {
			$this->_error = JText::_('Address must have a value.');
			return false;
		}
		if (trim($this->city) == '') {
			$this->_error = JText::_('City must have a value.');
			return false;
		}
		if (trim($this->county) == '') {
			$this->_error = JText::_('County must have a value.');
			return false;
		}
		if (trim($this->state) == '') {
			$this->_error = JText::_('State must have a value.');
			return false;
		}
		if (trim($this->zip) == '') {
			$this->_error = JText::_('Zip must have a value.');
			return false;
		}
		$query = 'SELECT id FROM '.$this->_table_prefix.'locations  WHERE id = "'.$this->id.'"';
		$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
		if($row = mysql_fetch_object($result)){
			$ID = $row->id;
			if ($ID == $this->id) {
				$this->_error = JText::_('Duplicate ID -'. $xpart);
				return false;
			}
		}
		return true;
	}
}
?>
