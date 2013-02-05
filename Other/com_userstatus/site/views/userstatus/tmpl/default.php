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
$UserStatus=& $this->userstatus;
$db = &JFactory::getDBO();
		$this->_table_prefix = '#__';
		$db->setQuery( "SELECT params FROM " . $this->_table_prefix . "modules 
		                        WHERE module = 'mod_refreshpage'" );	 
$RefreshPageParameters = $db->loadResult();
$refresh_seconds= substr($RefreshPageParameters,strpos($RefreshPageParameters,"efresh_interval_seconds=")+24);
?>
<meta http-equiv="refresh" content="<?php echo $refresh_seconds;?>">

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
     
	 if ((pressbutton=='add'))
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
	<table class="adminlist" cellspacing="5" cellpadding="5"><th></th>
	<thead>				 
			<th align='center' class="title">
				County
			</th>
			<th align='center' class="title">
				City
			</th>
			<th align='center' class="title">
				Location
			</th>
			<th nowrap="nowrap" align='center'>
				User
			</th>
			<th align='center' class="title">
				Status
			</th>
	</thead>	
<?php
$PicturePath = "components" . DS . "com_userstatus" . DS . "images" . DS;
$k = 0;
for ($i=0, $n=count($this->locationdescriptions); $i < $n; $i++){
	$row = &$this->locationdescriptions[$i];
	$Location	= $row->id;
	If(isset($UserStatus[$Location])){
		Foreach($UserStatus[$Location] as $ID=>$ActiveStatus){
			If($ActiveStatus == 1){
				$Status = "Activated";
				$Picture = $PicturePath . "green.png";
			}elseif($ActiveStatus == 2){
				$Status = "Stand By";
				$Picture = $PicturePath . "yellow.png";
			}elseif($ActiveStatus == 0){
				$Status = "Closed";
				$Picture = $PicturePath . "red.png";
			}
?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
					<?php echo $row->county?>
				</td>
				<td>
					<?php echo $row->city?>
				</td>	
				<td align='center'>
					<?php echo $row->description; ?>
				</td>								
				<td>
					<?php echo $UserNames['name'][$ID]?>
				</td>
				<td align='center'>
					<?php echo $Status; ?>
				</td>	
				<td align='left'>
					<img src="<?php echo $Picture;?>" border="0" name="Ball" alt="Ball">
				</td>		
			</tr>
<?php
			$k = 1 - $k;
		}
	}
}
?>
<tfoot>
		<td colspan="9">
			<?php echo $this->pagination->getListFooter(); ?>
		</td>
	</tfoot>
	</table>
</div>

<input type="hidden" name="id" value="$id" />
<input type="hidden" name="controller" value="userstatus" />
<input type="hidden" name="task" value="delete" />
<input type="hidden" name="boxchecked" value="0" />
</form>
