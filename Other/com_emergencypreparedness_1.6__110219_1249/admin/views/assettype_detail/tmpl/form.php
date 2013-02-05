<?php

defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.tooltip');
if(!$this->detail->id == 0){
	$ID = $this->detail->id;
	$Description = $this->detail->description;
}else{
	$ID = "New";
	$Description = '';
}
?>

<style type="text/css">
	table.paramlist td.paramlist_key {
		width: 92px;
		text-align: left;
		height: 30px;
	}
</style>
<form action="index.php?option=com_emergencypreparedness&task=save&controller=assettype_detail" method="post" name="adminForm" id="adminForm">
<div class="col50">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Assets' ); ?></legend>

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
				<label for="model">
					<?php echo JText::_( 'Asset Type' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="description" id="description" size="40" maxlength="100" value="<?php echo $Description;?>" />
			</td>
		</tr>			
		<tr>
			<td width="100" align="right" class="key">
				<label for="abb">
					<?php echo JText::_( 'Notes' ); ?>:
				</label>
			</td>
			<td>
				<TEXTAREA  class="text_area" name="notes" id="notes" rows="10" cols="40"><?php echo $this->detail->notes;?> </textarea>
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
<input type="hidden" name="controller" value="assettype_detail" />
</form>


