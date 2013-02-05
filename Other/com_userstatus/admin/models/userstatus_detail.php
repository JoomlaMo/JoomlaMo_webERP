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
class userstatus_detailModeluserstatus_detail extends JModel
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

  	
	function _buildQuery()
	{
		$this->_table_prefix = "#__";
		$userstatus_table_prefix = "#__sts_";
		$post	= JRequest::get('post');
		If($post['task'] == 'edit'){
			$query =  'SELECT * FROM '.$this->_table_prefix.'users '.
 			              		'WHERE id =(SELECT user FROM '.$userstatus_table_prefix.'userstatus WHERE id = ' . $post['cid'][0] . ')';
		}else{
			$query =  'SELECT * FROM '.$this->_table_prefix.'users '.
 			              		'WHERE id not in (SELECT user FROM '.$userstatus_table_prefix.'userstatus )';
 		}
 		return $query;
	}

	
	function createuserstatus_detail(){
		$post	= JRequest::get('post');
		// $this->var_dump_pre($post);echo "<br><br>post<BR><BR><BR>";
		$data['status']		= intval($post['Status']);
		$data['user'] 			= intval($post['User']);
		$data['location'] 	= intval($post['Location']);
		// $this->var_dump_pre($data);echo "<br><br>data<BR><BR><BR>";exit;
		if(isset($post['id'])){
			$data['id'] 	= intval($post['id']);
		}
		$this->deleteuserstatus_detail($data['user']);
		$row =& $this->getTable('userstatus');
		if (!$row->bind($data)) {
			echo $this->setError($this->_db->getErrorMsg());
			return false;
		}
		if (!$row->store()) {
			echo $this->setError($this->_db->getErrorMsg());
			return false;
		}
	}
	function getUserStatusLocation($user){
		$db = &JFactory::getDBO();
		$this->_table_prefix = '#__sts_';
		$query = "SELECT status,location FROM " . $this->_table_prefix . "userstatus WHERE id=" . $user ;
		$db->setQuery($query );	
		// echo $query  . "=query  M l 81<br>";  
		$UserStatusLocation = $db->loadAssoc();
		// $this->var_dump_pre($UserStatusLocation);echo "<br><br>UserStatusLocation m l 83<BR><BR><BR>";exit;
		return $UserStatusLocation;
	}
	function deleteuserstatus_detail($user){
		$this->_table_prefix = '#_sts_';
		$post	= JRequest::get('post');
		If(isset($user) and strlen(trim($user)) > 0){
			$query = "DELETE FROM " . $this->_table_prefix . "userstatus WHERE user=" . $user ;
			$result = mysql_query($query);
		}
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
	function getLocationDescriptions(){	
		$db = &JFactory::getDBO();
		$this->_table_prefix = '#__sts_';
		$query = "SELECT * FROM " . $this->_table_prefix . "locations ORDER BY county,city,description";
		$db->setQuery($query );	                 
		$LocationDescriptions = $db->loadAssocList();
		return $LocationDescriptions;
	}	
	function var_dump_pre($mixed = null) {
  		echo '<pre>';
  		var_dump($mixed);
  		echo '</pre>';
  		return null;
	}
}	
?>

