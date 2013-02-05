<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class keywordModelkeyword extends JModel
{

	var $_data = null;

	var $_total = null;

	var $_pagination = null;

 	var $_table_prefix = null;

	function __construct()
	{
		  parent::__construct();

        $application = JFactory::getApplication('administrator');

        //-- Get pagination request variables
        $limit = $application->getUserStateFromRequest('global.list.limit', 'limit', $application->getCfg('list_limit'), 'int');
        $limitstart = $application->getUserStateFromRequest('com_seehowtodojoomla6.limitstart', 'limitstart', 0, 'int');

        //-- In case limit has been changed, adjust it
        $limitstart =($limit != 0) ? floor($limitstart / $limit) * $limit : 0;

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
		If(count($this->_data) == 0 and $this->getState('limitstart')> 0){
			$query = $this->_buildQuery();
			$this->_data = $this->_getList($query, 0, $this->getState('limit'));
		}
		return $this->_data;
	}
	function getAsset_Types(){	
		$db = &JFactory::getDBO();
		$this->_table_prefix = '#__ep_';
		$db->setQuery( "SELECT * FROM " . $this->_table_prefix . "asset_type ORDER BY description");	                 
		$rows = $db->loadObjectList();
  		foreach ( $rows as $row ) {
    		$id 	= $row->id;
    		$Asset_Types['description'][$id]		= $row->description;
    	}
	  	return $Asset_Types;
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
		$Asset_Types = $this->getAsset_Types();	
		$post	= JRequest::get('post');
		If(isset($post['search']) AND strlen(trim($post['search']))>0){
				$Search = (string)$post['search'];
				$where =" WHERE description LIKE '%" . $Search . "%'";	
		}else{
			If(isset($post['asset_type']) AND $post['asset_type'] <> 'ALL'){
				$mid = $post['asset_type'];
				$where = " WHERE asset_type = '" . $mid . "'";	
			}else{
				$where = '';
			}
		}
		$this->_table_prefix = "#__ep_";
		$query = ' SELECT * FROM '.$this->_table_prefix.'keyword ' . $where . ' ORDER BY asset_type,description';
		return $query;
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
		$this->_table_prefix = "#__ep_";
		if (count( $cid ))
		{
			$cids = implode( ',', $cid );
			// echo $cids  . "=cids<br>";
			$query = 'DELETE FROM '.$this->_table_prefix.'keyword WHERE id IN ( '.$cids.' )';
			// echo $query  . "=query<br>";exit;
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
