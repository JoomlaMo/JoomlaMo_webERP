<?php
defined('_JEXEC') or die('=;)');

?>
<form action="index.php" method="post" name="adminForm">
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( 'ID' ); ?>
			</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>			
			<th>
				<?php echo JText::_( 'Date' ); ?>
			</th>			
			<th>
				<?php echo JText::_( 'Done' ); ?>
			</th>		
			<th>
				<?php echo JText::_( 'Notes' ); ?>
			</th>		
			<th>
				<?php echo JText::_( 'Person ID' ); ?>
			</th>		
			<th>
				<?php echo JText::_( 'CustomerOrderNumber' ); ?>
			</th>		
			<th>
				<?php echo JText::_( 'SalesOrderNumber' ); ?>
			</th>		
			<th>
				<?php echo JText::_( 'InvoiceNumber' ); ?>
			</th>		
			<th>
				<?php echo JText::_( 'Job ID' ); ?>
			</th>		
			<th>
				<?php echo JText::_( 'ProcessID' ); ?>
			</th>		
			<th>
				<?php echo JText::_( 'Start' ); ?>
			</th>		
			<th>
				<?php echo JText::_( 'Due' ); ?>
			</th>		
			<th>
				<?php echo JText::_( 'Complete' ); ?>
			</th>		
			<th>
				<?php echo JText::_( 'Thread' ); ?>
			</th>		
			<th>
				<?php echo JText::_( 'CompletedBy' ); ?>
			</th>
		</tr>			
	</thead>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$link 		= JRoute::_( 'index.php?option=com_action&controller=action&task=edit&cid[]='. $row->id );

		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $row->id; ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
				<a href="<?php echo $link; ?>"><?php echo $row->Date; ?></a>
			</td>
			<td>
				<?php echo $row->Date; ?>
			</td>
			<td>
				<?php echo $row->DoneTime; ?>
			</td>
			<td>
				<?php echo $row->Notes; ?>
			</td>
			<td>
				<?php echo $row->PersonID; ?>
			</td>
			<td>
				<?php echo $row->CustomerOrderNumber; ?>
			</td>
			<td>
				<?php echo $row->SalesOrderNumber; ?>
			</td>
			<td>
				<?php echo $row->InvoiceNumber; ?>
			</td>
			<td>
				<?php echo $row->JobID; ?>
			</td>
			<td>
				<?php echo $row->ProcessID; ?>
			</td>
			<td>
				<?php echo $row->Start; ?>
			</td>
			<td>
				<?php echo $row->Due; ?>
			</td>
			<td>
				<?php echo $row->Complete; ?>
			</td>
			<td>
				<?php echo $row->Thread; ?>
			</td>
			<td>
				<?php echo $row->CompletedBy; ?>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
	 <tfoot>
    <tr>
      <td colspan="3">
      	<?php echo $this->pagination->getListFooter(); ?>
      </td>
    </tr>
  </tfoot>
	</table>
</div>

<input type="hidden" name="option" value="com_action" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="action" />
</form>
