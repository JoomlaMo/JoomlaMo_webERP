<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

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
    
	if ((pressbutton=='add')||(pressbutton=='edit')||(pressbutton=='remove'))
	 {
	  form.controller.value="assettype_detail";
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
			<td align="left" colspan="3">Use a portion of the Asset type description to 
				<?php echo JText::_( 'Filter' ); ?>:
				<input type="text" name="search" id="search" class="text_area" onchange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>	
				To clear the filter, leave blank and click go.			
			</td>			
		</tr>
		<tr>
			<th width="5">
				<?php echo JText::_( 'NUM' ); ?>
			</th>
			<th width="5%">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>
			<th class="title">
				<?php echo JText::_( 'ID' ); ?>
			</th>
			<th class="title">
				<?php echo JText::_( 'Description' ); ?>
			</th>	
			<th class="title">
				<?php echo JText::_( 'Notes' ); ?>
			</th>			
		</tr>
	</thead>	
<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		$checked 			= JHTML::_('grid.checkedout',   $row, $i);

		$link 	= JRoute::_( 'index.php?option=com_emergencypreparedness&controller=assettype_detail&task=edit&cid[]='. $row->id );

?>
		<tr class="<?php echo "row$k"; ?>">
			<td>				
				<?php echo $this->pagination->getRowOffset( $i ); ?>
			</td>	
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
				<a href="<?php echo $link; ?>" >
					<?php echo $row->id; ?>
				</a>
			</td>
			<td>
				<?php echo $row->description; ?></a>
			</td>	
			<td>
				<?php echo $row->notes; ?></a>
			</td>				
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
<tfoot>
		<td colspan="9">
		</td>
	</tfoot>
	</table>
</div>

<input type="hidden" name="controller" value="assettype" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>
