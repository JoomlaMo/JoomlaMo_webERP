<?php
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.tooltip');
$AssetType	 		=& $this->assettype;
$Locations 			=& $this->locations;
$Keyword 			=& $this->keywords;
$Specifications 	=& $this->specifications;
if(!$this->detail->id == 0){
	$ID 				= $this->detail->id;
	$Description 	= $this->detail->description;
	$Notes			= $this->detail->notes;
}else{
	$ID 				= "New";
	$Description 	= '';
	$Notes			=	'';
}
$post	= JRequest::get('post');
If($mainframe->getUserState("LocationFilter")){
	$LocationFilter = $mainframe->getUserState("LocationFilter");
}	
JHTML::_('behavior.calendar');
// reset form variables on error
If($mainframe->getUserState('formpost') AND $mainframe->getUserState('formpost') <> NULL){
	$ID = $mainframe->getUserState('formpost.id');
	$FormPost =& $mainframe->getUserState('formpost');
	Foreach($FormPost['KeywordInput'] as $KeyWID=>$Value){
		$Specifications[$ID][$KeyWID]	= $Value;
	}
	Foreach($FormPost['ID'] as $FormAssetTypeID=>$FormAssetTypeDescription){
		$AssetType['description'] 		= $FormAssetTypeDescription;
		$AssetType['id']					= $FormPost['asset_type'];
	}
	$this->detail->description 		= $FormPost['description'];
	If(isset($FormPost['LocationFilter'])){
		$LocationFilter			 			= $FormPost['LocationFilter'];
	}
	$this->detail->lastlocation 		= $FormPost['lastlocation'];
	$this->detail->location 			= $FormPost['location'];
	$this->detail->athome 				= $FormPost['athome'];
	$this->detail->dateinservice 		= $FormPost['dateinservice'];
	$this->detail->datecheckedout 	= $FormPost['datecheckedout'];
	$this->detail->dateexpectedback 	= $FormPost['dateexpectedback'];
	$Notes 									= $FormPost['notes'];
}
// get location from existing record if it is an edit, from post if it has been chosen or session if not
If(isset($post["location"]) AND $post["location"] <> 'ALL' AND (!isset($this->detail->location) or $this->detail->location == 0) ){
	$LocationFilter = $post["location"];
}elseif(isset($this->detail->location) AND $this->detail->location <> 0 AND $this->detail->location <> 'ALL'){
	$LocationFilter = $this->detail->location;
}elseif($mainframe->getUserState('LocationFilter')){
	$LocationFilter = $mainframe->getUserState('LocationFilter');
}
?>
<script language="javascript" type="text/javascript">
function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
     
	 if ((pressbutton=='save'))
	 {
	  form.controller.value="inventory_detail";
	 }else{	 	
	  form.controller.value="inventory";
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	
	form.submit();
}
</script>
<div class="div_block"><?php echo EmergencypreparednesseditHelperToolbar::getToolbar();?></div>
<form action="<?php echo JURI::base() . 'index.php?option=com_emergencypreparedness&controller=inventory_detail&view=inventory_detail'?>" method="post" name="adminForm">
 	<input type = "hidden" name = "task" value = "" />
 	<input type = "hidden" name = "option" value = "com_emergencypreparedness" />
		<fieldset class="adminform">
		<legend><?php echo JText::_( 'Distiguishing Details' ); ?></legend>
	<div class="div_heading">
		<h3>
			<label for="id"><?php echo JText::_( 'Id' ); ?>:&nbsp;</label>
			<?php echo $ID . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Asset Type:&nbsp;" . $AssetType['description'] ; ?>
		</h3>
	</div>
	<input type="hidden" name="id" value="<?php echo $this->detail->id; ?>" />
<table>
	<tr>
		<td align="right"><label for="description"><?php echo JText::_( 'Description' ); ?>:&nbsp;</label></td>	
		<td>
			<input class="text_area" type="text" name="description" id="description" size="40" maxlength="100" value="<?php echo $this->detail->description;?>" />
			Color Type Label Decal 
		</td>
	</tr>
