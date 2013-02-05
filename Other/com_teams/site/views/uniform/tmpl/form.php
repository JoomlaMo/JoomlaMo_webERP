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
	If(array_key_exists('UniformDescription', $PostPrevious)){
		$this->item['UniformDescription'] = $PostPrevious['UniformDescription'];
	}	
}
$TeamNames = $this->teamnames;
If($mainframe->getUserState( "UniformDescription")==1 AND  isset($PostPrevious['UniformDescription'])){
	$UniformDescriptionStyle = " style='color:red' ";
}else{
	$UniformDescriptionStyle = "";
}
?>
<script language="javascript" type="text/javascript">
function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
     
	 if (pressbutton=='save')
	 {
	  form.controller.value="uniform";
	 }
	 if(pressbutton=='cancel')
	 {
	  form.controller.value="uniform";
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	
	form.submit();
}
</script>
<div style="float:left"><h1><?php echo JText::_('UNIFORMS'); ?></h1></div>
<div class="div_block" style="float:right"><?php echo teamseditHelperToolbar::getToolbar();?></div><br><br>
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'DETAILS' ); ?></legend>
	<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="UniformDescription" <?php echo $UniformDescriptionStyle  ?>>
					<?php echo JText::_( 'UNIFORM_DESCRIPTION' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="UniformDescription" id="UniformDescription" size="20" maxlength="20" value="<?php echo $this->item['UniformDescription'];?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="left" class="key">
				<label for="TeamName">
					<?php echo JText::_( 'TEAM_NAME' ); ?>:
				</label>
			</td>
			<td colspan="2">	
				<select name="TeamID">
					<option value="0"><?php echo JText::_( 'ANY_TEAM' ); ?></option>
<?php
while(list($key, $val)=each($TeamNames)) {
	if( (isset($this->item['TeamID']) && ($this->item['TeamID'] == $key))  OR (isset($PostPrevious['TeamID']) AND $PostPrevious['TeamID']==$key) ) {
			echo '<option value="'.$key.'" selected>'.$val['TeamName'].'</option>';
	} else {
			echo '<option value="'.$key.'">'.$val['TeamName'].'</option>';
	}
}
?>
				</select>
			</td>
		</tr>
	</table>
	</fieldset>

		<?php ##ECR_VIEW2_TMPL1_OPTION3## ?>

	<input type="hidden" name="cid[]" value="<?php echo $this->item['UniformID']; ?>" />
	<input type="hidden" name="UniformID" value="<?php echo $this->item['UniformID']; ?>" />
	<input type="hidden" name="option" value="com_teams" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="controller" value="uniform" />
</form>
