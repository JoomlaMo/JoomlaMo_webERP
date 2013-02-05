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

class locationsModellocations extends JModel
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
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0 );
		$limit		= $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 0);
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
		$this->_table_prefix = "#__sts_";
		$query = ' SELECT * FROM '.$this->_table_prefix.'locations ' . $where . ' ORDER BY description';
		return $query;
	}
}
?>
