<?php

defined('_JEXEC') or die('=;)');

?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_('Action'); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="Date">
					<?php echo JText::_('Date'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="Date" id="Date" size="10" maxlength="10" value="<?php echo $this->Action->Date?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Time">
					<?php echo JText::_('Time'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="Time" name=" " id="Time" size="10" maxlength="10" value="<?php echo $this->Action->Time;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Done">
					<?php echo JText::_('Done Date'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="Done" name="Done" id="done" size="10" maxlength="10" value="<?php echo $this->Action->Done;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="DoneTime">
					<?php echo JText::_('Done Time'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="DoneTime" id="DoneTime" size="10" maxlength="10" value="<?php echo $this->Action->DoneTime;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Notes">
					<?php echo JText::_('Notes'); ?>:
				</label>
			</td>
			<td>
				<textarea name="Notes" rows="5" cols="40"><?php if (isset($this->Action->Notes)) { echo $this->Action->Notes; } ?></textarea>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="PersonID">
					<?php echo JText::_('Person ID'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="PersonID" id="PersonID" size="10" maxlength="10" value="<?php echo $this->Action->PersonID;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="DocumentNumber">
					<?php echo JText::_('Document Number'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="DocumentNumber" id="DocumentNumber" size="10" maxlength="10" value="<?php echo $this->Action->DocumentNumber;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="JobID">
					<?php echo JText::_('Job ID'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="JobID" id="JobID" size="10" maxlength="10" value="<?php echo $this->Action->JobID;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Date">
					<?php echo JText::_('Process ID'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="ProcessID" id="ProcessID" size="10" maxlength="10" value="<?php echo $this->Action->ProcessID;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="StartTime">
					<?php echo JText::_('Start Time'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="StartTime" id="StartTime" size="10" maxlength="10" value="<?php echo $this->Action->StartTime;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="StartDate">
					<?php echo JText::_('Start Date'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="StartDate" id="StartDate" size="10" maxlength="10" value="<?php echo $this->Action->StartDate;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="DueTime">
					<?php echo JText::_('DueTime'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="DueTime" id="DueTime" size="10" maxlength="10" value="<?php echo $this->Action->DueTime;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="DueDate">
					<?php echo JText::_('DueDate'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="DueDate" id="DueDate" size="10" maxlength="10" value="<?php echo $this->Action->DueDate;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Complete">
					<?php echo JText::_('Complete'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="Complete" id="Complete" size="10" maxlength="10" value="<?php echo $this->Action->Complete;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Thread">
					<?php echo JText::_('Thread'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="Thread" id="Thread" size="10" maxlength="10" value="<?php echo $this->Action->Thread;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="CompletedBy">
					<?php echo JText::_('Completed By'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="CompletedBy" id="CompletedBy" size="10" maxlength="10" value="<?php echo $this->Action->CompletedBy;?>" />
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_action" />
<input type="hidden" name="id" value="<?php echo $this->Action->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="action" />
</form>
