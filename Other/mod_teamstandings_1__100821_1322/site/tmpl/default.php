<?php
/**
 * @version SVN: $Id$
 * @package    teamstandings
 * @subpackage Tmpl
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
arsort($Standings);
global $TeamNames;
If(count($Leagues) > 1){		
	If(array_key_exists('LeagueChoice',$post)){
		$LeagueChoice = intval($post['LeagueChoice']);	
	}	
	$url = $_SERVER['REQUEST_URI'];
	echo "<form action=" . $url . " method='post' name='adminForm1' >";
?>
<select name="LeagueChoice" onchange="document.adminForm1.submit();">
	<option value="AllLeagues">All Leagues</option>
<?php
	Foreach($Leagues as $LeagueID=>$LeagueArray ){	
		If($LeagueID == $LeagueChoice){
			$Selected = 'SELECTED';
		}else{
			$Selected = '';			
		}
?>
	<option value="<?php echo $LeagueID  ?>" <?php echo $Selected  ?> ><?php echo $LeagueArray['LeagueName']  ?></option>
<?php		
	}
?>
</select>
<input type='submit' name='NewLeague' value='Change League'>
<?php
}elseif(count($Leagues) > 0){
	echo $Leagues[4]['LeagueName'];
}
If(count($Standings) > 0){
?>	
</form>
<table border="0">
	<tr>
		<td>
	  		Name
	  	</td>
<?php
	If($Standings_params['StandingType'] == 1){
?>	  	
	  	<td>
	  		Pct
	  	</td>
<?php
	}else{
?>	  	
	  	<td>
	  		Pts
	  	</td>
<?php
	}
?>	  	
	  	<td>w</td>
	  	<td>l</td>
	  	<td>t</td>
	</tr>
<?php
	foreach ($Standings as $TeamID => $Standing) { 
		If(!isset($Record[$TeamID]['wins'])){
  			$Record[$TeamID]['wins'] = 0;
  		}
  		If(!isset($Record[$TeamID]['ties'])){
  			$Record[$TeamID]['ties'] = 0;
  		}
  		If(!isset($Record[$TeamID]['losses'])){
  			$Record[$TeamID]['losses'] = 0;
  		}
  		If($Standings_params['StandingType'] == 1){
			$DecimalPlaces = 3;
		}else{
			$DecimalPlaces = 0;
		}
?>	  	
	<tr>
		<td>
<?php 		
  		echo $TeamNames[$TeamID]["TeamName"] . "</td><td>" . number_format($Standing, $DecimalPlaces) . "</td><td>" . $Record[$TeamID]['wins'] . "</td><td>" . $Record[$TeamID]['losses']  . "</td><td>" . $Record[$TeamID]['ties'];
?>	
		</td>
	</tr>
<?php
    } 
?>  
</table>
<?php  
	 echo "<br>Games Played:"; 
	 echo count($Standings); 
}
?>
