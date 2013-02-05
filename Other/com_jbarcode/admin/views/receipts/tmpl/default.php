<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

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
   form.task.value="printrec";
   form.controller.value="receipts";
	form.submit();
}


</script>

<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm" >
<div id="editcell">
	<table class="adminlist" width="50%">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( 'NUM' ); ?>
			</th>
			<th width="5%">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>
			<th class="title">
				<?php echo JHTML::_('grid.sort','Reference', 'reference'); ?>
			</th>	
			<th class="title">
				<?php echo JHTML::_('grid.sort','Date', 'date'); ?>
			</th>	
			<TH width="50%"></TH>		
		</tr>
	</thead>	
	<form action="<?php echo JRoute::_($this->request_url)?>" method="post" name="adminForm">
<?php
	
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row =& $this->items[$i];
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
?>					</td>
				<td>
					<?php echo $row->reference; ?>
				</td>
				<td>
					<?php echo $row->date; ?></a>
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
		<TD></TD>
	</tfoot>
	</table>
</div>

<input type="hidden" name="controller" value="printord" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>
