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

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//DEVNOTE: import html tooltips
JHTML::_('behavior.tooltip');



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
    
	if ((pressbutton=='add')||(pressbutton=='edit')||(pressbutton=='publish')||(pressbutton=='unpublish')
	 ||(pressbutton=='orderdown')||(pressbutton=='orderup')||(pressbutton=='saveorder') )
	 {
	  form.controller.value="receive_detail";
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	
	form.submit();
}


</script>

<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm" >
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( 'NUM' ); ?>
			</th>
			<th class="title">
				Part Number
			</th>
			<th class="title">
				Reference
			</th>
			<th class="title">
				Quantity
			</th>
			
			<th class="title">
				Receipts
			</th>
		</tr>
	</thead>	
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		$OrderPart = $row->partnumber;
		$Received[$OrderPart]=$row->quantityordered - $row->quantityreceived;
		$Reference = $row->reference;
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $this->pagination->getRowOffset( $i ); ?>
			</td>
			<td>
				<?php echo $row->partnumber; ?>				
			</td>
			<td>
				<?php echo $row->reference; ?>
			</td>
			<td>
				<?php echo $row->quantityordered; ?>
			</td>	
			<td>
				<input class="text_area" type="text" name='Received[<?php echo $OrderPart;?>]' id='Received[<?php echo $OrderPart;?>]' size="10" maxlength="10" value="<?php echo $Received[$OrderPart];?> " />
			</td>					
		</tr>
		<?php
		$k = 1 - $k;
	}
	If(!isset($Reference)){
		$Reference = '';
	}
	?>
<tfoot>
		<td colspan="9">
			<?php echo $this->pagination->getListFooter(); ?>
		</td>
	</tfoot>
	</table>
</div>

<input type="hidden" name="controller" value="createreceipts" />
<input type="hidden" name="task" value="save" />
<input type="hidden" name="reference" value="<?php echo $Reference?>" />
</form>
