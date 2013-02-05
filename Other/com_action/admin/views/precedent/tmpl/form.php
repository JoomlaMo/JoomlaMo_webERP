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
				<label for="Precedent">
					<?php echo JText::_( 'Precedent' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="PrecedentID" id="PrecedentID" size="11" maxlength="11" value="<?php echo $this->item->PrecedentID;?>" />
			</td>
		</tr>
		<tr>
			<td valign="top" align="right" class="key">
				<?php echo JText::_( 'Action' ); ?>:
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="ProcessID" id="ProcessID" size="11" maxlength="11" value="<?php echo $this->item->ProcessID;?>" />
			</td>
		</tr>
	</table>
	</fieldset>
		


	<input type="hidden" name="cid[]" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="option" value="com_Action" />
	<input type="hidden" name="task" value="save" />
	<input type="hidden" name="controller" value="precedent" />
</form>
