<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class locationsModellocations extends JModel
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
		// maybe we have added a filter if we get no data and limit start is > 0 then
		// the filtered data has fewer elements than the last limit start without a filter.
		If(count($this->_data) == 0 and $this->getState('limitstart')> 0){
			$query = $this->_buildQuery();
			$this->_data = $this->_getList($query, 0, $this->getState('limit'));
		}
		return $this->_data;
	}
	
	function getTotal()
	{
		if (empty($this->_total))
		{
			$query = $this->_buildQuery();
			$this->_db->setQuery( $query );
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
		$post	= JRequest::get('post');
		If(isset($post['search']) AND strlen(trim($post['search']))>0){
				$Search = (string)$post['search'];
				$where =" WHERE description LIKE '%" . $Search . "%'";	
		}else{
			$where ="";
		}	
		$this->_table_prefix = "#__ep_";
		$query = ' SELECT * FROM '.$this->_table_prefix.'locations ' . $where . ' ORDER BY description';
		return $query;
	}
	function delete($cid = array())
	{
		// echo '<pre>';var_dump($cid , '<br><br> <b style="color:brown">cid88</b><br><br>');echo '</pre>';exit;
		$this->_table_prefix = "#__ep_";
		if (count( $cid ))
		{
			$cids = implode( ',', $cid );
			$query = 'DELETE FROM '.$this->_table_prefix.'locations WHERE id IN ( '.$cids.' )';
			// echo $query  . "=query93<br>";exit;
			$this->_db->setQuery( $query );
			if(!$this->_db->query()) {
				echo $this->_db->getErrorMsg();
				return false;
			}
		}
		return true;
	}
}
?>
