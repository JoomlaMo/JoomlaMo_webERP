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
	If(array_key_exists('LeagueName', $PostPrevious)){
		$this->item['LeagueName'] = $PostPrevious['LeagueName'];
	}
	If(array_key_exists('LeagueDescription', $PostPrevious)){
		$this->item['LeagueDescription'] = $PostPrevious['LeagueDescription'];
	}
	If(array_key_exists('Notes', $PostPrevious)){
		$this->item['Notes'] = $PostPrevious['Notes'];
	}
}
If($mainframe->getUserState( "LeagueName")==1 AND  isset($PostPrevious['LeagueName'])){
	$LeagueNameStyle = " style='color:red' ";
}else{
	$LeagueNameStyle = "";
}
If($mainframe->getUserState( "LeagueDescription")==1 AND  isset($PostPrevious['LeagueDescription'])){
	$LeagueDescriptionStyle = " style='color:red' ";
}else{
	$LeagueDescriptionStyle = "";
}
?>
<script language="javascript" type="text/javascript">
function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
     
	 if (pressbutton=='save')
	 {
	  form.controller.value="league";
	 }
	 if(pressbutton=='cancel')
	 {
	  form.controller.value="league";
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	
	form.submit();
}
</script>
<div style="float:left"><h1><?php echo JText::_('LEAGUE'); ?></h1></div>
<div class="div_block" style="float:right"><?php echo teamseditHelperToolbar::getToolbar();?></div><br clear="all">
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'DETAILS' ); ?></legend>
	<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="LeagueName" <?php echo $LeagueNameStyle  ?>>
					<?php echo JText::_( 'LEAGUE_NAME' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="LeagueName" id="LeagueName" size="32" maxlength="64" value="<?php echo $this->item['LeagueName'];?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="LeagueDescription" <?php echo $LeagueDescriptionStyle  ?>>
					<?php echo JText::_( 'LEAGUE_DESCRIPTION' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="LeagueDescription" id="LeagueDescription" size="32" maxlength="64" value="<?php echo $this->item['LeagueDescription'];?>" />
			</td>
		</tr>

	</table>
	</fieldset>


	<input type="hidden" name="cid[]" 	 value="<?php echo $this->item['LeagueID']; ?>" />
	<input type="hidden" name="LeagueID" value="<?php echo $this->item['LeagueID']; ?>" />
	<input type="hidden" name="option" value="com_teams" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="controller" value="league" />
</form>
