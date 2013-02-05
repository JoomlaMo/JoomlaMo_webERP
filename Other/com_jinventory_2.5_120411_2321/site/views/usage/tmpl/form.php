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
JHTML::_('behavior.tooltip');
?>



<form action="<?php echo JRoute::_($this->request_url)?>" method="post" name="usageForm">
<div class="col100">
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'Record Usage' ); ?></legend>
	
	<table class="admintable">
			<tr>
				<td width="20%" class="key">
					<label for="partnumber">
						<?php echo JText::_( 'Part Number' ); ?>:
					</label>	
				</td>
				<td>
					<input class="text_area" type="text" name="partnumber" id="partnumber" size="20" maxlength="20" />
				</td>
			</tr>
			<tr>
				<td width="20%" class="key">
				<label for="quantity">
					<?php echo JText::_( 'Quantity' ); ?>:
				</label>
				</td>
				<td>
					<input class="text_area" type="text" name="quantity" id="quantity" size="5" maxlength="5" value="1" />
				</td>
			</tr>	
			<tr>
				<td width="20%" class="key">
					<label for="reference">
					<?php echo JText::_( 'Reference' ); ?>:
					</label>
				</td>
				<td>
					<input class="text_area" type="text" name="reference" id="reference" size="50" maxlength="50" />
				</td>
			</tr>
			<TR>
				<td width="100%" nowrap="nowrap" colspan="2" align="center">
					<button name="Search" onClick="this.form.submit()" class="button"><?php echo JText::_( 'Enter' );?></button>
				</td>
			</TR>
		</tbody>
	</table>
	<input type="hidden" name="cid[]" value="<?php echo $this->detail->id; ?>" />
	<input type="hidden" name="task" value="save" />
	<input type="hidden" name="controller" value="usage" />
</form>


