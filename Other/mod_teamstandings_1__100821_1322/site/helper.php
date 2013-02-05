<?php
/**
 * @version SVN: $Id$
 * @package    teamstandings
 * @subpackage Base
 * @author     Mo Kelly {@link http://www.joomlamo.com Integration King!}
 * @author     Mo Kelly {@link http://joomlamo.com}
 * @author     Created on 21-Aug-2010
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

/**
 * Helper class for teamstandings
 */
class ModteamstandingsHelper
{
    /**
     * Returns a list of random users
     */
    function getGames()
    {
		  global $UserID;
        $db = &JFactory::getDBO();
		  $where = array();
        $user =& JFactory::getUser();
        $UserID = $user->id;
		  $where[] = " userid = $UserID ";
		  $where[] = " Date <= '" . date('Y-m-d') . "' ";
		  $where[] = " Time <= '" . time() . "' ";
        $where =( count($where) ) ? implode( ' AND ', $where ) : '';
        $orderby = " ORDER BY TeamID ";
        //-- Get a list of all users
        $query = 'SELECT 	TeamID,
        							Us,
        							Them 
        					FROM `#__team_games` 
        				  WHERE  ' . $where
        				. $orderby;
        $db->setQuery($query);
        $games =($games = $db->loadAssocList('TeamID')) ? $games : array();
        return $games;
    }
    function getRecord($games)
    {       
        $Record = array();
		  foreach($games as $TeamID=>$Data){
		  		$TeamID = strval($TeamID);
		  		If(!isset($Record[$TeamID]['wins'])){
		  			$Record[$TeamID]['wins'] = 0;
		  		}
		  		If(!isset($Record[$TeamID]['ties'])){
		  			$Record[$TeamID]['ties'] = 0;
		  		}
		  		If(!isset($Record[$TeamID]['losses'])){
		  			$Record[$TeamID]['losses'] = 0;
		  		}
        		If($Data['Us'] > $Data['Them']){
			  		$Record[$TeamID]['wins'] += 1;  
			  	}elseif($Data['Us'] == $Data['Them']) {		
			  		$Record[$TeamID]['ties'] += 1; 
			  	}else {
			  		$Record[$TeamID]['losses'] += 1;
			   }	
		  }
		  return $Record;
	 }
    function getTeams($Record,$Standings_params)
    {
		  global $UserID, $TeamNames;
		  $db 		=& JFactory::getDBO();
		  $post		= JRequest::get('request');
		  $where = array();
		  If(array_key_exists('LeagueChoice',$post) AND $post['LeagueChoice'] <> 'AllLeagues'){
			$LeagueChoice = intval($post['LeagueChoice']);
			$where[] = " TeamLeague = " . $LeagueChoice . " ";			
		  }
		  $where[] = " userid = $UserID ";
        $where =( count($where) ) ? implode( ' AND ', $where ) : '';
        $orderby = " ORDER BY TeamName ";
        //-- Get a list of all users
        $query = 'SELECT 	TeamID,
        							TeamName 
        					FROM `#__team_teams` 
        				  WHERE  ' . $where
        				. $orderby;
        $db->setQuery($query);
        $teams =($teams = $db->loadAssocList('TeamID')) ? $teams : array();
        
        $Standings = array();
        Foreach($teams as $TeamID=>$TeamName){
        	If(isset($Record[$TeamID]['wins']) OR isset($Record[$TeamID]['ties']) OR isset($Record[$TeamID]['losses'])){
        		$TeamNames[$TeamID] = $TeamName;
        		If($Standings_params['StandingType'] == 1 ){
        			$Standings[$TeamID]		 = ($Record[$TeamID]['wins']
													 + (.5*$Record[$TeamID]['ties']))
													 /($Record[$TeamID]['wins']
													 +$Record[$TeamID]['ties']
													 +$Record[$TeamID]['losses']);
				}else {
					$Standings[$TeamID]		 = (($Record[$TeamID]['wins']	*$Standings_params['WinPoints'])
													 +  ($Record[$TeamID]['ties']	*$Standings_params['TiePoints'])
													 +  ($Record[$TeamID]['losses']*$Standings_params['LoosePoints']))	;
				}
			}
		  }
        return $Standings;
    }//function
	 function getLeagues()
    {
		  global $UserID;
		  $db 		=& JFactory::getDBO();
		  $Games 		=& ModteamstandingsHelper::getGames();
		  $TeamArray = array();
		  Foreach($Games as $GamesID=>$GamesArray){
		  	$TeamArray[$GamesArray['TeamID']] = $GamesArray['TeamID'] ;
		  }
		  $TeamList = implode(",",	$TeamArray);
		  $query = 'SELECT 	DISTINCT TeamLeague 
        					FROM `#__team_teams` 
        				  WHERE  TeamID IN(' . $TeamList . ')';
        $db->setQuery($query);
        $LeagueArray =($LeagueArray = $db->loadResultArray()) ? $LeagueArray : array();
        $LeagueList = implode(",",	$LeagueArray);
		  $where = array();		  
		  $where[] = " LeagueID IN(" . $LeagueList . " ) ";
		  $where[] = " userid =" . $UserID . " ";
        $where =( count($where) ) ? implode( ' AND ', $where ) : '';
        $orderby = " ORDER BY LeagueName ";
        //-- Get a list of all users
        $query = 'SELECT 	LeagueID,
        							LeagueName 
        					FROM `#__team_leagues` 
        				  WHERE  ' . $where
        				. $orderby;
        $db->setQuery($query);
        $Leagues =($Leagues = $db->loadAssocList('LeagueID')) ? $Leagues : array(); 
        return $Leagues;
    }//function
}//class
