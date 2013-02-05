<?php
/**
* @package Inventory
* @version 1.5
* @copyright Copyright (C) 2008 Mo Kelly. All rights reserved.
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class ReceiptsModelReceipts extends JModel
{
	var $_id = null;

	var $_data = null;
	
	var $_pagination = null;

	var $_table_prefix = null;
	
	function __construct()
	{
		parent::__construct();

		global $mainframe, $context;
		
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
			$query = $this->_buildOrderQuery();
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
		}
		return $this->_data;
	}
	function getTotal()
	{
		//DEVNOTE: Lets load the content if it doesn't already exist
		if (empty($this->_total))
		{
			$query = $this->_buildOrderQuery();
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

	  	
	function _buildOrderQuery()
	{
		$query = "SELECT id, reference, date FROM " . $this->_table_prefix . "receipts order by date";
		return $query;
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
