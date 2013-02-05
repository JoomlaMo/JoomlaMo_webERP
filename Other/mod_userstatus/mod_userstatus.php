<?php 
/**
* @package UserStatus
* @version 1.10
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
defined('_JEXEC') or die('Restricted access');

if(!defined('USERSTATUS_LOADED')){
	define('USERSTATUS_LOADED', 1);	
	function UserStatusDisplay(){   
		$url = $_SERVER['REQUEST_URI'];
		// If list is being displayed then we change the status the new list is redisplayed before the
		// change is made so the module is updated correctly but the list is displayed before the update.
		// Set $RedirectToSynchronize = FALSE at first and to True if we update the data base.
		// then after removing newstatus= from the url redirect to synchronize the module and component.
		$RedirectToSynchronize = FALSE;
		If(strpos($url, "newstatus=")){
			$NewStatusPosition = strpos($url, "newstatus=") + 10;
			$NewStatus = substr($url,$NewStatusPosition,1);
			setNewStatus($NewStatus);
			$RedirectToSynchronize = TRUE;
		}
		$url = str_replace("?newstatus=0", "", $url);
		$url = str_replace("&newstatus=0", "", $url);
		$url = str_replace("?newstatus=1", "", $url);
		$url = str_replace("&newstatus=1", "", $url);
		$url = str_replace("?newstatus=2", "", $url);
		$url = str_replace("&newstatus=2", "", $url);
		If($RedirectToSynchronize){
			header("Location: ". $url);
		}
		If(strpos($url, '&') > 0){
			$url = $url . '&';
		}else{
			$url = $url . '?';
		}   
		$DisplayName = getUserName();
		$DisplayStatus = getUserStatus($DisplayName['id']);
		If(isset($DisplayStatus) AND strlen(trim($DisplayStatus)) > 0){
			echo "Hello " . $DisplayName['name'] . "<br>";
			$PicturePath = "components" . DS . "com_userstatus" . DS . "images" . DS;
			If($DisplayStatus == 1){
				$Status = "Activated";
				$Picture = $PicturePath . "green.png";
			}elseif($DisplayStatus == 2){
				$Status = "Stand By";
				$Picture = $PicturePath . "yellow.png";
			}elseif($DisplayStatus == 0){
				$Status = "Closed";
				$Picture = $PicturePath . "red.png";
			}
			echo "<img src=" . $Picture . " border='0' alt='status'><br>";
			
			If($DisplayStatus == 1){
				echo "<a href='" . $url . "newstatus=2' style='color:orange;'><b>Stand By</b></a><br>";
				echo "<a href='" . $url . "newstatus=0' style='color:red;'><b>Closed</b></a><br>";
			}elseif($DisplayStatus == 2){
				echo "<a href='" . $url . "newstatus=1' style='color:green;'><b>Activated</b></a><br>";
				echo "<a href='" . $url . "newstatus=0' style='color:red;'><b>Closed</b></a><br>";
			}elseif($DisplayStatus == 0){
				echo "<a href='" . $url . "newstatus=2' style='color:orange;'><b>Stand By</b></a><br>";
				echo "<a href='" . $url . "newstatus=1' style='color:green;'><b>Activated</b></a><br>";
			}		
			echo "<a href='index.php?option=com_userstatus&view=userstatus'><b>List</b></a><br>";
		}else{
			echo "Not assigned to a location";
		}
	}
	function getUserStatus($ID){	
		$db = &JFactory::getDBO();
		$table_prefix = '#__sts_';
		$query="SELECT status FROM " . $table_prefix . "userstatus WHERE user=". $ID;
		$db->setQuery($query);	                 
		$UserStatus = $db->loadResult();
	  	return $UserStatus;
	}	
	function getUserName(){	
		$db = &JFactory::getDBO();
		$table_prefix = '#__';
		$userarray = JFactory::getUser();
		$username = $userarray->username;
		$query =  "SELECT * FROM " . $table_prefix . "users WHERE username='" . $username . "'";
		$db->setQuery($query);	                 
		$UserName = $db->loadAssoc();
		return $UserName;
	}	
	function setNewStatus($newstatus){	
		$db = &JFactory::getDBO();		
		$userarray = JFactory::getUser();
		$table_prefix = 'jos_sts_';
		$ID = $userarray->id;
		// find and update all locations in this users county
		// select user status to find location id
		// $query = "SELECT location FROM " . $table_prefix . "userstatus WHERE user=". $ID;
		// $db->setQuery( $query);	                 
		// $UserLocation = $db->loadResult();
		// Find County for this user
		// $query = "SELECT county FROM " . $table_prefix . "locations WHERE id=". $UserLocation;
		// $db->setQuery( $query);	                 
		// $UserCounty = $db->loadResult();
		// Find all location ids in this users county
		// $query = "SELECT id FROM " . $table_prefix . "locations WHERE county='". $UserCounty . "'";
		// $db->setQuery( $query);	                 
		// $CountyLocations = $db->loadResultArray();	
		//
		// $query = "UPDATE " . $table_prefix . "userstatus SET status = " . $newstatus . " WHERE location IN('". implode("','",$CountyLocations) . "')";
		$query = "UPDATE " . $table_prefix . "userstatus SET status = " . $newstatus . " WHERE user =" . $ID ;
		$db->setQuery( $query);
		$db->query();		
		return true;
	}
}
UserStatusDisplay();
?>