<?php
/**
* @package Inventory
* @version 1.5
* @copyright Copyright (C) 2008 Mo Kelly. All rights reserved.
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class printpdfModelPrintpdf extends JModel
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
			$query = $this->_buildInventoryQuery();
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
		}
		return $this->_data;
	}	  	
	function _buildInventoryQuery($cid = array())
	{
		$cid = $_SESSION['cid'];
		$cids = implode( ',', $cid );
		$query = ' SELECT * FROM '.$this->_table_prefix.'inventory WHERE id IN ( '.$cids.' ) ORDER BY partnumber';
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
