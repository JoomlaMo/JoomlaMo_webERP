<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.tooltip');
$Asset_Types =& $this->Asset_Types;
?>
<script language="javascript" type="text/javascript">
function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
    
	if ((pressbutton=='add')||(pressbutton=='edit')||(pressbutton=='remove'))
	 {
	  form.controller.value="keyword_detail";
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
			<td align="left" colspan="3">Use a portion of the keyword name to 
				<?php echo JText::_( 'Filter' ); ?>:
				<input type="text" name="search" id="search" class="text_area" onchange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>	
				To clear the filter, leave blank and click go.					
			</td>
			<TD><B>OR</B></TD>
			<td nowrap="nowrap">Filter by Asset Type 
				<SELECT name='asset_type' onchange="this.form.submit();">
					<OPTION value='ALL'>All</OPTION>
<?php
Foreach($Asset_Types['description'] as $ID=>$Description){
	$post	= JRequest::get('post');
	If(isset($post['asset_type']) and $post['asset_type']==$ID and strlen(trim($post['search']))==0 ){
		$Selected = 'SELECTED';
	}else{
		$Selected = '';
	} 
?>
					<OPTION value='<?php echo $ID?>' <?php echo $Selected;?>><?php echo $Description;?></OPTION>
<?php					
}				
?>
				</SELECT>
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
				<?php echo JText::_( 'Asset Type' ); ?>
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
		$link 	= JRoute::_( 'index.php?option=com_emergencypreparedness&controller=keyword_detail&task=edit&cid[]='. $row->id );
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
<?php
		if(isset($Asset_Types['description'][$row->asset_type])){
?>			
				<?php echo $Asset_Types['description'][$row->asset_type]; ?></a>
<?php
		}else{
			echo "<b style='color:brown'>No Asset Type for Keyword</b>";
		}
?>				
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
			<?php echo $this->pagination->getListFooter(); ?>
		</td>
	</tfoot>
	</table>
</div>
<input type="hidden" name="controller" value="keyword" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>
