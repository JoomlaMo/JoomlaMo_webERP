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

//DEVNOTE: import MODEL object class
jimport('joomla.application.component.model');


class JinventoryModelUsage extends JModel
{
	var $_id = null;

	var $_data = null;

	var $_table_prefix = null;
	
	function __construct()
	{
		parent::__construct();

		//initialize class property
	  $this->_table_prefix = '#__jinv_';	
		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);

	}

	function setId($id)
	{
		$this->_id		= $id;
		$this->_data	= null;
	}

	function &getData()
	{
		if (!$this->_loadData())
		{
			$this->_initData();
		}
   	return $this->_data;
	}
	function checkin()
	{
		if ($this->_id)
		{
			$usage = & $this->getTable();
			if(! $usage->checkin($this->_id)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return false;
	}
	function _loadData()
	{
		// Lets load the content if it doesn't already exist
		$db = & JFactory::getDBO();
		// $option = JRequest::getVar('option');
		// $params = JComponentHelper::getParams($option);
		if (empty($this->_data))
		{
			$query = 'SELECT * FROM '.$this->_table_prefix.'usage' ;
			$errorMessage = 'Error Code-UsageModel' .  __LINE__  . ' Unable to select Usage.';
			$this->_data =& modelData::getRowList($query,'Joomla',$errorMessage,null,0);
			return $this->_data;
		}
		
		return true;
	}

	function _initData()
	{
		if (empty($this->_data))
		{
			$detail 							= new stdClass();
			$detail->id						= 0;
			$detail->partnumber			= null;
			$detail->reference			= null;
			$detail->quantity				= 0;
			$detail->published			= 0;
			$this->_data				 	= $detail;
			return (boolean) $this->_data;
		}
		return true;
	}
  	
	function store($data)
	{	
		$Prefix = "#__jinv_";
		$app =& JFactory::getApplication();
		$row =& $this->getTable();
	   $data 	= JRequest::get( 'post' );
	   $data['date'] = date("Y-m-d G.i:s<br>", time());
		if (!$row->bind($data)) {
			// $this->setError($this->_db->getErrorMsg());
			JError::raiseError(JText::_($this->_db->getErrorMsg()));
			return false;
		}
		if (!$row->store()) {
			// $this->setError($this->_db->getErrorMsg());
			JError::raiseError(JText::_($this->_db->getErrorMsg()));
			return false;
		}
		$Prefix = "jos_jinv_";
		$query="UPDATE " . $Prefix . "inventory SET onhand = onhand-" . $row->quantity . " WHERE partnumber = '" . $row->partnumber . "'";
		$errorMessage = 'Error Code-UsageModel' .  __LINE__  . ' Unable to update inventory on hand';
		$this->_data =& modelData::getInsertUpdate($query,'Joomla',$errorMessage,null,0);
		$query="SELECT description FROM " . $Prefix . "inventory WHERE  partnumber = '" . $row->partnumber . "'";
		$errorMessage = 'Error Code-UsageModel' .  __LINE__  . ' Unable to select inventory part number ' . $row->partnumber;
		$description =& modelData::getResult($query,'Joomla',$errorMessage,null,0);
		$app->enqueueMessage($row->partnumber . " " . $description . JText::_(' - Usage Recorded'));
		return true;		
	}	
	  	
	function _buildQuery()
	{
		$query = ' SELECT * FROM '.$this->_table_prefix.'usage';

		return $query;
	}
	function checkpart(){
		$post			= JRequest::get('request');
		$PartNumber = $post['partnumber'];
		$db 			= &JFactory::getDBO();
		$this->_table_prefix = '#__jinv_';
		$db->setQuery( "SELECT partnumber FROM " . $this->_table_prefix . "inventory 
		                        WHERE partnumber = '" . $PartNumber . "'" );	
		If(!$db->loadRow()){
			return false;
		}
		return true;
	}
}

?>
