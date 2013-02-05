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

jimport('joomla.application.component.model');

class Tableinventory_detail extends JTable
{

	var $id = null;

	var $partnumber = null;

	var $description = null;

	var $onhand = 0;

	var $reorderlevel = 0;
	
	var $reorderquantity = 0;

	var $params = null;
	

	function Tableinventory_detail(& $db){	
		//initialize class property
	  $this->_table_prefix = '#__jinv_';
			
		parent::__construct($this->_table_prefix.'inventory', 'id', $db);		
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
		if (trim($this->partnumber) == '') {
			$this->_error = JText::_('YOUR INVENTORY MUST CONTAIN A NUMBER.');
			return false;
		}
		if (trim($this->description) == '') {
			$this->_error = JText::_('YOUR INVENTORY MUST CONTAIN A DESCRIPTION.');
			return false;
		}
		/** check for existing part */
		$query = 'SELECT partnumber FROM '.$this->_table_prefix.'inventory  WHERE partnumber = "'.$this->partnumber.'"';
		$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
		if($row = mysql_fetch_object($result)){
			$xpart = $row->partnumber;
			if ($xpart == $this->partnumber) {
				$this->_error = JText::_('Duplicate Part Number -'. $xpart);
				return false;
			}
		}
		return true;
	}
	
}
?>
