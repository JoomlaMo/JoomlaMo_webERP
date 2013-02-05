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
global $mainframe;
If($mainframe->getUserState( "post")){
	$PostPrevious = $mainframe->getUserState( "post");
	$mainframe->setUserState( "post", NULL);
	If(array_key_exists('FirstName', $PostPrevious)){
		$this->item['FirstName'] = $PostPrevious['FirstName'];
	}
	If(array_key_exists('LastName', $PostPrevious)){
		$this->item['LastName'] = $PostPrevious['LastName'];
	}
	If(array_key_exists('Notes', $PostPrevious)){
		$this->item['Notes'] = $PostPrevious['Notes'];
	}
	If(array_key_exists('TeamNames', $PostPrevious)){
		Foreach($PostPrevious['TeamNames'] as $TeamID=>$YesNo ){
			$TeamID = strval($TeamID);
			$TeamPlayer[$TeamID]["TeamID"] = 'YES';
		}
	}
}
If($this->item['Active']=='N'){
	$ActiveYes =  "";
	$ActiveNo =   "CHECKED";
}elseif(isset($PostPrevious['Active'])){
	$ActiveYes =  "CHECKED";
	$ActiveNo =   "";	
}else{
	$ActiveYes =  "CHECKED";
	$ActiveNo =   "";	
}
$TeamNames 				=& $this->teams;
$UniformDescriptions =& $this->uniforms;
$TeamPlayer 			=& $this->teamplayer;
If($mainframe->getUserState( "FirstName")==1 AND  isset($PostPrevious['FirstName'])){
	$FirstNameStyle = " style='color:red' ";
}else{
	$FirstNameStyle = "";
}
If($mainframe->getUserState( "LastName")==1 AND  isset($PostPrevious['LastName'])){
	$LastNameStyle = " style='color:red' ";
}else{
	$LastNameStyle = "";
}
If($mainframe->getUserState( "Notes")==1 AND  isset($PostPrevious['Notes'])){
	$NotesStyle = " style='color:red' ";
}else{
	$NotesStyle = "";
}
If($mainframe->getUserState( "UniformNumber")==1 AND  isset($PostPrevious['UniformNumber'])){
	$UniformNumberStyle = " style='color:red' ";
}else{
	$UniformNumberStyle = "";
}
?>
<script language="javascript" type="text/javascript">
function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
     
	 if (pressbutton=='save')
	 {
	  form.controller.value="player";
	 }
	 if(pressbutton=='cancel')
	 {
	  form.controller.value="player";
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	
	form.submit();
}
</script>
<div style="float:left"><h1><?php echo JText::_('PLAYER'); ?></h1></div>
<div class="div_block" style="float:right"><?php echo teamseditHelperToolbar::getToolbar();?></div><br clear="all">
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'DETAILS' ); ?></legend>
	<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="FirstName" <?php echo $FirstNameStyle  ?> >
					<?php echo JText::_( 'FIRST_NAME' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="FirstName" id="FirstName" size="20" maxlength="20" value="<?php echo $this->item['FirstName'];?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="LastName" <?php echo $LastNameStyle  ?> >
					<?php echo JText::_( 'LAST_NAME' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="LastName" id="LastName" size="20" maxlength="20" value="<?php echo $this->item['LastName'];?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Notes" <?php echo $NotesStyle  ?> >
					<?php echo JText::_( 'NOTES' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="Notes" id="Notes" size="32" maxlength="250" value="<?php echo $this->item['Notes'];?>" />
			</td>
		</tr>	
		
		<tr>
			<td width="100" align="right" class="key">
				<label for="Team">
					<?php echo JText::_( 'TEAM' ); ?>:
				</label>
			</td>
			<td colspan="2">
<?php
foreach($TeamNames as $TeamID=>$nameid){
	If(isset($TeamPlayer[$TeamID]["TeamID"]) OR count($TeamNames) == 1 OR isset($PostPrevious['TeamNames'][$TeamID]) ){
		$Selected = 'CHECKED';
	}else {
		$Selected = '';
	}
	echo '<input type="checkbox" name="TeamNames[' . $TeamID . ']" ' . $Selected . '>  '. $nameid['TeamName'] .' <br>';
}	
?>		
			</td>
		</tr>	<tr>
			<td width="100" align="right" class="key">
				<label for="UniformNumbers" <?php echo $UniformNumberStyle  ?> >
					<?php echo JText::_( 'UNIFORM_NUMBERS' ); ?>:
				</label>
			</td>
			<td colspan="2">
<?php
foreach($UniformDescriptions as $uniformid=>$descid){
	If(isset($this->uniformnumbers[$uniformid]["Number"])){
		$Number = $this->uniformnumbers[$uniformid]["Number"];
	}elseif(isset($PostPrevious["UniformNumber"][$uniformid])){
		$Number = $PostPrevious["UniformNumber"][$uniformid];
	}else{
		$Number = '';
	}
	echo '<input class="text_area" type="text" name="UniformNumber[' . $uniformid . ']" id="UniformNumber[' . $uniformid . ']" size="20" maxlength="20" value="' . $Number . '" />' . $descid['UniformDescription'] . '<br>';
}
?>	
			</td>
		</tr>		
		<tr>
			<td width="100" align="right" class="key">
				<label for="Active">
					<?php echo JText::_( 'ACTIVE' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input type="radio" name="Active" value="Y" <?php echo $ActiveYes  ?>/> Yes<br>
				<input type="radio" name="Active" value="N" <?php echo $ActiveNo  ?>/> No
			</td>
		</tr>
	</table>
	</fieldset>

		<?php ##ECR_VIEW2_TMPL1_OPTION3## ?>

	<input type="hidden" name="cid[]" value="<?php echo $this->item['PlayerID']; ?>" />
	<input type="hidden" name="PlayerID" value="<?php echo $this->item['PlayerID']; ?>" />
	<input type="hidden" name="option" value="com_teams" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="controller" value="player" />
</form>
