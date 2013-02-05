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

class teamracingModelracer extends JModel
{
    function __construct()
    {
        parent::__construct();
    }//function

    function store($data)
    {    	
    	$app =& JFactory::getApplication();
    	If(!teamracingModelracer::DataOK($data)){
    		$app->enqueueMessage(JText::_('Invalid data entereed'));
      	return false;
    	}
    	$db =& JFactory::getDBO();
    	If($data['racerID'] > 0){
			$query = "UPDATE #__team_games ";
			$where = " WHERE GameID = " . $data['GameID'] . " ";
		}else{
			$query = "INSERT INTO #__team_racers ";
			$where = '';
		}	
		echo $data['Date']  . "=data['Date']<br>";
		If(strpos($data['Date'], " ") > 0){
			$data['Date'] = str_replace(" ", "-", $data['Date']);
		}
		If(strlen(trim($data['Us'])) == 0){
			$data['Us'] = 0;
		}
		If(strlen(trim($data['Them'])) == 0){
			$data['Them'] = 0;
		}
		$Year = substr($data['Date'], strrpos($data['Date'], "-")+1);
		$Month	= substr($data['Date'],0, strpos($data['Date'], "-"));
		$Day= substr($data['Date'], strpos($data['Date'], "-")+1,2);
		$GameDate = $Year . "-" . $Month . "-" . $Day;
		$query = $query . " SET Date 	 		='" . $GameDate				. "',
		 								Time 	 		='" . $data['Time'] 			. ":00',
		 								Opponent		='" . $data['Opponent'] 	. "', 	
		 								Location		='" . $data['Location'] 	. "', 	
		 								Description	='" . $data['Description'] . "', 	
		 								TeamID 		= " . $data['TeamID'] 		. " , 	
		 								UniformID 	= " . $data['UniformID'] 	. " , 	
		 								Directions 	='" . $data['Directions'] 	. "', 	
		 								Us 			= " . $data['Us'] 			. " , 	
		 								Them 			= " . $data['Them'] 			. " , 	
		 								Notes 		='" . $data['Notes'] 		. "', 	
		 								userid		= " . $data['userid'] 		. " " . $where; 	
      	$db->setQuery($query);	
      	If(!$result = $db->query()){		
      		$app->enqueueMessage(JText::_($db->getErrorMsg($result)));	
      		return FALSE;
      	}else {		
        		return true;
        	}
    }//function

    function delete()
    {
		$db =& JFactory::getDBO();
      $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$cidstring = "'" . implode("','", $cids) . "'";
      if (count( $cids )) {
         $query = 'DELETE FROM #__team_race WHERE GameID IN(' . $cidstring . ')';
         $db->setQuery($query);
			If(!$result = $db->query()){
				return false;
			}
      }
        return true;
    }//function

