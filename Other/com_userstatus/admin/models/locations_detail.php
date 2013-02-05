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
class locations_detailModellocations_detail extends JModel
{
	var $_id = null;
	var $_data = null;
	var $_table_prefix = null;
	
	function __construct()	{
		parent::__construct();
	  	$this->_table_prefix = '#__sts_';		  
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
	function _loadData()
	{
		if (empty($this->_data))
		{
			$query = 'SELECT * FROM '.$this->_table_prefix.'locations '.
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
			$detail->id				= 0;
			$detail->description	= null;
			$detail->address		= null;
			$detail->city			= 0;
			$detail->county		= 0;
			$detail->state			= 0;
			$detail->zip			= null;	
			$detail->notes			= null;			
			$this->_data			= $detail;
			return (boolean) $this->_data;
		}
		return true;
	}  	
	function store($data)
	{		 			 	
		$row =& $this->getTable();
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
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
			$query = 'DELETE FROM '.$this->_table_prefix.'locations WHERE id IN ( '.$cids.' )';
			$this->_db->setQuery( $query );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return true;
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
			$locations_detail = & $this->getTable();
			
			
			if(!$locations_detail->checkout($uid, $this->_id)) {
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
			$locations_detail = & $this->getTable();
			if(! $locations_detail->checkin($this->_id)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return false;
	}	

}

?>
