<?php
/**
* @package UserStatus
* @version 1.5
* @copyright Copyright (C) 2010 Mo Kelly. All rights reserved.
   
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
if(!$this->detail->id == 0){
	$ID 				= $this->detail->id;
	$Description 	= $this->detail->description;
	$Address			= $this->detail->address;	
	$City				= $this->detail->city;	
	$County			= $this->detail->county;	
	$State			= $this->detail->state;	
	$Zip				= $this->detail->zip;	
	$Notes			=	$this->detail->notes;
}else{
	$ID 				= "New";
	$Description 	= '';
	$Address			= '';
	$City				= '';
	$County			= '';
	$State			= '';	
	$Zip				= '';
	$Notes			= '';
	$Notes			=	'';
}
?>
<style type="text/css">
	table.paramlist td.paramlist_key {
		width: 92px;
		text-align: left;
		height: 30px;
	}
</style>
<form action="index.php?option=com_userstatus&task=save&controller=locations_detail" method="post" name="adminForm" id="adminForm">
<div class="col50">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">		
		<tr>
			<td width="100" align="right" class="key">
				<label for="id">
					<?php echo JText::_( 'Id' ); ?>:
				</label>
			</td>
			<td>
				<?php echo $ID; ?>				
				<input type="hidden" name="id" value="<?php echo $this->detail->id; ?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="make">
					<?php echo JText::_( 'Location' ); ?>:
				</label>
			</td>	
			<td>
				<input class="text_area" type="text" name="description" id="description" size="40" maxlength="100" value="<?php echo $Description;?>" />
			</td>		
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="model">
					<?php echo JText::_( 'Address' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="address" id="address" size="40" maxlength="100" value="<?php echo $Address;?>" />
			</td>
		</tr>	
		<tr>
			<td width="100" align="right" class="key">
				<label for="abb">
					<?php echo JText::_( 'City' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="city" id="city" size="40" maxlength="100" value="<?php echo $City;?>" />
			</td>
		</tr>	
		<tr>
			<td width="100" align="right" class="key">
				<label for="abb">
					<?php echo JText::_( 'County' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="county" id="county" size="40" maxlength="100" value="<?php echo $County;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="abb">
					<?php echo JText::_( 'State' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="state" id="state" size="40" maxlength="100" value="<?php echo $State;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="abb">
					<?php echo JText::_( 'Zip' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="zip" id="zip" size="40" maxlength="100" value="<?php echo $Zip;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="abb">
					<?php echo JText::_( 'Notes' ); ?>:
				</label>
			</td>
			<td>
				<TEXTAREA  class="text_area" name="notes" id="notes" rows="10" cols="40"><?php echo $Notes;?></textarea>
			</td>
		</tr>
		
	</table>
	</fieldset>
</div>
<div class="col50">
</div>
<div class="clr"></div>
<input type="hidden" name="cid[]" value="<?php echo $this->detail->id; ?>" />
<input type="hidden" name="task" value="save" />
<input type="hidden" name="controller" value="locations_detail" />
</form>


