<?php

defined('_JEXEC') or die('=;)');

JHTML::_('behavior.tooltip');
For($i=0;$i<10;$i++){
	$Years[$i] = $i;
}
For($i=0;$i<13;$i++){
	$Months[$i] = $i;
}
For($i=0;$i<32;$i++){
	$Days[$i] = $i;
}
For($i=0;$i<25;$i++){
	$Hours[$i] = $i;
}
For($i=0;$i<61;$i++){
	$Minutes[$i] = $i;
	$Seconds[$i] = $i;
}
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'Details' ); ?></legend>
	<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="Process">
					<?php echo JText::_( 'Description' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<input class="text_area" type="text" name="Description" id="Description" size="32" maxlength="250" value="<?php echo $this->item->Description ;?>" />
			</td>
		</tr>
		<tr>
			<td valign="top" align="right" class="key">
				<?php echo JText::_( 'Estimated Time' ); ?>:
			</td>
			<td colspan="2"> Years
				<select name="Years">
<?php
while(list($key, $val)=each($Years)) {
	if (isset($Years) && ($Years == $val)) {
		echo '<option value="'.$key.'" selected>'.$val.'</option>';
	} else {
		echo '<option value="'.$key.'">'.$val.'</option>';
	}
}
?>
				</select> Months
				<select name="Months">
<?php
while(list($key, $val)=each($Months)) {
	if (isset($Months) && ($Months == $val)) {
		echo '<option value="'.$key.'" selected>'.$val.'</option>';
	} else {
		echo '<option value="'.$key.'">'.$val.'</option>';
	}
}
?>
				</select> Days
				<select name="Days">
<?php
while(list($key, $val)=each($Days)) {
	if (isset($Days) && ($Days == $val)) {
		echo '<option value="'.$key.'" selected>'.$val.'</option>';
	} else {
		echo '<option value="'.$key.'">'.$val.'</option>';
	}
}
?>
				</select> Hours
				<select name="Hours">
<?php
while(list($key, $val)=each($Hours)) {
	if (isset($Hours) && ($Hours == $val)) {
		echo '<option value="'.$key.'" selected>'.$val.'</option>';
	} else {
		echo '<option value="'.$key.'">'.$val.'</option>';
	}
}
?>
				</select> Minutes
				<select name="Minutes">
<?php
while(list($key, $val)=each($Minutes)) {
	if (isset($Minutes) && ($Minutes == $val)) {
		echo '<option value="'.$key.'" selected>'.$val.'</option>';
	} else {
		echo '<option value="'.$key.'">'.$val.'</option>';
	}
}
?>
				</select> Seconds
				<select name="Seconds">
<?php
while(list($key, $val)=each($Seconds)) {
	if (isset($Seconds) && ($Seconds == $val)) {
		echo '<option value="'.$key.'" selected>'.$val.'</option>';
	} else {
		echo '<option value="'.$key.'">'.$val.'</option>';
	}
}
?>
				</select>
				<?php echo $this->lists['EstimatedTime']; ?>
			</td>
		</tr>
	</table>
	</fieldset>
		
		<fieldset class="adminform">
		<legend><?php echo JText::_( 'Instruction' ); ?></legend>
		<table class="admintable">
			<tr>
			<td valign="top" colspan="3">
			<?php
				echo $this->editor->display( 'Instruction', $this->item->Instruction, '550', '300', '60', '20', array('pagebreak', 'readmore') ) ;
			?>
			</td>
			</tr>					
		</table>
	</fieldset>

	<input type="hidden" name="cid[]" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="option" value="com_Action" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="controller" value="process" />
</form>
