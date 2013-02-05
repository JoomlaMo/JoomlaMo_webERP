<?php 

defined('_JEXEC') or die('Restricted access'); 

JHTML::_('behavior.tooltip');
$InventoryLocations = $this->locations;
?>

<script language="javascript" type="text/javascript">
/**
* Submit the admin form
* 
* small hack: let task desides where it comes
*/
function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
     
	 if ((pressbutton=='add')||(pressbutton=='edit')||(pressbutton=='remove') )
	 {
	  form.controller.value="barcode";
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	
	form.submit();
}


</script>

<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm" >
<DIV>
Filter:
	<SELECT name="Filter" onchange="document.adminForm.submitform('filter')">
	<OPTION value="ALL">All</OPTION>
<?
Foreach($InventoryLocations as $id=>$location){
?>	
		<OPTION value="<?=$id?>"><?=$location?></OPTION>
<?
}
?>		
	</SELECT>	
</DIV>
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5%">
				<?php echo JText::_( 'NUM' ); ?>
			</th>
			<th width="5%">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>
			<th width="25%" nowrap="nowrap">
				Part Number
		 	</th>		 
			<th width="25%" nowrap="nowrap">
				Description
			</th>
			<th width="10%"  class="title">
				On Hand
			</th>
		</tr>
	</thead>	
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		$link 	= JRoute::_( 'index.php?option=com_jbarcode&controller=barcode&task=edit&cid[]='. $row->id );
		
		$partnumber 		= $row->partnumber;
		$description 		= $row->description;
		$onhand 				= $row->onhand;
		$reorderlevel 		= $row->reorderlevel;
		$reorderquantity 	= $row->reorderquantity;
		If(gettype($row) == 'object'){
			$checked 			= JHTML::_('grid.checkedout',$row, $i );
		}else{
			$checked 			= '';
		}
		


		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $this->pagination->getRowOffset( $i ); ?>
			</td>
			<td align="center">
<?
		If(isset($checked)){
?>			
				<?php echo $checked; ?>
<?
		}
?>				
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
<input type="hidden" name="controller" value="barcode" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>
