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

class CreatereceiptsModelCreatereceipts extends JModel
{

	var $_data = null;

	var $_total = null;

	var $_pagination = null;

 	var $_table_prefix = null;

	function __construct()
	{
		parent::__construct();

		global $mainframe, $context;
		$mainframe = JFactory::getApplication();
	}
	
	

	function getData()
	{

		if (empty($this->_data))
		{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList($query);
		}

		return $this->_data;
	}

	function getTotal()
	{
		if (empty($this->_total))
		{
			$query = $this->_buildQuery();
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
  	
	function _buildQuery()
	{
		$this->_table_prefix = "#__jinv_";
		$orderby	= '';
		$query = ' SELECT * FROM '.$this->_table_prefix.'orders where filled=0 order by reference, partnumber' ;

		return $query;
	}
	function store($Receipts,$Reference)
	{		 
		$db =& JFactory::getDBO();
		$this->_table_prefix = 'jos_jinv_';	
	 	//DEVNOTE: give me JTable object			 	
		$row =& $this->getTable();
		Foreach($Receipts as $Part=>$Qty){
			$data->id = ''; 
			$data->partnumber = $Part;
			$data->reference  = $Reference;			
			$data->quantityreceived = (integer)$Qty;
			$data->date = date('Y-m-d');
			$Complete = $this->getOrder($Part,$Reference,$Qty);
			if (!$row->bind($data)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			if (!$row->store()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			$query = "UPDATE " .  $this->_table_prefix . "inventory SET onhand = onhand + " . $Qty . " WHERE partnumber = '" . $Part . "'";
			echo $sql. "= sql<BR>";    
			$errorMessage = 'Error Code-UsageModel' .  __LINE__  . ' Unable to update inventory on hand ' . $Part;
			modelData::getInsertUpdate($query,'Joomla',$errorMessage,null,0);
			$sql = "UPDATE " .  $this->_table_prefix . "orders SET quantityreceived = " . $Qty . ",
																					 filled = " . $Complete . " 
																			 WHERE partnumber = '" . $Part . "' AND 
																			       reference = '" . $Reference . "'";
			$errorMessage = 'Error Code-createreceipts ' .  __LINE__  . ' Unable to update orders qty received ' . $Part;
			modelData::getInsertUpdate($query,'Joomla',$errorMessage,null,0);
		}
		return true;
	}
	function getOrder($Part,$Reference,$Qty){
		$this->_table_prefix = "#__jinv_";
		$db =& JFactory::getDBO();
		$query = "SELECT quantityordered 
		                    FROM " . $this->_table_prefix . "orders 
		                   WHERE partnumber = '" . $Part . "' AND
		                   		 reference  = '" . $Reference . "'"; 
		$db->setQuery( $query );
   	$OrderQty = $db->loadResult();
		If($Qty >= $OrderQty){
			return 1;
		}else{
			return 0;
		}
	}
}
?>
