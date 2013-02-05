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

defined( '_JEXEC' ) or die( 'Restricted access' );
$OnOrder = $this->orders;
JHTML::_('behavior.tooltip');
global $Reference;
?>

<script language="javascript" type="text/javascript">
/**
* Submit the admin form
* 
* small hack: let task decides where it comes
*/
function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
    
	if ((pressbutton=='add')||(pressbutton=='edit') )
	 {
	  form.controller.value="createorders";
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	
	form.submit();
}


</script>

<form action="<?php echo  $this->request_url; ?>" method="post" name="adminForm" >
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo  JText::_( 'NUM' ); ?>
			</th>
			<th class="title">
				<?php echo  JHTML::_('grid.sort','Reference', 'reference'); ?>
			</th>	
			<th class="title">
				<?php echo  JHTML::_('grid.sort', 'Part Number', 'partnumber' )?>
			</th>
			<th class="title">
				<?php echo  JHTML::_('grid.sort', 'Quantity to Order', 'quantityordered' ); ?>
			</th>
			<th class="title">
				<?php echo  JHTML::_('grid.sort','Date', 'date'); ?>
			</th>			
		</tr>
	</thead>	
	<form action="<?php echo  JRoute::_($this->request_url)?>" method="post" name="adminForm">
<?php

	$k = 0;
	// echo count( $this->items ) . "=count inventory<BR>";
	
	$WeHaveNoOrders = True;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		// var_dump($this->items[$i]);
		// echo "<BR>this->items[$i]<BR><BR><BR><BR>";
		$row =& $this->items[$i];
		// var_dump($row);
		// echo "<BR>row<BR><BR><BR><BR>";
		$OrderPart			=	$row->partnumber;
		$Reorderlevel 		= 	(integer)$row->reorderlevel;
		$Reorderquantity 	=  $row->reorderquantity;
		$OnHand				=	(integer)$row->onhand;
		IF(!isset($OnOrder[$OrderPart])){
			$OnOrder[$OrderPart] = 0;
		}
		$QuantityToOrder = $Reorderlevel-($OnHand+$OnOrder[$OrderPart]);
		If($QuantityToOrder > 0){	
			$WeHaveNoOrders = False;
			If($QuantityToOrder < $Reorderquantity){
				$QuantityToOrder = $Reorderquantity;
			}		
			$QuantityReceived = 0;
			$Date = date("m-d-Y");
			?>
			<tr class="<?php echo  "row$k"; ?>">
				<td>
					<?php echo  $this->pagination->getRowOffset( $i ); ?>
				</td>	
				<td>
					<?php echo  $Reference; ?>
				</td>
				<td>
					<?php echo  $row->partnumber; ?>
				</td>
				<td>
					<input class="text_area" type="text" name='Order[<?php echo  $OrderPart?>]' id='Order[<?php echo  $OrderPart?>]' size="10" maxlength="10" value="<?php echo  $QuantityToOrder; ?>" />
					
				</td>		
				<td>
					<?php echo  $Date; ?></a>
				</td>			
			</tr>
			<?php
			$k = 1 - $k;  
		}
		
	}
	If($WeHaveNoOrders){
?>
			<tr>
				<td colspan="5">
					<H3>There are no items that require ordering.</H3>
				</td>			
			</tr>
			<?php
	}
	?>
<tfoot>
		<td colspan="9">
			<?php echo  $this->pagination->getListFooter(); ?>
		</td>
	</tfoot>
	</table>
</div>

<input type="hidden" name="controller" value="createorders" />
<input type="hidden" name="task" value="save" />
</form>
