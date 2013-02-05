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
$UserNames =& $this->usernames;
$LocationDescriptions =& $this->locationdescriptions;
?>

<script language="javascript" type="text/javascript">
/**
* Submit the admin form
* 
* small hack: let task desides where it comes
*/
function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
     
	 if ((pressbutton=='add'||(pressbutton=='edit')))
	 {
	  	form.controller.value="userstatus_detail";
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	if(pressbutton=='remove')
	{
		form.task.value="delete";
	  	form.controller.value="userstatus";
	}
	form.submit();
}


</script>

<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm" >
<div id="editcell">
	<table class="adminlist"><th></th>
	<thead>
			<th width="10%" align="center">
				<?php echo JText::_( 'NUM' ); ?>
			</th>
			<th width="10%" align="center">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->userstatus ); ?>);" />
			</th>
			<th width="10%" align="center" nowrap="nowrap">
				ID
		 	</th>		 
			<th width="20%" nowrap="nowrap" align='center'>
				User
			</th>
			<th width="10%" align='center' class="title">
				Status
			</th>
			<th width="40%" class="title">
				Location
			</th>
	</thead>	
	<?php
	$k = 0;
		for ($i=0, $n=count($this->userstatus); $i < $n; $i++)
		{
			$row = &$this->userstatus[$i];
			$ID 					= $row->id;
			$checked 			= JHTML::_('grid.checkedout',   $row, $i );
			If($row->status == 1){
				$Status = "<span style='color:green'>Activated</span>";
			}elseif($row->status == 2){
				$Status = "<span style='color:orange'>Stand By</span>";
			}elseif($row->status == 0){
				$Status = "<span style='color:red'>Closed</span>";
			}	
			If(isset($LocationDescriptions[$row->location])){
				$Location = $LocationDescriptions[$row->location];
			}else{
				$Location = '';
			}
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td width='10%' align='center'>
					<?php echo $this->pagination->getRowOffset( $i ); ?>
				</td>
				<td width='10%' align='center'>
					<?php echo $checked; ?>
				</td>
				<td width='10%' align='center'>
					<?php echo $row->id; ?>
				</td>
				<td width='20%'>
					<?php echo $UserNames['name'][$row->user]?>
				</td>
				<td width='10%' align='center'>
					<?php echo $Status; ?>
				</td>	
				<td width='40%'>
					<?php echo $Location  ?>
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
<input type="hidden" name="controller" value="userstatus" />
<input type="hidden" name="task" value="delete" />
<input type="hidden" name="boxchecked" value="0" />
</form>
