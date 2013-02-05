<?php

defined('_JEXEC') or die('=;)');

JHTML::_('behavior.tooltip');
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'Details' ); ?></legend>
	<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="EstimatedTime">
					<?php echo JText::_( 'Estimated Time' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="EstimatedTime" id="EstimatedTime" size="32" maxlength="250" value="<?php echo $this->item->EstimatedTime;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Process">
					<?php echo JText::_( 'Process ID' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="ProcessID" id="ProcessID" size="11" maxlength="11" value="<?php echo $this->item->ProcessID;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Action">
					<?php echo JText::_( 'Action ID' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="ActionID" id="ActionID" size="32" maxlength="250" value="<?php echo $this->item->ActionID;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Thread">
					<?php echo JText::_( 'Thread ID' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="ThreadID" id="ThreadID" size="32" maxlength="250" value="<?php echo $this->item->ThreadID;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Checked">
					<?php echo JText::_( 'Checked' ); ?>:
				</label>
			</td>
			<td colspan="2">
<?php
If($this->item->Checked == 'Y'){
?>			
				<input type="checkbox" name="Checked" value="TRUE" />
<?php
}else{
?>			
				<input type="checkbox" name="Checked" />
<?php
}				
?>	
			</td>
		</tr>								
	</table>
	</fieldset>
		


	<input type="hidden" name="cid[]" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="option" value="com_Action" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="controller" value="checklist" />
</form>
