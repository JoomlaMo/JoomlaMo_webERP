<?php
/**
 * @version SVN: $Id$
 * @package    team
 * @subpackage Views
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

JHTML::_('behavior.tooltip');
If($mainframe->getUserState( "post")){
	$PostPrevious = $mainframe->getUserState( "post");
	$mainframe->setUserState( "post", NULL);
	If(array_key_exists('TeamName', $PostPrevious)){
		$this->item['TeamName'] = $PostPrevious['TeamName'];
	}
	If(array_key_exists('TeamDescription', $PostPrevious)){
		$this->item['TeamDescription'] = $PostPrevious['TeamDescription'];
	}
	If(array_key_exists('TeamLeague', $PostPrevious)){
		$this->item['TeamLeague'] = $PostPrevious['TeamLeague'];
	}
}
If($mainframe->getUserState( "TeamName")==1 AND  isset($PostPrevious['TeamName'])){
	$TeamNameStyle = " style='color:red' ";
}else{
	$TeamNameStyle = "";
}
If($mainframe->getUserState( "TeamDescription")==1 AND  isset($PostPrevious['TeamDescription'])){
	$TeamDescriptionStyle = " style='color:red' ";
}else{
	$TeamDescriptionStyle = "";
}
?>
<script language="javascript" type="text/javascript">
function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
     
	 if (pressbutton=='save')
	 {
	  form.controller.value="team";
	 }
	 if(pressbutton=='cancel')
	 {
	  form.controller.value="team";
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	
	form.submit();
}
</script>
<div style="float:left"><h1><?php echo JText::_('TEAMS'); ?></h1></div>
<div class="div_block" style="float:right"><?php echo teamseditHelperToolbar::getToolbar();?></div><br clear="all">
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'Details' ); ?></legend>
	<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="TeamName" <?php echo $TeamNameStyle  ?>>
					<?php echo JText::_( 'TEAM_NAME' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="TeamName" id="TeamName" size="32" maxlength="64" value="<?php echo $this->item['TeamName'];?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="LoftName" <?php echo $TeamNameStyle  ?>>
					<?php echo JText::_( 'LOFT_NAME' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="LoftName" id="LoftName" size="50" maxlength="64" value="<?php echo $this->item['LoftName'];?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Address" <?php echo $TeamNameStyle  ?>>
					<?php echo JText::_( 'ADDRESS' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="Address" id="Address" size="50" maxlength="64" value="<?php echo $this->item['Address'];?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="City" <?php echo $TeamNameStyle  ?>>
					<?php echo JText::_( 'CITY' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="City" id="City" size="50" maxlength="64" value="<?php echo $this->item['City'];?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="State" <?php echo $TeamNameStyle  ?>>
					<?php echo JText::_( 'STATE' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="State" id="State" size="50" maxlength="64" value="<?php echo $this->item['State'];?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Zip Code" <?php echo $TeamNameStyle  ?>>
					<?php echo JText::_( 'ZIPCODE' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="ZipCode" id="ZipCode" size="20" maxlength="20" value="<?php echo $this->item['ZipCode'];?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Phone" <?php echo $TeamNameStyle  ?>>
					<?php echo JText::_( 'PHONE' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="Phone" id="Phone" size="50" maxlength="64" value="<?php echo $this->item['Phone'];?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Email" <?php echo $TeamNameStyle  ?>>
					<?php echo JText::_( 'EMAIL' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="Email" id="Email" size="50" maxlength="150" value="<?php echo $this->item['Email'];?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="TeamDescription" <?php echo $TeamDescriptionStyle  ?>>
					<?php echo JText::_( 'TEAM_DESCRIPTION' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="TeamDescription" id="TeamDescription" size="32" maxlength="64" value="<?php echo $this->item['TeamDescription'];?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="TeamDescription">
					<?php echo JText::_( 'TEAM_LEAGUE' ); ?>:
				</label>
			</td>
			<td>
				<select name="TeamLeague">
<?php

while(list($key, $val)=each($this->leaguenames)) {
	if ((isset($this->item['LeagueID']) && ($this->item['LeagueID'] == $val['LeagueID'])) OR (isset($PostPrevious['TeamLeague']) AND $PostPrevious['TeamLeague'] == $key) ) {
		echo '	<option value="'.$key.'" selected>'.$val['LeagueName'].'</option>';
	} else {
		echo '	<option value="'.$key.'">'.$val['LeagueName'].'</option>';
	}
}
?>				
				</select>
			</td>
		</tr>
	</table>
	</fieldset>

		<?php ##ECR_VIEW2_TMPL1_OPTION3## ?>

	<input type="hidden" name="cid[]" value="<?php echo $this->item['TeamID']; ?>" />
	<input type="hidden" name="TeamID" value="<?php echo $this->item['TeamID']; ?>" />
	<input type="hidden" name="option" value="com_teams" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="controller" value="team" />
</form>
