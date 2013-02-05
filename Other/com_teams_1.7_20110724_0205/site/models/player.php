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

class teamsModelplayer extends JModel
{
    function __construct()
    {
        parent::__construct();
    }//function

    function store($data)
    {
    	If(!teamsModelplayer::DataOK($data)){
    		$app =& JFactory::getApplication();
    		$app->enqueueMessage(JText::_('Invalid data entereed'),error);
      	return false;
    	}
    	$db =& JFactory::getDBO();
    	$user =& JFactory::getUser();
      $UserID = $user->id;
    	If($data['PlayerID'] > 0){
			$query = "UPDATE #__team_player ";
			$where = " WHERE PlayerID = " . $data['PlayerID'] . " ";
		}else{
			$query = "INSERT INTO #__team_player ";
			$where = '';
		}
		$query = $query . " SET FirstName	='" . $data['FirstName']. "',
		 								LastName		='" . $data['LastName'] . "', 
		 								Notes			='" . $data['Notes'] 	. "', 
		 								Active		='" . $data['Active'] 	. "', 
		 								userid		= " . $UserID         	. " " . $where; 	
      $db->setQuery($query);	
      $result = $db->query();
      If($data['PlayerID'] == 0){
      	$data['PlayerID'] = mysql_insert_id();
      }
      $query = 'DELETE FROM #__team_teamplayer WHERE PlayerID =' . $data['PlayerID'];
      $db->setQuery($query);
		$result = $db->query();     	
      Foreach($data["TeamNames"] as $TeamID=>$OnOff){
      	$query = "INSERT INTO #__team_teamplayer SET TeamID 	= " . $TeamID				. " ,
      																PlayerID	= " . $data['PlayerID']	. " ,     																	
     																	UserID 	= " . $UserID;
      	$db->setQuery($query);
			$result = $db->query();      																
      }
      $query = 'DELETE FROM #__team_playernumbers WHERE PlayerID =' . $data['PlayerID'];
      $db->setQuery($query);
		$result = $db->query(); 
      Foreach($data["UniformNumber"] as $UniformID=>$Number){
      	$query = "INSERT INTO #__team_playernumbers SET PlayerID	= " . $data['PlayerID']	. " ,
     																		UniformID= " . $UniformID			. " ,
     																		Number	= '" . $Number				. "' ,
     																		UserID 	= " . $UserID;     																		
			$db->setQuery($query);
			$result = $db->query();      																
      }      
      return true;
    }//function

    function delete()
    {
       $db =& JFactory::getDBO();

        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        $row =& $this->getTable('jos_team_player');
			$cidstring = "'" . implode("','", $cids) . "'";
        if (count( $cids )) {
            $query = 'DELETE FROM #__team_player WHERE PlayerID IN(' . $cidstring . ')';
            $db->setQuery($query);
				If(!$result = $db->query()){
					return false;
				}
        }
        return true;
    }//function

    function getData()
    {
        $PlayerID = JRequest::getVar('cid');
        $query = "SELECT * FROM jos_team_player WHERE PlayerID = " . $PlayerID[0];
        $db =& JFactory::getDBO();
        $db->setQuery($query);
        If(!$row =& $db->loadAssoc())
        {
        	 $row = (array) $this->getTable('jos_team_player');
        } 
        return $row;
    }//function
    function DataOK($data){
    	global $mainframe;
    	$app =& JFactory::getApplication();
    	$BadData = 0;
 		$mainframe->setUserState( "FirstName",NULL);
 		$mainframe->setUserState( "LastName",NULL);
 		$mainframe->setUserState( "Notes",NULL);
 		$mainframe->setUserState( "UniformNumber",NULL);
    	foreach($data as $Name=>$Value){
    		If((gettype($Value) =='array' OR strlen(trim($Value)) > 0) AND $Name <> "TeamNames" AND $Name <> "cid" AND $Name <> "option" AND $Name <> "task" AND $Name <> "controller"){
	    		echo "<br><br><br><br><br><br>";
	    		echo $Name  . "=Name<br>";
	    		echo $Value  . "=Value<br>";
	    		If($Name == 'FirstName'){ 
	    			If(!$this->sanityCheck($Value,'string',20)){
	    				$mainframe->setUserState( "FirstName",1);
	    				$app->enqueueMessage(JText::_('INVALID_FIRST_NAME_ENTEREED'));
	    				$BadData = 1;
	    			}
	    		}
	    		If($Name == 'LastName'){
	    			If(!$this->sanityCheck($Value,'string',20)){
	    				$mainframe->setUserState( "LastName",1);
	    				$app->enqueueMessage(JText::_('INVALID_LAST_NAME_ENTEREED'));
	    				$BadData = 1;
	    			}
	    		}
	    		If($Name == 'Notes'){
	    			If(!$this->sanityCheck($Value,'string',250)){
	    				$mainframe->setUserState( "Notes",1);
	    				$app->enqueueMessage(JText::_('INVALID_NOTES_ENTEREED'));
	    				$BadData = 1;
	    			}
	    		}
	    		echo $Name  . "=Name<br>";
	    		If(substr($Name,0,13) == 'UniformNumber'){
	    			Foreach($Value as $key=>$Number){
	    				echo $key  . "=key<br>";
	    				echo $Number  . "=Number<br>";
	    				If(strlen(trim($Number)) > 0){
		    				If(!$this->sanityCheck($Number,'string',20)){
	    						$mainframe->setUserState( "UniformNumber",1);
		    					$app->enqueueMessage(JText::_('<u>Invalid Uniform Number entered</u>'));
		    					$BadData = 1;
		    				}
		    			} 
		    		}   			
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
    		$app->enqueueMessage(JText::_("Invalid data type. *<span style='color:black'>" . $string . "</span>* is not *<span style='color:black'>"  . substr($type,3) . "</span>*  Looking for *<span style='color:black'>" . substr($type,3) . "</span>* "));
	    	$ValidData = 0;
	  	}
	  	if(strlen($string) > $length){
    		$app->enqueueMessage(JText::_("String *<span style='color:black'>" .$string. "</span>* Exceeds valid Length of *<span style='color:black'>" . $length . "</span>* "));
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
