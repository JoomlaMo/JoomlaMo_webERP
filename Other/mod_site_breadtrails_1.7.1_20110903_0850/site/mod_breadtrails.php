<?php
/**
 * @package    BreadTrails
 * @subpackage Base
 * @author     Mo Kelly
 * @author     Created on 21-Dec-2010
 * @Joomla version 1.5
 * @copyright Copyright (C) 2010 Mo Kelly. All rights reserved.   
 * This program is free software: you can redistribute it and/or modify    
 * it under the terms of the GNU General Public License as published by
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
global $mainframe;
$mainframe = JFactory::getApplication();
$BreadTrails_params['1'] 	= $params->get( 'Post Variable 1' );
$BreadTrails_params['2'] 	= $params->get( 'Post Variable 2' );
$BreadTrails_params['3'] 	= $params->get( 'Post Variable 3');
$BreadTrails_params['4'] 	= $params->get( 'Post Variable 4' );
$uri =& JFactory::getURI();
$post	= JRequest::get('request');
// echo '<pre>';var_dump($post , '<br><br> <b style="color:brown">post</b><br><br>');echo '</pre>';
$BreadTrails = array();
If($mainframe->getUserState( "breadtrails")){
	$BreadTrails = (array) $mainframe->getUserState( "breadtrails");
}
$ThisPost = '';
$ToURL = $uri->toString();
If(strpos($ToURL, "?") > 0){
	$ToURL = $ToURL  . "&";
}else{
	$ToURL = $ToURL  . "?";
}
Foreach($post as $key=>$value){	
	// If post value pair is not already in the url, add it so that we can go back to the exact place.
	$KeyEquals = $key . "=";
	If(!strpos($ToURL, $KeyEquals)){
		$ToURL = $ToURL . $key . "=" . $value . "&";
	}
	If($key == "breadtrail"){
		header("Location: ". $value);
	}
	// if any parameters have a value to be matched then only use parameters the $ThisPost
	If(strlen(trim($BreadTrails_params['1'])) > 0 OR strlen(trim($BreadTrails_params['2'])) > 0 OR strlen(trim($BreadTrails_params['3'])) > 0 OR strlen(trim($BreadTrails_params['4'])) > 0 ){
		//  If any post parameters match bread trail params - add them to $ThisPost
		If($key == $BreadTrails_params['1'] OR $key == $BreadTrails_params['2'] OR $key == $BreadTrails_params['3'] OR $key == $BreadTrails_params['4']){
			$ThisPost  = $ThisPost . ' ' . $value;
		}
	}else{
		// otherwise add just any thing
		$ThisPost  = $ThisPost . ' ' . $value;
	}
}
If(strlen(trim($ThisPost)) > 0){
	$ThisSelection['posts'] = urldecode($ThisPost);
	$ThisSelection['url'] 	= $ToURL;
	$DuplicateURL = FALSE;
	Foreach($BreadTrails as $Count=>$BreadArray){
		If($BreadArray['url'] == $ToURL OR $BreadArray['posts'] == $ThisSelection['posts']){
			$DuplicateURL = TRUE;
		}
	}
	If(!$DuplicateURL){
		array_push ($BreadTrails,$ThisSelection);
	}
	while(count($BreadTrails) > 10){
		array_shift($BreadTrails);
	}
	$mainframe->setUserState( "breadtrails",$BreadTrails);
}
?>
<p>
<form action="index.php" method="post">
   <select name="breadtrail" style="width:120px;text-overflow:ellipsis;color:grey">
   	<option value="NoSelection">Select</option>
<?php
foreach($BreadTrails as $count=>$BreadArray){   
?>
		<option value="<?php echo $BreadArray['url']  ?>"><?php echo $BreadArray['posts']  ?></option>
<?php
}
?>
   </select>
   <input type="submit" name="breadtrailsubmit" value="Go To Trail" />
</form>   
</p>