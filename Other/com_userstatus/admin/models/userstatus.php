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

class UserstatusModelUserstatus extends JModel
{

	var $_data = null;

	var $_total = null;

	var $_pagination = null;

	var $_table_prefix = null;

	function __construct()
	{
		parent::__construct();

		global $mainframe, $context;
	  	$this->_table_prefix = '#__sts_';		
		$limit		= $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 0);
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0 );

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}
	
	function getData()
	{
		if (empty($this->_data))
		{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
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

		$this->_table_prefix = '#__sts_';
		$query = ' SELECT * FROM '.$this->_table_prefix.'userstatus' . ' ORDER BY user';
		return $query;
	}
	function getUserNames(){	
		$db = &JFactory::getDBO();
		$this->_table_prefix = '#__';
		$db->setQuery( "SELECT * FROM " . $this->_table_prefix . "users");	                 
		$rows = $db->loadObjectList();
  		foreach ( $rows as $row ) {
    		$id 	= $row->id;
    		$UserNames['name'][$id]		= $row->name;
    		$UserNames['username'][$id]= $row->username;
    	}
	  	return $UserNames;
	}	
	function getLocationDescriptions(){	
		$db = &JFactory::getDBO();
		$this->_table_prefix = '#__sts_';
		$db->setQuery( "SELECT * FROM " . $this->_table_prefix . "locations");	                 
		$rows = $db->loadObjectList();
		$LocationDescriptions = array();
		If(isset($rows) AND count($rows) > 0){
	  		foreach ( $rows as $row ) {
	    		$id 	= $row->id;
	    		$LocationDescriptions[$id]		= $row->description;
	    	}
	    }
	  	return $LocationDescriptions;
	}	
	function checkout($uid = null)
	{
		if ($this->_id)
		{
			if (is_null($uid)) {
				$user	=& JFactory::getUser();
				$uid	= $user->get('id');
			}
			$userstatus_detail = & $this->getTable();
			if(!$userstatus_detail->checkout($uid, $this->_id)) {
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
			$userstatus_detail = & $this->getTable();
			if(! $userstatus_detail->checkin($this->_id)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return false;
	}	
	function isCheckedOut( $uid=0 )
	{
		if ($this->_loadData())
		{
			if ($uid) {
				return ($this->_data->checked_out && $this->_data->checked_out != $uid);
			} else {
				return $this->_data->checked_out;
			}
		}
	}	
}	
?>