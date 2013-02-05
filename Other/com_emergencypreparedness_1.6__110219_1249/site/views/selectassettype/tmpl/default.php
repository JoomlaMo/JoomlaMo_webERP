<?php 
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.tooltip');
$post	= JRequest::get('post');
?>
<script language="javascript" type="text/javascript">
function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
     
 	if ((pressbutton=='cancel'))
	 {
	  form.controller.value="inventory";
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	
	form.submit();
}
</script>
<form action = "<?php echo $this->request_url; ?>" method = "post" id = "adminForm"/> 
<div align="center">	
	<fieldset>
		<legend>Choose Asset Type</legend>
<?php	
If(count( $this->items )==0){
	echo "<span style='color:red;font-weight:bold;'>Please enter asset types first</span>";
}else{	
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{		
		$row 					= &$this->items[$i];
		$Length[$i]			= strlen($row->description);
		$AssetType[$i]		= $row->description;
		$AssetTypeID[$i]	= $row->id;
	}
	$CharacterWidth		= 7.5;
	$k 						= 0;		
	$ColumnTotal 			= (integer)(800/(max($Length)*$CharacterWidth)-.5);
	$ButtonWidth			= (max($Length)*$CharacterWidth);
	$lines					=	round(( count($this->items) / $ColumnTotal) + .5);
	If(isset($post["LocationFilter"])){
		$_SESSION['LocationFilter'] = $post["LocationFilter"];
	}
	?>
		<Table>
	<?php
	for ($i=0; $i < $lines; $i++)
	{	
	?>
			<tr>	
	<?php  
		for($j=0;$j<$ColumnTotal;$j++){
	?>
				<td>			
	<?php
			If(isset($AssetType[$i+($j*$lines)])){
	?>
					<input type="submit" name="ID[<?php echo $AssetTypeID[$i+($j*$lines)];?>]" value="<?php echo $AssetType[$i+($j*$lines)] ?>" style="width:<?php echo $ButtonWidth ?>px"/>				
	<?php
			}else{
	?>		
				&nbsp;
				</td>
	<?php		
			}		
		}	
	?>
			</tr>
	<?php	
	}
	?>		
		</table>
	</fieldset>
</div>
<?php
}
?>
<div>
	<table>
		<tr>
			<td>
				<fieldset class="adminform">
					<legend><?php echo JText::_( 'New Asset type' ); ?></legend>
					<table class="admintable">				
						<tr>
							<td align="right" class="key">
								<label for="model">
									<?php echo JText::_( 'Asset Type' ); ?>:
								</label>
							</td>
							<td>
								<input class="text_area" type="text" name="assetdescription" id="assetdescription" size="25" maxlength="100"/>
							</td>
						</tr>			
						<tr>
							<td align="right" class="key">
								<label for="abb">
									<?php echo JText::_( 'Notes' ); ?>:
								</label>
							</td>
							<td>
								<TEXTAREA  class="text_area" name="notes" id="notes" rows="12" cols="25"></textarea>
							</td>
						</tr>	
					</table>
				</fieldset>
			</td>
			<td>
				<fieldset class="adminform">	
					<legend><?php echo JText::_( 'New Keywords' ); ?></legend>
					<table>
<?php 
	for ($i = 1; $i <= 4; $i++) {
?>		
						<tr align="left" valign="top">
							<td><?php echo JText::_( 'New Keyword #' . $i )?></td>
							<td>Possible choices.</td>
							<td>Numeric</td>
						</tr>
						<tr align="left" valign="top">
							<td><input class="text_area" type="text" name="NewKeyword[<?php echo $i;?>]" id="NewKeyword[<?php echo $i;?>]" size="20" maxlength="100" /></td>
							<td><TEXTAREA  class="text_area" name="newnotes[<?php echo $i ; ?>]" id="newnotes[<?php echo $i ; ?>]"  rows="2" cols="20"> </textarea></td>
							<td><input type="checkbox" name="typeofdata[<?php echo $i ; ?>]"></td>
						</tr>
<?php	 
	}	
?>	
					</table>
				</fieldset>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="hidden" name="controller" value="inventory_detail" />
				<center><input type="submit" name="addtype" value="Add Asset AND Keywords" /> To add these keywords to an asset type click the type button above</center>			
			</td>		
		</tr>	
	</table>
</form>
</div>

