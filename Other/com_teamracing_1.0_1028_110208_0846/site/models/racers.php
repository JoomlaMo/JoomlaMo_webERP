<?php
/**
 * @version SVN: $Id$
 * @package    teamrace
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

class teamracingModelracers extends JModel
{
    var $_data;
    var $_total = null;
    var $_pagination = null;

    function __construct()
    {
        parent::__construct();
        global $mainframe, $option, $limit, $limitstart;
        $this->filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'.filter_order_Dir', 'filter_order_Dir', '', 'word' );
        //_ECR_MAT_ORDERING_MODAL1_
        $this->filter_order	= $mainframe->getUserStateFromRequest( $option.'.filter_order', 'filter_order',	'ordering', 'cmd' );

        $this->search= $mainframe->getUserStateFromRequest( "$option.search", 'search', '', 'string' );
		  $post	= JRequest::get('request');
		  If(array_key_exists('searchsource', $post)){
		  		$mainframe->setUserState( "searchsource",$post['searchsource']);
		  }
        If($mainframe->getUserState( "searchsource") <> 'racer'){
        	$this->search='';
        }
        $this->search= JString::strtolower( $this->search );

        $limit			= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
        $limitstart	= $mainframe->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );
        $limitstart 	= ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);
    }

    function getData()
    {        
        	$query = ' SELECT * FROM #__team_rfid_time';
        	$db =& JFactory::getDBO();
    		$db->setQuery($query);	
    		$raceresult = $db->loadAssocList();
        	foreach($raceresult as $count=>$resultsarray){
        		$RaceResults[$count]['TagID'] 	= $resultsarray['rf_id'];
        		$RaceResults[$count]['Time']  	= $resultsarray['cur_timestamp'];
        		$RaceResults[$count]['LoftID'] 	= $resultsarray['loft_id'];
        		// find player id
        		$uniformquery = "SELECT #__team_playernumbers.PlayerID        				 
        								 FROM	#__team_playernumbers
        					  		   WHERE	#__team_playernumbers.Number = '" . $RaceResults[$count]['TagID'] . "'";        		
    			$db->setQuery($uniformquery);				  
        		$RaceResults[$count]['PlayerID'] = $db->loadResult();			  
        		$playerquery = "SELECT 	#__team_player.FirstName as Color,
        										#__team_player.LastName as Sex	
        								FROM	#__team_player 
        					  		  WHERE	#__team_player.PlayerID = " . $RaceResults[$count]['PlayerID']  ;
    			$db->setQuery($playerquery);
    			$PlayerData = $db->loadAssoc();
    			$playerteamquery = "SELECT TeamID FROM	#__team_teamplayer WHERE PlayerID = " . $RaceResults[$count]['PlayerID'];
    			$db->setQuery($playerteamquery);
        		$RaceResults[$count]['TeamID'] 	= $db->loadResult();	
    			$teamquery = "SELECT TeamName,LoftName FROM	#__team_teams WHERE TeamID  = " . $RaceResults[$count]['TeamID'];
    			$db->setQuery($teamquery);
    			$row = $db->loadAssoc();
        		$RaceResults[$count]['TeamName']	= $row['TeamName'];
        		$RaceResults[$count]['LoftName']	= $row['LoftName'];	        		
				$RaceResults[$count]['Color'] 	= $PlayerData['Color'];
				$RaceResults[$count]['Sex'] 		= $PlayerData['Sex'];
				$RaceResults[$count]['Speed'] 	= 'Speed here';
        	}

        return $RaceResults;
    }

    function UpdateRaceRecords() {
    	global $mainframe;
    	$TimeStart = 32;
    	$TagIDStart = 16;
    	$lines = file(JPATH_SITE . DS . 'components' . DS . 'com_teamracing' . DS. 'data' . DS . 'race.txt');
		foreach ($lines as $line_num => $line) {
			// Skip lines that do not make sense
			If(substr($line, 0, 4)=='0000'){
				continue;
			}
			$Time = substr($line, $TimeStart, 2) . ":" . substr($line, $TimeStart+2, 2) . ":" . substr($line, $TimeStart+4, 2);
			$TagID =  substr($line, $TagIDStart, 6);
    		$query = 'UPDATE #__team_rfid_time 
    						 SET time = ' . date('Y-m-d') . ' ' . $Time . ', 
    						     tagid =  
    					  WHERE player=' . $TagID . ' AND 
    					  		  substring(time,0,8) = "' . date('Y-m-d') . '"';
    		$db =& JFactory::getDBO();
    		$db->setQuery($query);	
      	$result = $db->query();
		}
		return True;    
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

    function getTotal($items)
    {
        // Load the content if it doesn't already exist
        if (empty($this->_total))
        {
            $this->_total = count($items);
        }

        return $this->_total;
    }

    function getPagination($items)
    {
    		global $limit, $limitstart;
        // Load the content if it doesn't already exist
        if (empty($this->_pagination))
        {
            jimport('joomla.html.pagination');
            $this->_pagination = new JPagination(teamracingModelracers::getTotal($items), $limitstart, $limit);
        }

        return $this->_pagination;
    }
}// class