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

class createordersModelcreateorders extends JModel
{
	var $_id = null;

	var $_data = null;
	
	var $_pagination = null;

	var $_table_prefix = null;
	
	function __construct()
	{
		parent::__construct();

		global $mainframe, $context;
		$mainframe = JFactory::getApplication();
		
	  	$this->_table_prefix = '#__jinv_';	

	  	$limit		= $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 0);
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0 );
		
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);		
	}

	function getData()
	{
		if (empty($this->_data))
		{
			$query = $this->_buildInventoryQuery();
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
		}
		return $this->_data;
	}
	function getTotal()
	{
		//DEVNOTE: Lets load the content if it doesn't already exist
		if (empty($this->_total))
		{
			$query = $this->_buildInventoryQuery();
			$this->_total = $this->_getListCount($query);
		}

		return $this->_total;
	}
	function getPagination()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}

		return $this->_pagination;
	}	

	  	
	function _buildInventoryQuery()
	{
		$query = ' SELECT * FROM '.$this->_table_prefix.'inventory WHERE reorderlevel > onhand ORDER BY partnumber';
		return $query;
	}

	function store($Orders,$Reference)
	{		 	
	 	//DEVNOTE: give me JTable object			 	
		$row =& $this->getTable();
		Foreach($Orders as $Part=>$Qty){
			$data->id = ''; 
			$data->partnumber = $Part;
			$data->reference  = $Reference;
			$data->quantityordered = (integer)$Qty;
			$data->quantityreceived = 0;
			$data->date = date('Y-m-d');
			if (!$row->bind($data)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			if (!$row->store()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return true;
	}
	function getOrders(){
		$this->_table_prefix = "#__jinv_";
		$db =& JFactory::getDBO();
		$query1 = "SELECT * FROM ".$this->_table_prefix."orders WHERE filled = 0"; 
		$db->setQuery( $query1 );
   	$rows =& $db->loadObjectList();
   	$OnOrder = array();
		Foreach($rows as $row){
			$PartNumber						=	$row->partnumber;
			If(array_key_exists($PartNumber,$OnOrder)){
				$OnOrder[$PartNumber]	=  $OnOrder[$PartNumber] +	(integer)$row->quantityordered - (integer)$row->quantityreceived;
			}else{
				$OnOrder[$PartNumber]	=	(integer)$row->quantityordered - (integer)$row->quantityreceived;
			}
		}
		$db =& JFactory::getDBO();
		// get next reference number
		$query = "SELECT max(reference) FROM ".$this->_table_prefix."orders ";
		$db->setQuery( $query );
		$Reference = $db->loadResult($query);
		If($Reference){
			$Reference = $Reference + 1;
		}else{
			$Reference = 1;
		}
   		
		return $OnOrder;
	}
}

?>
