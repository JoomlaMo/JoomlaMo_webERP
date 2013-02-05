<?php
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.tooltip');
$AssetTypes =& $this->assettypes;
if(!$this->detail->id == 0){
	$ID 				= $this->detail->id;
	$Description 	= $this->detail->description;
	$Notes			=	$this->detail->notes;
}else{
	$ID 				= "New";
	$Description 	= '';
	$Notes			=	'';
}
?>
<style type="text/css">
	table.paramlist td.paramlist_key {
		width: 92px;
		text-align: left;
		height: 30px;
	}
</style>
<form action="index.php?option=com_emergencypreparedness&task=save&controller=keyword_detail" method="post" name="adminForm" id="adminForm">
<div class="col50">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Keywords' ); ?></legend>

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
				<label for="description">
					<?php echo JText::_( 'Description' ); ?>:
				</label>
			</td>
			<td>			
				<input type="text" name="description" size="40" maxlength="100" value="<?php echo $this->detail->description; ?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="assettype">
					<?php echo JText::_( 'Asset Type' ); ?>:
				</label>
			</td>
			<td>
				<SELECT name="asset_type">
<?php			
foreach($AssetTypes as $Code=>$Type){
	If($Code == $this->detail->asset_type){
		$Selected = "SELECTED";
	}else{	
		$Selected = "";
	}
?>
					<OPTION value="<?php echo $Code?>" <?php echo $Selected?>><?php echo $Type?></OPTION>
<?php	
}
?>				
				</SELECT>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="typeofdata">
					<?php echo JText::_( 'Type of Data' ); ?>:
				</label>
			</td>
			<td>
				<SELECT name="typeofdata">
					<OPTION value="Alpha" <?php echo $Selected?>>Alpha-Numerical</OPTION>
					<OPTION value="Numerical" <?php echo $Selected?>>Numerical</OPTION>
				</SELECT>
			</td>
		</tr>	
		
		<tr>
			<td width="100" align="right" class="key">
				<label for="notes">
					<?php echo JText::_( 'Notes' ); ?>:
				</label>
			</td>
			<td>
				<TEXTAREA  class="text_area" name="notes" id="notes"  rows="10" cols="40"><?php echo $Notes;?> </textarea>
				Put possible choices here to be able to copy an paste.
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<input type="hidden" name="cid[]" value="<?php echo $this->detail->id; ?>" />
<input type="hidden" name="task" value="save" />
<input type="hidden" name="controller" value="keyword_detail" />
</form>


