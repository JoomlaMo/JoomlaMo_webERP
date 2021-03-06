<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');
class keyword_detailModelkeyword_detail extends JModel
{
	var $_id = null;
	var $_data = null;
	var $_table_prefix = null;
	function __construct()
	{
		parent::__construct();
	  	$this->_table_prefix = '#__ep_';		  
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
			$query = 'SELECT * FROM '.$this->_table_prefix.'keyword '.
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
			$detail->asset_type	= null;
			$detail->description	= null;
			$detail->typeofdata	= 0;
			$detail->notes			= 0;	
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
			$query = 'DELETE FROM '.$this->_table_prefix.'keyword WHERE id IN ( '.$cids.' )';
			$this->_db->setQuery( $query );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			$query = 'DELETE FROM '.$this->_table_prefix.'specifications WHERE keyword_id IN ( '.$cids.' )';
			$this->_db->setQuery( $query );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return true;
	}
	function getAssetTypes(){
		$db = &JFactory::getDBO();
		$this->_table_prefix = '#__ep_';
		$db->setQuery( "SELECT * FROM " . $this->_table_prefix . "asset_type ORDER BY description" );	                 
		$rows = $db->loadObjectList();
  		foreach ( $rows as $row ) {
  			$typeid							= $row->id;
    		$assettypes[$typeid] 		= $row->description;
  		}
	  	return $assettypes;
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
			$keyword_detail = & $this->getTable();
			
			
			if(!$keyword_detail->checkout($uid, $this->_id)) {
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
			$keyword_detail = & $this->getTable();
			if(! $keyword_detail->checkin($this->_id)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return false;
	}	

}
?>
