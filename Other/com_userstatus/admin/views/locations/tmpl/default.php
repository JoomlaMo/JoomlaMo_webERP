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
defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::_('behavior.tooltip');
?>

<script language="javascript" type="text/javascript">
/**
* Submit the admin form
* 
* small hack: let task decides where it comes
*/
function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
    
	if ((pressbutton=='add')||(pressbutton=='edit')||(pressbutton=='remove'))
	 {
	  form.controller.value="locations_detail";
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
			<td align="left" colspan="3">Use a portion of the location name to 
				<?php echo JText::_( 'Filter' ); ?>:
				<input type="text" name="search" id="search" class="text_area" onchange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
				To clear the filter, leave blank and click go.						
			</td>
		</tr>
		<tr>
			<th class="title" width="5%">
				<?php echo JText::_( 'NUM' ); ?>
			</th>
			<th class="title" width="5%">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>
			<th class="title" width="5%">
				<?php echo JText::_( 'ID' ); ?>
			</th>
			<th class="title">
				<?php echo JText::_( 'Location' ); ?>
			</th>	
			<th class="title">
				<?php echo JText::_( 'Address' ); ?>
			</th>	
			<th class="title">
				<?php echo JText::_( 'City' ); ?>
			</th>		
			<th class="title">
				<?php echo JText::_( 'County' ); ?>
			</th>	
			<th class="title">
				<?php echo JText::_( 'State' ); ?>
			</th>	
			<th class="title">
				<?php echo JText::_( 'Zip' ); ?>
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

		$link 	= JRoute::_( 'index.php?option=com_userstatus&controller=locations_detail&task=edit&cid[]='. $row->id );

?>
		<tr class="<?php echo "row$k"; ?>">
			<td align="center">				
				<?php echo $this->pagination->getRowOffset( $i ); ?>
			</td>	
			<td align="center">
				<?php echo $checked; ?>
			</td>
			<td align="center">
				<a href="<?php echo $link; ?>" >
					<?php echo $row->id; ?>
				</a>
			</td>
			<td>
				<?php echo $row->description; ?></a>
			</td>	
			<td>
				<?php echo $row->address; ?></a>
			</td>		
			<td>
				<?php echo $row->city; ?></a>
			</td>		
			<td>
				<?php echo $row->county; ?></a>
			</td>	
			<td>
				<?php echo $row->state; ?></a>
			</td>			
			<td>
				<?php echo $row->zip; ?></a>
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

<input type="hidden" name="controller" value="locations" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>
