<?php
/**
 * @version SVN: $Id$
 * @package    team
 * @subpackage Models
 * @author     Mo Kelly {@link http://www.joomlamo.com Integration King!}
 * @author     Mo Kelly {@link http://joomlamo.com}
 * @author     Created on 04-Aug-10
 * @license    GNU/GPL
 * This program is free software: you can redistribute it and/or modify    
 *  it under the terms of the GNU General Public License as published by
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

//-- No direct access
defined('_JEXEC') or die('=;)');

jimport('joomla.application.component.model');

class teamsModelteamss extends JModel
{
    var $_data;
    var $_total = null;
    var $_pagination = null;

    function __construct()
    {
        parent::__construct();
        global $mainframe, $option;
        $this->filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'.filter_order_Dir', 'filter_order_Dir', '', 'word' );
        //_ECR_MAT_ORDERING_MODAL1_
        $this->filter_order	= $mainframe->getUserStateFromRequest( $option.'.filter_order', 'filter_order',	'ordering', 'cmd' );

        $this->search		= $mainframe->getUserStateFromRequest( "$option.search", 'search', '', 'string' );
		  $post	= JRequest::get('request');
		  If(array_key_exists('searchsource', $post)){
		  		$mainframe->setUserState( "searchsource",$post['searchsource']);
		  }
        If($mainframe->getUserState( "searchsource") <> 'teams'){
        	$this->search='';
        }        
        $this->search		= JString::strtolower( $this->search );

        $limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
        $limitstart	= $mainframe->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);
    }

    function _buildQuery()
    {
        $where = array();

        if ($this->search)
        {
            $where[] = 'LOWER(Name) LIKE \''. $this->search. '\'';
        }
        $user =& JFactory::getUser();
        $UserID = $user->id;
		  $where[] = " userid = $UserID ";
        $where =( count($where) ) ? ' WHERE ' . implode( ' AND ', $where ) : '';
        $orderby = '';

        #_ECR_MAT_FILTER_MODEL1_
        if (($this->filter_order =='Description' OR 	 $this->filter_order =='League' ) && ($this->filter_order_Dir))
        {
            $orderby 	= ' ORDER BY '. $this->filter_order .' '. $this->filter_order_Dir;
            If(strlen(trim($orderby)) > 200){
            	$orderby = '';
            }
        }

        $this->_query = ' SELECT *'
        . ' FROM #__team_teams'
        . $where
        . $orderby
        ;

        return $this->_query;
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

    function getList()
    {
        // table ordering
        $lists['order_Dir']	= $this->filter_order_Dir;
        $lists['order']		= $this->filter_order;

        // search filter
        $lists['search']= $this->search;

        return $lists;
    }

    function getTotal()
    {
        // Load the content if it doesn't already exist
        if (empty($this->_total))
        {
            $query = $this->_buildQuery();
            $this->_total = $this->_getListCount($query);
        }

        return $this->_total;
    }

    function getPagination()
    {
        // Load the content if it doesn't already exist
        if (empty($this->_pagination))
        {
            jimport('joomla.html.pagination');
            $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
        }

        return $this->_pagination;
    }
    function store($data)
    {
    	$db =& JFactory::getDBO();
    	$user =& JFactory::getUser();
      $UserID = $user->id;
    	If($data['TeamID'] > 0){
			$query = "UPDATE #__team_teams ";
			$where = " WHERE TeamID = " . $data['TeamID'] . " ";
		}else{
    		echo "stopInsert<br>";
			$query = "INSERT INTO #__team_teams ";
			$where = '';
		}
		$query = $query . " SET TeamName 	 		='" . $data['TeamName'] 			. "',
		 								TeamDescription	='" . $data['TeamDescription'] 	. "', 
		 								TeamLeague			= " . $data['TeamLeague'] 			. " ,
		 								userid				= " . $UserID                    . " " . $where; 	
      	$db->setQuery($query);	
      	$result = $db->query();	
        	return true;
    }//function
    function delete()
	{
		$db =& JFactory::getDBO();
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$cidstring = "'" . implode("','", $cids) . "'";
		if (count( $cids )) {
			$query = 'DELETE FROM #__team_teams WHERE TeamID IN(' . $cidstring . ')';
			$db->setQuery($query);
			If(!$result = $db->query()){
				return false;
			}
		}
		return true;       
    }//function

    function getOneTeam()
    {
        $TeamID = JRequest::getVar('cid');
        $query = "SELECT * FROM jos_team_teams WHERE TeamID = " . $TeamID[0];
        $db =& JFactory::getDBO();
        $db->setQuery($query);
        If(!$row = $db->loadAssoc())
        {
        	 $row = (array) $this->getTable('jos_team_teams');
        } 
        return $row;
    }//function
}// class