    function getData()
    {
        $GameID = JRequest::getVar('cid');
        $query = "SELECT * FROM jos_team_games WHERE GameID = " . $GameID[0];
        $db =& JFactory::getDBO();
        $db->setQuery($query);
        If(!$row = $db->loadAssoc())
        {
        	 $row = (array)$this->getTable('jos_team_games');
        } 
        return $row;
    }//function
	function DataOK($data){
		global $mainframe;
    	$app =& JFactory::getApplication();
    	$BadData = 0; 		
 		$mainframe->setUserState( "Date",NULL);
 		$mainframe->setUserState( "Time",NULL);
 		$mainframe->setUserState( "Opponent",NULL);
 		$mainframe->setUserState( "Location",NULL);
 		$mainframe->setUserState( "Description",NULL);
 		$mainframe->setUserState( "Directions",NULL);
 		$mainframe->setUserState( "Us",NULL);
 		$mainframe->setUserState( "Them",NULL);
 		$mainframe->setUserState( "Notes",NULL);
    	foreach($data as $Name=>$Value){
    		// echo $Name  . "=Name<br>";
    		If($Name <> 'cid' AND strlen(trim($Value)) > 0){
    			// echo $Value  . "=Value<br>";
	    		If(strtoupper($Name) == 'DATE'){ 
	    			// echo $Value  . "=Value<br>";
	    			$Month = substr($Value,0,2);
	    			$Day = substr($Value,3,2);
	    			$Year = substr($Value,6,4);
	    			// echo $Month  . "=Month<br>";
	    			// echo $Day  . "=Day<br>";
	    			// echo $Year  . "=Year<br>";exit;
	    			If(!checkdate($Month,$Day,$Year)){
	    				$mainframe->setUserState( "Date",1);
	    				$app->enqueueMessage(JText::_('<u>Invalid Date entereed</u>'));
	    				$BadData = 1;
	    			}
	    		}
	    		If($Name == 'Time'){
	    			If(!$this->sanityCheck($Value,'string',8)){
	    				$mainframe->setUserState( "Time",1);
	    				$app->enqueueMessage(JText::_('<u>Invalid Time entereed</u>'));
	    				$BadData = 1;
	    			}
	    		}
	    		If($Name == 'Opponent'){
	    			If(!$this->sanityCheck($Value,'string',32)){
	    				$mainframe->setUserState( "Opponent",1);
	    				$app->enqueueMessage(JText::_('<u>Invalid Opponent entereed</u>'));
	    				$BadData = 1;
	    			}
	    		}
	    		If($Name == 'Location'){
	    			If(!$this->sanityCheck($Value,'string',32)){
	    				$mainframe->setUserState( "Location",1);
	    				$app->enqueueMessage(JText::_('<u>Invalid Location entereed</u>'));
	    				$BadData = 1;
	    			}    			
	    		}
	    		If($Name == 'Description'){
	    			If(!$this->sanityCheck($Value,'string',32)){
	    				$mainframe->setUserState( "Description",1);
	    				$app->enqueueMessage(JText::_('<u>Invalid Description entereed</u>'));
	    				$BadData = 1;
	    			}    			
	    		}
	    		If($Name == 'Directions'){
	    			If(!$this->sanityCheck($Value,'string',32)){
	    				$mainframe->setUserState( "Directions",1);
	    				$app->enqueueMessage(JText::_('<u>Invalid Directions entereed</u>'));
	    				$BadData = 1;
	    			}    			
	    		}
	    		If($Name == 'Us'){
	    			If(!$this->sanityCheck($Value,'numeric',32)){
	    				$mainframe->setUserState( "Us",1);
	    				$app->enqueueMessage(JText::_('<u>Invalid Us entereed</u>'));
	    				$BadData = 1;
	    			}    			
	    		}
	    		If($Name == 'Them'){
	    			If(!$this->sanityCheck($Value,'numeric',32)){
	    				$mainframe->setUserState( "Them",1);
	    				$app->enqueueMessage(JText::_('<u>Invalid Them entereed</u>'));
	    				$BadData = 1;
	    			}    			
	    		}    		
	    		If($Name == 'Notes'){
	    			If(!$this->sanityCheck($Value,'string',250)){
	    				$mainframe->setUserState( "Notes",1);
	    				$app->enqueueMessage(JText::_('<u>Invalid Notes entereed</u>'));
	    				$BadData = 1;
	    			}    			
	    		}
	    	}
    	}    
    	// exit;	
 		If($BadData){
 			return FALSE;
 		}else{
 			return TRUE;
 		}    	
    }
	 function sanityCheck($string, $type, $length)
	 {
	 	If(strlen($string) == 0){
	 		return TRUE;
	 	}
	 	// echo $string  . "=string 161 sanity check<br><br>";
	 	$ValidData = 1;
    	$app =& JFactory::getApplication();
	  	// assign the type
	  	$type = 'is_'.$type;
	  	if(!$type($string))
	  	{
    		$app->enqueueMessage(JText::_("*<span style='color:black'>" . $string . "</span>*Invalid data type.  Looking for *<span style='color:black'>" . substr($type,3)) . "</span>*");
	    	$ValidData = 0;
	  	}
	  	if(strlen($string) > $length){
    		$app->enqueueMessage(JText::_("String *<span style='color:black'>" .$string. "</span>* Exceeds valid Length of *<span style='color:black'>" . $length . "</span>*"));
	    	$ValidData = 0;
	  	}
    	$StringArray = str_split($string);
    	$ValidCharacters = '	- abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890,:.';
    	Foreach($StringArray as $Count=>$Letter){
    		If(!strpos($ValidCharacters, $Letter) > 0){
 				$app->enqueueMessage(JText::_("Invalid Character in *<span style='color:black'>" . $string . "</span>*-the *<span style='color:black'>" . $Letter . "</span>* character is not allowed."));
    			$ValidData = 0;	    			
    		}
    	}
	   // echo $ValidData  . "=ValidData<br>";
	    If($ValidData){
	    	return TRUE;
	    }else{
	    	return FALSE;	    
	    }
	    // if all is well, we return TRUE
	    return TRUE;
    }
}//class
