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

<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm" >
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5%">
				<?php echo JText::_( 'NUM' ); ?>
			</th>
			<th width="25%" nowrap="nowrap">
				Part Number
		 	</th>		 
			<th width="25%" nowrap="nowrap">
				Description
			</th>
			<th width="10%"  class="title" align="right">
				On Hand
			</th>
			<th width="10%" align="right">
				ReOrder Level
			</th>
			<th width="10%" align="right">
				Order Quantity
			</th>
		</tr>
	</thead>	
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		$link 	= JRoute::_( 'index.php?option=com_jinventory&controller=usage&task=edit&cid[]='. $row->id );
		
		$partnumber 		= $row->partnumber;
		$description 		= $row->description;
		$onhand 				= $row->onhand;
		$reorderlevel 		= $row->reorderlevel;
		$orderquantity 	= $row->reorderquantity;


		?>
		<tr class="<?php echo "row$k"; ?>">
			<td align="right">
				<?php echo $this->pagination->getRowOffset( $i ); ?>
			</td>
			<td>				
				<?php echo $row->partnumber; ?>
			</td>
			<td>
				<?php echo $description; ?>
			</td>
			<td align="right">
				<?php echo $onhand; ?>
			</td>
			<td align="right">
				<?php echo $reorderlevel; ?>
			</td>
			<td align="right">
				<?php echo $orderquantity; ?>
			</td>			
		</tr>
<?php
		$k = 1 - $k;
	}
?>
<tfoot>
		<td colspan="9">
			<?php echo $this->pagination->getListFooter(); ?>
		</td>
	</tfoot>
	</table>
</div>

<input type="hidden" name="id" value="$id" />
<input type="hidden" name="controller" value="inventory" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>
