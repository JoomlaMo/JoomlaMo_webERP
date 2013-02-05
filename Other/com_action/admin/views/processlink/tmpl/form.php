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
				<label for="Description">
					<?php echo JText::_( 'Description' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="Description" id="Description" size="32" maxlength="250" value="<?php echo $this->item->Description;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="URL">
					<?php echo JText::_( 'URL' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="URL" id="URL" size="32" maxlength="250" value="<?php echo $this->item->URL;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'ProcessCheckListID' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="ProcessCheckListID" id="ProcessCheckListID" size="32" maxlength="250" value="<?php echo $this->item->ProcessCheckListID;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="Ordering">
					<?php echo JText::_( 'Ordering' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="Ordering" id="Ordering" size="32" maxlength="250" value="<?php echo $this->item->Ordering;?>" />
			</td>
		</tr>
	</table>
	</fieldset>		
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'LinkDescription' ); ?></legend>
		<table class="admintable">
			<tr>
			<td valign="top" colspan="3">
			<?php
				echo $this->editor->display( 'LinkDescription', $this->item->description, '550', '300', '60', '20', array('pagebreak', 'readmore') ) ;
			?>
			</td>
			</tr>					
		</table>
	</fieldset>

	<input type="hidden" name="cid[]" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="option" value="com_Action" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="controller" value="processlink" />
</form>
