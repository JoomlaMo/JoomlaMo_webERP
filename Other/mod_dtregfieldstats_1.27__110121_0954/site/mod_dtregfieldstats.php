<?php
/**
* @package DTRegisterFieldStats
* @version 1.0
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
$Columns	= $params->get( 'columns' );
If($Columns == 2){
	$ColSpanTitle = 2;
	$EndTitle  = "</tr>";
	$BeginLine = "<tr>";
	$BlankColumn = "";
}else{
	$ColSpanTitle = 1;
	$EndTitle  = "";
	$BeginLine = "";
	$BlankColumn = "<td>&nbsp;</td>";
}
if(!defined('DTREGFIELDSTATS_LOADED')){
	define('DTREGFIELDSTATS_LOADED', 1);
		$db 						= &JFactory::getDBO();			
		$table_prefix_jevents		= '#__jevents_';
		$table_prefix_dtreg			= '#__dtregister_';
		// get event ids to then find descriptions
		// get array of group event
		$query = "SELECT DISTINCT " . $table_prefix_dtreg   . "group_event.eventId " .
				"	FROM " . $table_prefix_dtreg   . "group_event";
		$db->setQuery( $query);
		$EventIDArray=& $db->loadResultArray();
		// Get array of field events
		$query = "SELECT DISTINCT " . $table_prefix_dtreg   . "field_event.event_id " .
					"  FROM " . $table_prefix_dtreg   . "field_event";
		$db->setQuery( $query);
		$EventIDFieldArray=& $db->loadResultArray();
		// If field event is not in group event array then add it to get a complete array of events.
		If(isset($EventIDFieldArray) and count($EventIDFieldArray) > 0){
			Foreach($EventIDFieldArray as $count=>$Id){
				If(!array_key_exists($Id,$EventIDArray)){
					array_push($EventIDArray,$Id);
				}
			}
		}
		// make a string for where clause
		If(isset($EventIDArray) AND count($EventIDArray) > 0){
			$EventIDArrayString = implode(",",$EventIDArray);
		}else{
			$EventIDArrayString ='';
		}
		// get descriptions for jevents that are in dtregister
		$query = "SELECT " . $table_prefix_jevents . "vevdetail.evdet_id," .
						         $table_prefix_jevents . "vevdetail.summary, " . 
						         $table_prefix_jevents . "vevdetail.dtstart " . 
					 " FROM " . $table_prefix_jevents . "vevdetail" . 
				   " WHERE " . $table_prefix_jevents . "vevdetail.evdet_id IN(" . $EventIDArrayString . ")" .		
				" ORDER BY " . $table_prefix_jevents . "vevdetail.dtstart";
		$db->setQuery( $query);
		$EventDescriptionArray=& $db->loadAssocList();
		// Maybe they are not using JEvents. Maybe they are using dtreg calendar?
		If(count($EventDescriptionArray)==0){
			$query = "SELECT " . $table_prefix_dtreg . "codes.id as evdet_id," .
							         $table_prefix_dtreg . "codes.name as summary, " . 
							         $table_prefix_dtreg . "codes.start as dtstart " . 
						 " FROM " . $table_prefix_dtreg . "codes" . 
					   " WHERE " . $table_prefix_dtreg . "codes.id IN(" . $EventIDArrayString . ")" .		
					" ORDER BY " . $table_prefix_dtreg . "codes.start";
			$db->setQuery( $query);
			$EventDescriptionArray=& $db->loadAssocList();			
		}
		$FirstEventArray =& current($EventDescriptionArray);
		$FirstEvent = current($FirstEventArray);
		// get field list of custom fields 
		$query = "SELECT " . $table_prefix_dtreg . "fields.name,  " . 
									$table_prefix_dtreg . "fields.label,  " . 
									$table_prefix_dtreg . "fields.values,  " . 
									$table_prefix_dtreg . "fields.selected,  " . 
									$table_prefix_dtreg . "fields.fees  
						FROM " . $table_prefix_dtreg . "fields 
						WHERE type > 0 AND
								published = 1
						ORDER BY ordering";
		$db->setQuery( $query);
		$FieldsArray=& $db->loadAssocList('name'); 
		$FieldNames = '';
		// create string of fields for query 
		Foreach($FieldsArray as $Name=>$row){
			If($Name <> 'title' AND $Name <> 'state' AND $Name <> 'country' AND $Name <> 'usertype' AND $Name <> 'email' AND $Name <> 'userId' AND $Name <> 'usertype'){
				$FieldNames 		= $FieldNames . $Name . ",";
			}
		}	 	     		
		$EndFieldNames 		= strrpos($FieldNames,",");
	 	$FieldNames 		= substr($FieldNames,0,$EndFieldNames);	
	 	// If an event was selected, use it otherwise first event by date	
	 	$post	= JRequest::get('request');
		If(array_key_exists('eventid',$post)){
			$SelectedEvent = intval($post['eventid']);			
		}else{
			If(isset($EventDescriptionArray) AND count($EventDescriptionArray) > 0){
				For($e = 0;$e<count($EventDescriptionArray);$e++){
					If($EventDescriptionArray[$e]['dtstart'] >= date('Y-m-d')){
						$SelectedEvent = intval($EventDescriptionArray[$e]['evdet_id']);
						break;
					}
				}
			}else{
				$SelectedEvent = '';
			}
		}
	 	// get custom field values for individual registration
	 	// after version 2.7 usertype is type
	  	$query = "SELECT *
						FROM " . $table_prefix_dtreg . "user";
		// echo $query  . "=query 110<br>";
		$db->setQuery( $query);
		$collums=& $db->loadAssocList();
		// echo '<pre>';var_dump($collums[0] , '<br><br> <b style="color:brown">collums[0]</b><br><br>');echo '</pre>';
		If(array_key_exists("type", $collums[0])){
	 		$UserTypeFieldName = ' type as usertype ';
		}else{
	 		$UserTypeFieldName = ' usertype ';
		}	
	 	$query = "SELECT userId, " . $FieldNames . ", " . $UserTypeFieldName .
	 			   "  FROM " . $table_prefix_dtreg . "user" . 
	 			  "  WHERE eventId = " . $SelectedEvent;
		$db->setQuery( $query);
		$RegistrationsArray=& $db->loadAssocList();
		// tally fields for individual registration file
		$GroupUserIds = array();
		$GroupCount = 0;
		If(count($RegistrationsArray) > 0){
			Foreach($RegistrationsArray as $Count=>$regrow){
				If($regrow['usertype'] == 'G'){
					$GroupUserIds[$GroupCount] = $regrow['userId'];
					$GroupCount = $GroupCount + 1 ;
					continue;
				}
				Foreach($FieldsArray as $Name=>$row){
					$RegRowChoice = $regrow[$Name];
					If(strlen(trim($RegRowChoice)) > 0){
						If(isset($ChoiceCount[$Name][$RegRowChoice])){
							$ChoiceCount[$Name][$RegRowChoice] += 1;
						}else{
							$ChoiceCount[$Name][$RegRowChoice] = 1;
						}
					}
				}		
			}
		}
	 	// get custom field values for group registration
	 	$GroupUser = implode("'",$GroupUserIds);
	 	If(strlen($GroupUser) > 0){
			$query = "SELECT " . $FieldNames . 
					  " FROM " . $table_prefix_dtreg . "group_member " . 
		 			  "WHERE groupUserId IN(" . $GroupUser . ")";
			$db->setQuery( $query);
			$RegistrationsGroupArray=& $db->loadAssocList();
		}else{
			$RegistrationsGroupArray = array();
		}
		// tally fields for group registration file
		If(count($RegistrationsGroupArray) > 0){
			Foreach($RegistrationsGroupArray as $Count=>$regrow){
				Foreach($FieldsArray as $Name=>$row){
					$RegRowChoice = $regrow[$Name];
					If(strlen(trim($RegRowChoice)) > 0){
						If(isset($ChoiceCount[$Name][$RegRowChoice])){
							$ChoiceCount[$Name][$RegRowChoice] += 1;
						}else{
							$ChoiceCount[$Name][$RegRowChoice] = 1;
						}
					}
				}		
			}
		}
		$url = $_SERVER['REQUEST_URI'];
		echo "<table cellpadding='2'>";
		echo "<form action=" . $url . " method='post' name='selectEventForm' >";
		echo "<tr><tdcolspan='" . $ColSpanTitle . "'>";
		echo "<Select name='eventid'  onchange='this.form.submit('selectEventForm')'>";
		If(isset($EventDescriptionArray) AND count($EventDescriptionArray) > 0){
			Foreach($EventDescriptionArray as $Id=>$DescriptionArray){
				If($DescriptionArray["evdet_id"]==$SelectedEvent){
					$IsSelected = "SELECTED";
				}else{
					$IsSelected = "";
				}
				echo "<Option value=" . $DescriptionArray["evdet_id"] . " " . $IsSelected . " >" . substr($DescriptionArray["summary"],0,25) . "</option>";
			}
		}
		echo "</Select><input type='submit' name='NewEvent' value='Change Event'>";
		"</td></tr>";
		echo "</form>";
		$LastFieldsArrayName = '';
		Foreach($FieldsArray as $name=>$data){
			$ThisLabel = $FieldsArray[$name]['label'];
			If($ThisLabel <> 'Title' AND $ThisLabel <> 'State'  AND $ThisLabel <> 'Country' ){
				echo "<tr><td colspan='" . $ColSpanTitle . "'>";
				echo "<b>" . $FieldsArray[$name]['label']  . "</b>";
				echo "</td>"  ;
				echo $EndTitle;
				If(strrpos($FieldsArray[$name]['values'],"|")>0){
					$FirstRow = true;
					$data = explode("|",$FieldsArray[$name]['values']);
					Foreach($data as $count=>$CurrentChoice){
						If($LastFieldsArrayName <> $FieldsArray[$name]['label'] AND !$FirstRow){
							echo $BlankColumn;
						}
						If(isset($ChoiceCount[$name][$CurrentChoice])){
							echo  $BeginLine;
							echo "<td>" . $CurrentChoice . "</td><td>" .$ChoiceCount[$name][$CurrentChoice]    . "</td></tr>" ;
						}else{
							echo  $BeginLine;
							echo   "<td>" . $CurrentChoice . "</td><td>0</td></tr>";
						}
						$FirstRow = false;
					}					
				}else{
					echo $BeginLine;
					echo "<td>" . $FieldsArray[$name]['values']  . "</td>";
					If(isset($ChoiceCount[$data['name']][$FieldsArray[$data['name']]['values']])){
						echo "<td>" . $ChoiceCount[$data['name']][$FieldsArray[$data['name']]['values']]  . "</td></tr>";
					}else{
						echo "<td>0</td>";
					}
				}
				$LastFieldsArrayName = $FieldsArray[$name]['label'];
			}
		}
			echo "</table>";

}
?>