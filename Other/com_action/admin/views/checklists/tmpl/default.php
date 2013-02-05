<?php

defined('_JEXEC') or die('=;)');

JHTML::_('behavior.tooltip');

$ordering = ($this->lists['order'] == 'ordering');

?>
<form action="index.php" method="post" name="adminForm">
<table>
	<tr>
		<td align="left" width="100%">
			<?php echo JText::_( 'Filter' ); ?>:
			<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
			<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
			<button onclick="document.getElementById('search').value='';this.form.getElementById('filter_item').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
		</td>

	</tr>
</table>
<div id="tablecell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( 'NUM' ); ?>
			</th>
			<th width="5%">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->elements ); ?>);" />
			</th>
			<th>
				<?php echo JHTML::_('grid.sort', 'EstimatedTime', 'EstimatedTime', $this->lists['order_Dir'], $this->lists['order']);?>
			</th>
			<th>
				<?php echo JHTML::_('grid.sort', 'ProcessID', 'ProcessID', $this->lists['order_Dir'], $this->lists['order']);?>
			</th>
			<th>
				<?php echo JHTML::_('grid.sort', 'ActionID', 'ActionID', $this->lists['order_Dir'], $this->lists['order']);?>
			</th>
			<th>
				<?php echo JHTML::_('grid.sort', 'ThreadID', 'ThreadID', $this->lists['order_Dir'], $this->lists['order']);?>
			</th>
			<th>
				<?php echo JHTML::_('grid.sort', 'Checked', 'Checked', $this->lists['order_Dir'], $this->lists['order']);?>
			</th>
<!-- 			<th width=\"8%\">
				<?php echo JHTML::_('grid.sort', 'Order by', 'ordering', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				<?php echo JHTML::_('grid.order', $this->elements ); ?>
			</th> -->
			<th width="1%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',   'id', 'id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
		</tr>
	</thead>
	
	<tbody>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		$link 		= JRoute::_( 'index.php?option=com_Action&controller=checklist&task=edit&cid[]='. $row->id);
		
		$checked = JHTML::_('grid.id',  $i, $row->id );
		$published 	= JHTML::_('grid.published', $row, $i );
	?>
		<tr class="<?php echo "row$k"; ?>">
			<td width="5%">
				<?php echo $this->pagination->getRowOffset( $i ); ?>
			</td>
			<td width="5%">
				<?php echo $checked; ?>
			</td>
			<td>
				<span class="editlinktip hasTip" title="<?php echo JText::_( 'Edit checklist' );?>::<?php echo $row->title; ?>">
				<a href="<?php echo $link  ?>">
					<?php echo $row->title; ?></a></span>
			</td>
			<td>
				<?php echo $row->EstimatedTime; ?></a>
			</td>
			<td>
				<?php echo $row->ProcessID; ?></a>
			</td>
			<td>
				<?php echo $row->ActionID; ?></a>
			</td>
			<td>
				<?php echo $row->ThreadID; ?></a>
			</td>
			<td>
				<?php echo $row->Checked; ?></a>
			</td>
			<td align="center">
				<?php echo $published;?>
			</td>
<!-- 			<td class='order'>
				<span><?php echo $this->pagination->orderUpIcon( $i, true, 'orderup', 'Move Up', $ordering ); ?></span>
				<span><?php echo $this->pagination->orderDownIcon( $i, $n, true, 'orderdown', 'Move Down', $ordering ); ?></span>
				<?php $disabled = $ordering ?  '' : 'disabled=\"disabled\"'; ?>
				<input type='text' name='order[]' size='5' value='<?php echo $row->ordering; ?>' <?php echo $disabled; ?> class='text_area' style='text-align: center' />
			</td> -->
			<td align="center">
				<?php echo $row->id; ?>
			</td>
		</tr>
		<?php
			$k = 1 - $k;
		}
		?>
	</tbody>
    <tfoot>
    <tr>
      <td colspan="13"><?php echo $this->pagination->getListFooter(); ?></td>
    </tr>
  </tfoot>
	</table>
</div>
	<input type="hidden" name="option" value="com_Action" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
	<input type="hidden" name="controller" value="checklist" />
	<input type="hidden" name="view" value="checklists" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
