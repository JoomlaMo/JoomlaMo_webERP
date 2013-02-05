<?php

defined('_JEXEC') or die('=;)');

JHTML::_('behavior.tooltip');
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'Title' ); ?></legend>
	<table class="admintable">
		<tr>
			<td colspan="2">
				<input type="text" name="title" value="<?php echo $this->item->title;?>" size="50" maxlength="100">
			</td>
		</tr>
	</table>
	</fieldset>
		
		<fieldset class="adminform">
		<legend><?php echo JText::_( 'Description' ); ?></legend>
		<table class="admintable">
			<tr>
			<td colspan="2">
				<textarea name="description" rows="3" cols="100"><?php echo $this->item->description;?></textarea>
			</td>
			</tr>		
		
		</table>
	</fieldset>

	<input type="hidden" name="cid[]" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="option" value="com_action" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="controller" value="jobs" />
</form>
