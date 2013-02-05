<?php
/**
* @package JInventory
* @version 1.5
* @copyright Copyright (C) 2008 Mo Kelly. All rights reserved.
   
*	This program is free software: you can redistribute it and/or modify    
*	it under the terms of the GNU General Public License as published by
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
defined('_JEXEC') or die('Restricted access');
//DEVNOTE: import html tooltips
JHTML::_('behavior.tooltip');
?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}

		// do field validation
		if (form.partnumber.value == ""){
			alert( "<?php echo JText::_( 'item must have a partnumber', true ); ?>" );
		} else if (form.description.value == ""){
			alert( "<?php echo JText::_( 'You must have a description.', true ); ?>" );
		} else {
			submitform( pressbutton );
		}
	}
</script>
<style type="text/css">
	table.paramlist td.paramlist_key {
		width: 92px;
		text-align: left;
		height: 30px;
	}
</style>
<form action="<?php echo JRoute::_($this->request_url)?>" method="post" name="adminForm">
<div class="col100">
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'DETAILS' ); ?></legend>
	
	<table class="admintable">
			<tr>
				<td width="20%" class="key">
					<label for="partnumber">
						<?php echo JText::_( 'Part Number' ); ?>:
					</label>	
				</td>
				<td>
					<input class="text_area" type="text" name="partnumber" id="partnumber" size="10" maxlength="10" value="<?php echo $this->detail->partnumber;?>" />
				</td>
			</tr>
			<tr>
				<td width="20%" class="key">
					<label for="description">
					<?php echo JText::_( 'Description' ); ?>:
					</label>
				</td>
				<td>
					<input class="text_area" type="text" name="description" id="description" size="30" maxlength="30" value="<?php echo $this->detail->description;?>" />
				</td>
			</tr>
			<tr>
				<label for="onhand">
				<td width="20%" class="key">
				<label for="onhand">
					<?php echo JText::_( 'On Hand' ); ?>:
				</label>
				</td>
				<td>
					<input class="text_area" type="text" name="onhand" id="onhand" size="50" maxlength="50" value="<?php echo $this->detail->onhand;?>" />
				</td>
			</tr>
			<tr>
				<td width="20%" class="key">
				<label for="reorderlevel">
					<?php echo JText::_( 'Reorder Level' ); ?>:
				</label>
				</td>
				<td>
					<input class="text_area" type="text" name="reorderlevel" id="reorderlevel" size="50" maxlength="50" value="<?php echo $this->detail->reorderlevel;?>" />
				</td>
			</tr>
			<tr>
				<td width="20%" class="key">
				<label for="reorderquantity">
					<?php echo JText::_( 'ReOrder Quantity' ); ?>:
				</label>
				</td>
				<td>
					<input class="text_area" type="text" name="reorderquantity" id="reorderquantity" size="50" maxlength="50" value="<?php echo $this->detail->reorderquantity;?>" />
				</td>
			</tr>
		</tbody>
	</table>
	<input type="hidden" name="cid[]" value="<?php echo $this->detail->id; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="controller" value="inventory_detail" />
</form>


