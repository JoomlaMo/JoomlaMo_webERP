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


class inventory_detailModelinventory_detail extends JModel
{
	/**
	 * inventory_detail id
	 *
	 * @var int
	 */
	var $_id = null;

	/**
	 * inventory_detail data
	 *
	 * @var array
	 */
	var $_data = null;

  /**
	 * table_prefix - table prefix for all component table
	 * 
	 * @var string
	 */
	var $_table_prefix = null;
	
	/**
	 * Constructor
	 *
	 *	set id of inventory detail 
	 * @since 1.5
	 */
	function __construct()
	{
		parent::__construct();
		$mainframe = JFactory::getApplication();

		//initialize class property
	  $this->_table_prefix = '#__jinv_';		
	  
		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}

	function setId($id)
	{
		// Set inventory_detail id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	function &getData()
	{
		// exit;
		//DEVNOTE:  Load the inventory_detail data
		if (!$this->_loadData())
		{  
			$this->_initData();
		}
   	return $this->_data;
	}

	function checkout($uid = null)
	{
		if ($this->_id)
		{
			if (is_null($uid)) {
				$user	=& JFactory::getUser();
				$uid	= $user->get('id');
			}
			// Lets get to it and checkout the thing...
			$inventory_detail = & $this->getTable();
			
			
			if(!$inventory_detail->checkout($uid, $this->_id)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}

			return true;
		}
		return false;
	}

	function checkin()
	{
		if ($this->_id)
		{
			$inventory_detail = & $this->getTable();
			if(! $inventory_detail->checkin($this->_id)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return false;
	}	


		
	function _loadData()
	{
		if (empty($this->_data))
		{
			$query = 'SELECT * FROM '.$this->_table_prefix.'inventory '.
 			'WHERE id = '. $this->_id;
			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();
			return (boolean) $this->_data;
		}
		return true;
	}

	function _initData()
	{
		if (empty($this->_data))
		{
			$detail = new stdClass();
			$detail->id						= 0;
			$detail->partnumber			= null;
			$detail->description			= null;
			$detail->onhand				= 0;
			$detail->reorderlevel		= 0;			
			$detail->reorderquantity	= 0;	
			$detail->published			= null;		
			$this->_data				 	= $detail;
			return (boolean) $this->_data;
		}
		return true;
	}
  	
	function store($data)
	{		 	
	 	//DEVNOTE: give me JTable object			 	
		$row =& $this->getTable();
		var_dump($row);
		echo "<BR><BR>";
		var_dump($data);
		//DEVNOTE: Bind the form fields to the inventory table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			echo $this->_db->getErrorMsg(). "= this->_db->getErrorMsg()<BR>";EXIT;
			return false;
		}
		// if (!$row->check()) {
		// 	$this->setError($this->_db->getErrorMsg());
		// 	return false;
		// }
		// exit;
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			echo $this->_db->getErrorMsg(). "= this->_db->getErrorMsg()<BR>";EXIT;
			return false;
		}
		return true;
	}

	function delete($cid = array())
	{
		$result = false;


		if (count( $cid ))
		{
			$cids = implode( ',', $cid );
			$query = 'DELETE FROM '.$this->_table_prefix.'inventory WHERE id IN ( '.$cids.' )';
			$this->_db->setQuery( $query );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}

		return true;
	}
}

?>
