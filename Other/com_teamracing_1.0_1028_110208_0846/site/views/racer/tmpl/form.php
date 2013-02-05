<?php
/**
 * @version SVN: $Id$
 * @package    teamrace
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
	If(array_key_exists('Date', $PostPrevious)){
		$this->item['Date'] = substr($PostPrevious['Date'],6,4) . "-" . substr($PostPrevious['Date'],0,5);
	}
	If(array_key_exists('Time', $PostPrevious)){
		$this->item['Time'] = $PostPrevious['Time'];
	}
	If(array_key_exists('Opponent', $PostPrevious)){
		$this->item['Opponent'] = $PostPrevious['Opponent'];
	}
	If(array_key_exists('Location', $PostPrevious)){
		$this->item['Location'] = $PostPrevious['Location'];
	}
	If(array_key_exists('Description', $PostPrevious)){
		$this->item['Description'] = $PostPrevious['Description'];
	}
	If(array_key_exists('Directions', $PostPrevious)){
		$this->item['Directions'] = $PostPrevious['Directions'];
	}
	If(array_key_exists('Us', $PostPrevious)){
		$this->item['Us'] = $PostPrevious['Us'];
	}
	If(array_key_exists('Them', $PostPrevious)){
		$this->item['Them'] = $PostPrevious['Them'];
	}
	If(array_key_exists('Notes', $PostPrevious)){
		$this->item['Notes'] = $PostPrevious['Notes'];
	}
}

$TeamNames = $this->teamracing;
$UniformDescriptions = $this->uniforms;
if(!isset($this->item['Date'])){
	$this->item['Date'] = date('Y-m-d');
}
If($mainframe->getUserState( "Date")==1 AND  isset($PostPrevious['Date'])){
	$DateStyle = " style='color:red' ";
}else{
	$DateStyle = "";
}
If($mainframe->getUserState( "Time")==1 AND isset($PostPrevious['Time'])){
	$TimeStyle = " style='color:red' ";
}else{
	$TimeStyle = "";
}
If($mainframe->getUserState( "Opponent")==1 AND isset($PostPrevious['Opponent'])){
	$OpponentStyle = " style='color:red' ";
}else{
	$OpponentStyle = "";
}
If($mainframe->getUserState( "Location")==1 AND isset($PostPrevious['Location'])){
	$LocationStyle = " style='color:red' ";
}else{
	$LocationStyle = "";
}
If($mainframe->getUserState( "Description")==1 AND isset($PostPrevious['Description'])==1){
	$DescriptionStyle = " style='color:red' ";
}else{
	$DescriptionStyle = "";
}
If($mainframe->getUserState( "Directions")==1 AND isset($PostPrevious['Directions'])){
	$DirectionStyle = " style='color:red' ";
}else{
	$DirectionStyle = "";
}
If($mainframe->getUserState( "Us")==1 AND isset($PostPrevious['Us'])){
	$UsStyle = " style='color:red' ";
}else{
	$UsStyle = "";
}
If($mainframe->getUserState( "Them")==1 AND isset($PostPrevious['Them'])){
	$ThemStyle = " style='color:red' ";
}else{
	$ThemStyle = "";
}
If($mainframe->getUserState( "Notes")==1 AND isset($PostPrevious['Notes'])){
	$NotesStyle = " style='color:red' ";
}else{
	$NotesStyle = "";
}
?>
<script language="javascript" type="text/javascript">
function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
     
	 if (pressbutton=='save')
	 {
	  form.controller.value="racer";
	 }
	 if(pressbutton=='cancel')
	 {
	  form.controller.value="racer";
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	
	form.submit();
}
</script>
<script language="javascript" src="components/com_teamracing/mootools.v1.11.js"></script>
<script language="javascript" src="components/com_teamracing/nogray_time_picker.js"></script>
<script language="javascript">
	window.addEvent("domready", function (){
		var tp2 = new TimePicker('time2_picker', 'Time', 'time2_toggler', { visible:false});		
	});
</script>

<div style="float:left"><h1><?php echo JText::_('racer'); ?></h1></div>
<div class="div_block" style="float:right;"><?php echo teamracingeditHelperToolbar::getToolbar();?></div><br><br><br><br>
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'DETAILS' ); ?></legend>
<table>	
<tr>
<td>
	<Table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="Date" <?php echo $DateStyle  ?> >
					<abbr title="Click the calendar icon on the right to choose date."><?php echo JText::_( 'DATE' ); ?>:</abbr>
				</label>
			</td>
			<td>
			<?php echo JHTML::_('calendar', date('m-d-Y',strtotime($this->item['Date'])),'DATE', 'DATE', '%m %d %Y'); ?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Time" <?php echo $TimeStyle  ?> >
					<abbr title="<?php echo JText::_('ENTER_TIME'); ?>"><?php echo JText::_( 'TIME(HH:MM)' ); ?>:</abbr>
				</label>
				
			</td>
			<td nowrap>
				<input type="text" name="Time" id="Time" size="10" value="<?php echo $this->item['Time']  ?>"/><a href="#" id="time2_toggler"></a><br>
				<!-- <input class="text_area" type="text" name="time" id="time" size="32" maxlength="250" value="<?php echo $this->item['Time'];?>" /> -->
			</td>
			
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Opponent" <?php echo $OpponentStyle  ?> >
					<abbr title=<?php echo JText::_( "ENTER_TEAM_PLAYING"); ?> ><?php echo JText::_( 'OPPONENT' ); ?>:</abbr>
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="Opponent" id="Opponent" size="32" maxlength="32" value="<?php echo $this->item['Opponent'];?>" />
			</td>
		</tr>	
		<tr>
			<td width="100" align="right" class="key">
				<label for="Location" <?php echo $LocationStyle  ?> >
					<abbr title=<?php echo JText::_( "ENTER_ADDRESS"); ?>><?php echo JText::_( 'LOCATION' ); ?>:</abbr>
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="Location" id="Location" size="32" maxlength="32" value="<?php echo $this->item['Location'];?>" />
			</td>
		</tr>	
		<tr>
			<td width="100" align="right" class="key">
				<label for="Description" <?php echo $DescriptionStyle  ?> >
					<abbr title=<?php echo JText::_( "ENTER_LINE_ABOUT_racer"); ?>><?php echo JText::_( 'DESCRIPTION' ); ?>:</abbr>
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="Description" id="Description" size="32" maxlength="32" value="<?php echo $this->item['Description'];?>" />
			</td>
		</tr>	
		<tr>
			<td width="100" align="right" class="key">
				<label for="Team">
					<abbr title=<?php echo JText::_("CHOOSE_TEAM_PLAYING") ;?>><?php echo JText::_( 'TEAM' ); ?>:</abbr>
				</label>
			</td>
			<td colspan="2">
				<select name="TeamID">
<?php
foreach($TeamNames as $TeamID=>$nameid){
	echo '<option value="'.$TeamID.'" selected>'.$TeamNames[$TeamID]["TeamName"].'</option>';
}	
?>		
				</select>
			</td>
		</tr>	
		<tr>
			<td width="100" align="right" class="key">
				<label for="Uniform">
					<abbr title=<?php echo JText::_("CHOOSE_UNIFORM") ;?>><?php echo JText::_( 'UNIFORM' ); ?>:</abbr>
				</label>
			</td>
			<td colspan="2">
				<select name="UniformID">
<?php
foreach($UniformDescriptions as $uniformid=>$descid){
	echo '<option value="'.$uniformid.'" selected>'.$UniformDescriptions[$uniformid]["UniformDescription"].'</option>';	
}
?>
				</select>	
			</td>
		</tr>	
		<tr>
			<td width="100" align="right" class="key">
				<label for="Directions" <?php echo $DirectionStyle  ?> >
					<?php echo JText::_( 'DIRECTIONS' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="Directions" id="Directions" size="32" maxlength="250" value="<?php echo trim($this->item['Directions']);?>" />
			</td>
		</tr>			
		<tr>
			<td width="100" align="right" class="key">
				<label for="Us" <?php echo $UsStyle  ?> >
					<?php echo JText::_( 'US' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="Us" id="Us" size="5" maxlength="5" value="<?php echo $this->item['Us'];?>" />
			</td>
		</tr>		
		<!-- <tr>
			<td width="100" align="right" class="key">
				<label for="Them" <?php echo $ThemStyle  ?> >
					<?php echo JText::_( 'THEM' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="Them" id="Them" size="5" maxlength="5" value="<?php echo $this->item['Them'];?>" />
			</td>
		</tr>		 -->
		<tr>
			<td width="100" align="right" class="key">
				<label for="Notes" <?php echo $NotesStyle  ?> >
					<?php echo JText::_( 'NOTES' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<TEXTAREA name="Notes" rows="5" cols="50"><?php echo $this->item['Notes'];?></textarea>
			</td>
		</tr>		
	</table>
</td>
</tr>
</table>	
	</fieldset>

		<?php ##ECR_VIEW2_TMPL1_OPTION3## ?>

	<input type="hidden" name="cid[]" value="<?php echo $this->item['racerID']; ?>" />
	<input type="hidden" name="racerID" value="<?php echo $this->item['racerID']; ?>" />
	<input type="hidden" name="option" value="com_teamracing" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="controller" value="racer" />
</form>