</table>
	</fieldset>
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'Specifications' ); ?></legend>	
<?php	
//If this asset type has keywords
If(count($Keyword) > 0){
?>
	<table>
<?php
	foreach($Keyword['KeywordDescription'] as $KeywordID=>$KeywordDescription){
		If(!isset($Specifications[$ID][$KeywordID])){			
			$Specifications[$ID][$KeywordID] = '';
		}
?>	
		<tr>
			<td align="right">
				<label for="KeywordDescription"><?php echo JText::_( $KeywordDescription )?>:&nbsp;</label>
			</td>
			<td>
				<input class="text_area" type="text" name="KeywordInput[<?php echo $KeywordID;?>]" id="KeywordInput<?php echo $KeywordID?>" size="50" maxlength="100" value="<?php echo $Specifications[$ID][$KeywordID];?>" />
			</td>
			<td>
				<?php echo $Keyword['notes'][$KeywordID]?>
			</td>
		</tr>
<?php	
	}
?>
	</table>
<?php	
}else{
?>	
	<div>	
		<h4>No Keywords exist for <?php echo $AssetType['description'];?></h4>
	</div>

<?php
}
?>
	</fieldset>
	
	<fieldset class="adminform">	
	<legend><?php echo JText::_( 'Location Information' ); ?></legend>
	<table>
		<tr>
			<td align="right"><label for="location"><?php echo JText::_( 'Home Location' ); ?>:</td>
			<td>
				<SELECT name="location">
					<OPTION value="">Choose Location</OPTION>
<?php			
		foreach($Locations['description'] as $Code=>$Description){
			If($LocationFilter == $Code OR count($Locations) < 2){
				$Selected = "SELECTED";
			}else{	
				$Selected = "";
			}
			// echo Selected . "=Selected<br>";
?>
					<OPTION value="<?php echo $Code?>" <?php echo $Selected?>><?php echo $Description?></OPTION>
<?php	
		}
?>				
				</SELECT>
			</td>
		</tr>				
		<tr>
			<td align="right"><label for="lastlocation"><?php echo JText::_( 'Last Location' ); ?>:&nbsp;</label></td>
			<td>
				<input class="text_area" type="text" name="lastlocation" id="lastlocation" size="50" maxlength="100" value="<?php echo $this->detail->lastlocation;?>" />
			</td>
		</tr>
		<tr>
			<td align="right"><label for="athome"><?php echo JText::_( 'At Home' ); ?>:&nbsp;</label></td>
			<td>
				<SELECT name="athome">
<?php
			If($this->detail->athome == 'N'){
				$NSelected = "SELECTED";
				$YSelected = "";
			}else{	
				$YSelected = "SELECTED";
				$NSelected = "";
			}
?>			
					<OPTION value="Y" <?php echo $YSelected;?>>Yes</OPTION>
					<OPTION value="N" <?php echo $NSelected;?>>No</OPTION>
				</SELECT>
			</td>
		</tr>
		<tr>
			<td align="right"><label for="dateinservice"><?php echo JText::_( 'Date In Service' ); ?>:&nbsp;</label></td>
			<td><?php echo JHTML::_( 'calendar',$this->detail->dateinservice,"dateinservice","dateinservice"); ?></td>
		</tr>
		<tr>
			<td align="right"><label for="datecheckedout"><?php echo JText::_( 'Date Checked Out' ); ?>:&nbsp;</label></td>	
			<td><?php echo JHTML::_( 'calendar',$this->detail->datecheckedout,"datecheckedout","datecheckedout"); ?></td>
		</tr>
		<tr>
			<td align="right"><label for="dateexpectedback"><?php echo JText::_( 'Date Expected Back' ); ?>:&nbsp;</label></td>
			<td><?php echo JHTML::_( 'calendar',$this->detail->dateexpectedback,"dateexpectedback","dateexpectedback"); ?></td>
		</tr>
		<tr>
			<td align="right"><label for="notes"><?php echo JText::_( 'Notes' ); ?>:&nbsp;</label></td>
			<td><TEXTAREA  class="text_area" name="notes" id="notes"  rows="10" cols="40"><?php echo $Notes;?> </textarea></td>
		</tr>
	</table>
	</fieldset>
<input type="hidden" name="id" value="<?php echo $this->detail->id; ?>" />
<input type="hidden" name="task" value="save" />
<input type="hidden" name="ID[<?php echo $ID?>]" value="<?php echo $AssetType['description']?>" />
<input type="hidden" name="controller" value="inventory_detail" />
<input type="hidden" name="asset_type" value="<?php echo $AssetType['id']?>" />
</fieldset>
</form>


