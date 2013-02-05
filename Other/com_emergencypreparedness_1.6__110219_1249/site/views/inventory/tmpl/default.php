<?php 
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.tooltip');
$AssetType			 		= $this->assettypes;
$InventoryLocations 	= $this->locations;
$Keywords					= $this->keywords;
$Specification			= $this->specifications;
$post	= JRequest::get('post');
If(isset($post["LocationFilter"])){
	$LocationFilter = $post["LocationFilter"];
	$mainframe->setUserState('LocationFilter',$post["LocationFilter"]);
}elseif($mainframe->getUserState('LocationFilter')){
	$LocationFilter = $mainframe->getUserState('LocationFilter');
}
?>
<script language="javascript" type="text/javascript">
function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
     
	 if (pressbutton=='new')
	 {
	  form.controller.value="selectassettype";
	 }
	 if(pressbutton=='delete')
	 {
	  form.controller.value="inventory";
	 }
	 if(pressbutton=='edit')
	 {	
	  form.controller.value="inventory_detail";	
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	
	form.submit();
}
</script>
<div class="div_block"><?php echo EmergencypreparednessHelperToolbar::getToolbar();?></div><br><br>
<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm" >
<DIV>
Location Filter:
	<SELECT name="LocationFilter" onchange="document.adminForm.submitform('adminForm')">
	<OPTION value="ALL">All</OPTION>
<?php
Foreach($InventoryLocations["description"] as $id=>$location){
	If($mainframe->getUserState('LocationFilter') == $id){
		$Selected = "SELECTED";
	}else{
		$Selected = "";
	}
?>	
		<OPTION value="<?php echo $id?>" <?php echo $Selected;?>><?php echo $location?></OPTION>
<?php
}
?>		
	</SELECT>	
	<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
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
				Asset
		 	</th>		 
			<th width="25%" nowrap="nowrap">
				Description
			</th>	 
			<th width="25%" nowrap="nowrap">
				Location
			</th>
			<th width="10%"  class="title">
				Notes
			</th>
		</tr>
	</thead>	
	<?php
	// echo count( $this->items ) . "=item count<BR>";
	If(count( $this->items )==0){
?>
		<tr><td colspan="6" style="color:red;font-weight:bold;">No Inventory assigned to this location</td></tr>	
<?php 		
	}
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++){
		$row = &$this->items[$i];
		$id		 						= $row->id;
		$InventoryDescription 		= $row->description;
		$InventoryAssetType			= $row->asset_type;
		$InventoryLocation 			= $row->location;
		$InventoryLastLocation 		= $row->lastlocation;
		$InventoryAtHome 				= $row->athome;
		$InventoryDateCheckedOut 	= $row->datecheckedout;
		$InventoryDateExpectedBack	= $row->dateexpectedback;
		$InventoryNotes		 		= $row->notes;
		If($InventoryAtHome == 'Y' AND isset($InventoryLocations["description"][$InventoryLocation])){
			$Location = $InventoryLocations["description"][$InventoryLocation];
		}elseif(isset($InventoryLastLocation) OR isset($InventoryDateExpectedBack)){
			$Location = $InventoryLastLocation . "<br> Est return " . $InventoryDateExpectedBack ;
		}else{
			$Location = 'No Location Found';
		}
		If(gettype($row) == 'object'){
			$checked 		= JHTML::_('grid.checkedout',$row, $i );
			$published 		= JHTML::_('grid.published', $row, $i );
		}else{
			$checked 		= '';
			$published 		= '';
		}
?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $this->pagination->getRowOffset( $i ); ?>
			</td>
			<td>
<?php
		If(isset($checked)){
?>			
				<?php echo $checked; ?>
<?php
		}
?>				
			</td>

			<td>
<?php
		If(isset($Asset_Types['description'][$InventoryAssetType])){
?>				
				<?php echo $AssetType['description'][$InventoryAssetType]; ?>
<?php
		}else{
?>				
				No Asset Types Entered
<?php
		}
?>	
			</td>
			<td>
				<?php echo $InventoryDescription; ?>
			</td>
			<td>
				<?php echo $Location; ?>
			</td>
			<td>
				<?php echo $InventoryNotes; ?>
			</td>			
		</tr>
<?php
		$k = 1 - $k;
	}
	function var_dump_pre($mixed = null) {
  		echo '<pre>';
  		var_dump($mixed);
  		echo '</pre>';
  		return null;
	}
?>
<tfoot>
		<td colspan="9">
			<?php echo $this->pagination->getListFooter(); ?>
		</td>
	</tfoot>
	</table>
</div>

<input type="hidden" name="cid[]" value="<?php echo $id; ?>" />
<input type="hidden" name="controller" value="inventory" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>
