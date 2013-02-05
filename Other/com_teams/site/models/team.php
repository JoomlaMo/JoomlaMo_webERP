<?php
/**
 * @version SVN: $Id$
 * @package    baseballsoftware
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

class teamsModelteam extends JModel
{
    function __construct()
    {
        parent::__construct();
    }//function

    function store($data)
    {   	
    	If(!teamsModelteam::DataOK($data)){
    		$app =& JFactory::getApplication();
    		$app->enqueueMessage(JText::_('Invalid data entereed'));
      	return false;
    	}
    	$db =& JFactory::getDBO();
    	$user =& JFactory::getUser();
      $UserID = $user->id;
    	If($data['TeamID'] > 0){
			$query = "UPDATE #__team_teams ";
			$where = " WHERE TeamID = " . $data['TeamID'] . " ";
		}else{
			$query = "INSERT INTO #__team_teams ";
			$where = '';
		}
		$query = $query . " SET TeamName 	 		='" . $data['TeamName'] 			. "',
		 								TeamDescription	='" . $data['TeamDescription'] 	. "', 
		 								TeamLeague			= " . $data['TeamLeague'] 			. " ,
		 								LoftName				='" . $data['LoftName'] 			. "', 
		 								Address				='" . $data['Address'] 				. "',
		 								City					='" . $data['City'] 					. "', 
		 								State					='" . $data['State'] 				. "',
		 								ZipCode				='" . $data['ZipCode'] 				. "', 
		 								Phone					='" . $data['Phone'] 				. "',
		 								Email					='" . $data['Email'] 				. "',
		 								userid				= " . $UserID                    . " " . $where; 	
      $db->setQuery($query);
      If(!$result = $db->query()){
      	$app =& JFactory::getApplication();
    		$app->enqueueMessage(JText::_('Breeder Data Was Not Saved '));
    		return false;
      }	
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

    function getData()
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
    function DataOK($data){
    	global $mainframe;
    	$app =& JFactory::getApplication();
    	$BadData = 0;
 		$mainframe->setUserState( "TeamName",NULL);
 		$mainframe->setUserState( "TeamDescription",NULL);
    	foreach($data as $Name=>$Value){
    		If($Name == 'TeamName'){ 
    			If(!$this->sanityCheck($Value,'string',64)){
	    			$mainframe->setUserState( "TeamName",1);
    				$app->enqueueMessage(JText::_('<u>Invalid Team Name entereed</u>'));
    				$BadData = 1;
    			}
    		}
    		If($Name == 'TeamDescription'){
    			If(!$this->sanityCheck($Value,'string',64)){
	    			$mainframe->setUserState( "TeamDescription",1);
    				$app->enqueueMessage(JText::_('<u>Invalid Team Description entereed</u>'));
    				$BadData = 1;  
    			}
    		}    		
    	}     	
 		If($BadData){
 			return FALSE;
 		}else{
 			return TRUE;
 		}   	
    }
	 function sanityCheck($string, $type, $length)
	 {
	 	$ValidData = 1;
    	$app =& JFactory::getApplication();
	  	// assign the type
	  	$type = 'is_'.$type;
	  	if(!$type($string))
	  	{
    		$app->enqueueMessage(JText::_("Invalid data type. *<span style='color:black'>" . $type($string) . "</span>* Looking for *<span style='color:black'>" . substr($type,3) . "</span>* "));
	    	$ValidData = 0;
	  	}
	  	if(strlen($string) > $length){
    		$app->enqueueMessage(JText::_("String *<span style='color:black'>" .$string . "</span>*  Exceeds valid Length of *<span style='color:black'>" . $length . "</span>* "));
	    	$ValidData = 0;
	  	}
    	$StringArray = str_split($string);
    	$ValidCharacters = '	- abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890,';
    	Foreach($StringArray as $Count=>$Letter){
    		If(!strpos($ValidCharacters, $Letter) > 0){
 				$app->enqueueMessage(JText::_("Invalid Character in *<span style='color:black'>" . $string . "</span>*-the *<span style='color:black'>" . $Letter . "</span>* character is not allowed."));
    			$ValidData = 0;	    			
    		}
    	}
	    If($ValidData){
	    	return TRUE;
	    }else{
	    	return FALSE;	    
	    }
	    // if all is well, we return TRUE
	    return TRUE;
    }
}//class
