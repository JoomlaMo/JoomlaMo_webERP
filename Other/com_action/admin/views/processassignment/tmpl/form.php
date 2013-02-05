<?php
/**
 * @version SVN: $Id$
 * @package    Action
 * @subpackage Views
 * @author     EasyJoomla {@link http://www.easy-joomla.org Easy-Joomla.org}
 * @author     Mo Kelly {@link http://joomlamo.com}
 * @author     Created on 27-Apr-10
 */

//-- No direct access
defined('_JEXEC') or die('=;)');

JHTML::_('behavior.tooltip');
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'Details' ); ?></legend>
	<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'PersonID' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="PersonID" id="PersonID" size="11" maxlength="11" value="<?php echo $this->item->PersonID;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'ProcessID' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="ProcessID" id="ProcessID" size="11" maxlength="11" value="<?php echo $this->item->PersonID;?>" />
			</td>
		</tr>	
	</table>


	<input type="hidden" name="cid[]" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="option" value="com_action" />
	<input type="hidden" name="task" value="save" />
	<input type="hidden" name="controller" value="processassignment" />
</form>
