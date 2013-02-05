<?php
/**
* @package UserStatus
* @version 1.5
* @copyright Copyright (C) 2010 Mo Kelly. All rights reserved.
   
*	This program is free software: you can redistribute it and/or modify    
*	it under the terms of the GNU General Public License as published by
*  the Free Software Foundation, either version 3 of the License, or
*  (at your option) any later version.*
*
*  This program is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.*

*  You should have received a copy of the GNU General Public License
*  along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/ 
defined('_JEXEC') or die('Restricted access'); 
JHTML::_('behavior.tooltip');
If(count($this->users) > 40){
	$columns = 3;
	$Width = 'width="25%"';
}elseif(count($this->users) > 20){
	$columns = 2;
	$Width = 'width="33%"';
}else{
	$Width = 'width="50%"';
	$columns = 1;
}
$LocationDescriptions =& $this->locationdescriptions;
$post	= JRequest::get('post');
If($post['task'] == 'edit'){
	$UserStatusLocation =& $this->userstatuslocation;
	$UserStatusID = $post['cid'][0];
}
$UserStatusLocation =& $this->userstatuslocation;
?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		submitform( pressbutton );
	}
</script>
<Fieldset>
<legend>Choose User, Status and Location </legend>
<DIV>
	<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm" >
		<TABLE>	
			<div>
				<TR>
					<TD valign="top">
						<DIV  style="overflow: auto; height: 480px;">		
							<fieldset>
								<legend>Choose User</legend>
								<TABLE>
<?php	

$j = 1;

$t = round(count($this->users)/$columns+.4999);
for ($i=0, $n=count( $this->users ); $i < $n; $i++){
	$row = &$this->users[$i];
	$post	= JRequest::get('post');
	If($post['task'] == 'edit'){
		$Checked = 'CHECKED';
	}else{
		$Checked = '';
	}
?>
									<TR>
										<TD nowrap>
											<INPUT type="Radio" name="User" <?php echo $Checked  ?> value="<?php echo $row->id?>" ><?php echo $row->username?>
										</TD>
										<TD nowrap><?php echo $row->name?></TD>
									</TR>	
<?php
	if($j == $t+1){
		$j=0;
?>		
								</table>
							</fieldset>
					</td>
					<TD valign="top">	
							<fieldset>
								<legend>Choose User</legend>
								<table>
<?php
	}
	$j=$j+1;
}
$Check[1]='';
$Check[2]='';
$Check[0]='';
If($post['task'] == 'edit'){
	$Check[$UserStatusLocation['status']] = 'SELECTED';
}
?>                   
								</table>   
							</fieldset>
					</TD>
					<TD valign="top">		
							<fieldset>
								<legend>Choose Status</legend>
								<TABLE valign="top">
									<tr>
										<TD valign="top">
											<select name="Status">
												<option value="2" <?php echo $Check[2]  ?>>Stand By</option>
												<option value="1" <?php echo $Check[1]  ?>>Activated</option>	
												<option value="0" <?php echo $Check[0]  ?>>Closed</option>
											</select>
										</TD>
									</tr>
								
								</TABLE>
							</fieldset>	
					</td>
					<td valign="top">					
							<fieldset>
								<legend>Choose Location</legend>
								<TABLE valign="top">
									<TR>

										<TD>
											<table cellpadding="2">
												<tr>
													<td>
														Description
													</td>
													<td>
														Address
													</td>
													<td>
														City
													</td>
													<td>
														State
													</td>
													<td>
														Zip
													</td>
													<td>
														County
													</td>
												</tr>
<?php
// var_dump($row);echo "<br><br>row<BR><BR><BR>";
// var_dump($UserStatusLocation);echo "<br><br>UserStatusLocation<BR><BR><BR>";
If(isset($LocationDescriptions)){
	foreach($LocationDescriptions as $index=>$row){
		If($post['task'] == 'edit' AND $row['id'] == $UserStatusLocation['location']){
			$Checked = 'CHECKED';
		}else{
			$Checked = '';
		}
?>
												<tr>
													<td>
														<input type=radio name="Location" <?php echo $Checked; ?> value="<?php echo $row['id'];?>">
														<?php echo $row['description'];?><br>
													</td>
													<td>
														<?php echo $row['address']  ?>
													</td>
													<td>
														<?php echo $row['city']  ?>
													</td>
													<td>
														<?php echo $row['state']  ?>
													</td>
													<td>
														<?php echo $row['zip']  ?>
													</td>
													<td>
														<?php echo $row['county']  ?>
													</td>
												</tr>
<?php		
	}				
}
?>					
											</table>
										</TD>
									</tr>	
								</table>
							</fieldset>
						</div>
					</td>
				</TR> 
			</div>        
		</TABLE>
<?php
If($post['task'] == 'edit'){
?>
		<input type="hidden" name="id" value="<?php echo $UserStatusID  ?>" /><?php echo $UserStatusID  ?>=userstatusid line182
<?php
}
?>		
		<input type="hidden" name="controller" value="userstatus_detail" />
		<input type="hidden" name="view" value="userstatus_detail" />
		<input type="hidden" name="task" value="save" />
	</form>

</DIV>
</fieldset>
<?php
$app    =& JFactory::getApplication();
$router =& $app->getRouter();
$router->setVar( 'controller', 'userstatus_detail' );
$router->setVar( 'view', 'userstatus_detail' );
$router->setVar( 'task', 'save' );
function var_dump_pre($mixed = null) {
  		echo '<pre>';
  		var_dump($mixed);
  		echo '</pre>';
  		return null;
	}
?>