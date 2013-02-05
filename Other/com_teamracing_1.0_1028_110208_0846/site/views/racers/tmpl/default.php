<?php
/**
 * @version SVN: $Id$
 * @package    teamrace
 * @subpackage Views
 * @author     Mo Kelly {@link http://www.joomlamo.com Integration King!}
 * @author     Mo Kelly {@link http://joomlamo.com}
 * @author     Created on 04-Aug-10
 * @license    GNU/GPL
 * This program is free software: you can redistribute it and/or modify    
 *  it under the terms of the GNU General Public License as published by
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

//-- No direct access
defined('_JEXEC') or die('=;)');

JHTML::_('behavior.tooltip');
$TeamNames = $this->teams;
$UniformDescriptions = $this->uniforms;
?>
<script language="javascript" type="text/javascript">
function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
     
	 if (pressbutton=='new')
	 {
	  form.controller.value="game";
	 }
	 if(pressbutton=='delete')
	 {
	  form.controller.value="game";
	 }
	 if(pressbutton=='edit')
	 {	
	  form.controller.value="game";	
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	
	form.submit();
}
</script>
<div><h1><?php echo JText::_('Race Results'); ?></h1></div>
<form action="index.php" method="post" name="adminForm">
<?php
$this->search		= $mainframe->getUserStateFromRequest( "$option.search", 'search', '', 'string' );
If(count($this->items)>5 OR $this->search){
?>
    <table>
        <tr>
            <td align="left" width="100%">
                <?php echo JText::_('Opponent Filter'); ?>:
                <input type="hidden" name="searchsource" value="racer">
                <input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
                <button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
                <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_item').value='';this.form.submit();"><?php echo JText::_('Reset'); ?></button>
            </td>
            <td nowrap="nowrap">
                <?php #echo $this->lists['type']; ?>
            </td>
        </tr>
    </table>
<?php
}
?>    
    <div id="tablecell">
        <table class="adminlist" width="100%" cellpadding="4" cellspacing="4">
            <thead>
                <tr>
                    <?php $coloumnCount = 2; ?>
<?php
If(count($this->items)>5){
?>     
    <th>
        <?php echo JHTML::_('grid.sort', 'Pigeon', 'Pigeon', $this->lists['order_Dir'], $this->lists['order']);?>
    </th>
    <th>
        <?php echo JHTML::_('grid.sort', 'Time', 'Time', $this->lists['order_Dir'], $this->lists['order']);?>
    </th>
    <th>
        <?php echo JHTML::_('grid.sort', 'Speed', 'Speed', $this->lists['order_Dir'], $this->lists['order']);?>
    </th>
    <th>
        <?php echo JHTML::_('grid.sort', 'Release', 'Release', $this->lists['order_Dir'], $this->lists['order']);?>
    </th>
    </th>
        <?php echo JHTML::_('grid.sort', 'Tag ID', 'Tag ID', $this->lists['order_Dir'], $this->lists['order']);?>
    </th>
    <th>
        <?php echo JHTML::_('grid.sort', 'Association', 'Association', $this->lists['order_Dir'], $this->lists['order']);?>
    </th> 
    <th>
        <?php echo JHTML::_('grid.sort', 'Breeder', 'Breeder', $this->lists['order_Dir'], $this->lists['order']);?>
    </th>
    <th>
        <?php echo JHTML::_('grid.sort', 'Loft', 'Loft', $this->lists['order_Dir'], $this->lists['order']);?>
    </th>
    <th>
        <?php echo JHTML::_('grid.sort', 'Color', 'Color', $this->lists['order_Dir'], $this->lists['order']);?>
    </th>
    <th>
        <?php echo JHTML::_('grid.sort', 'Sex', 'Sex', $this->lists['order_Dir'], $this->lists['order']);?>
    </th>

<?php
}else {
?>      
    <th>
        <?php echo JText::_('Place');?>
    </th>
    <th>
        <?php echo JText::_('Pigeon ID');?>
    </th>
    <th>
        <?php echo JText::_('Time');?>
    </th>
    <th>
        <?php echo JText::_('Speed');?>
    </th>
    <th>
        <?php echo JText::_('Tag ID');?>
    </th>
    <th>
        <?php echo JText::_('Breeder');?>
    </th>
    <th>
        <?php echo JText::_('Loft');?>
    </th>
    <th>
        <?php echo JText::_('Color');?>
    </th>
    <th>
        <?php echo JText::_('Sex');?>
    </th>
    <?php
}
?>        

    <?php $coloumnCount += 14; ?>

                </tr>
            </thead>

            <tbody>
            <?php
            $k = 0;
            for ($i=0, $n=count( $this->items ); $i < $n; $i++)
            {
                $row = &$this->items[$i];

            ?>
                <tr class="<?php echo "row$k"; ?>">
                	<td>
					        <?php echo $i+1; ?>
					    </td>
                	<td>
					        <?php echo $row['PlayerID']; ?>
					    </td>
					    <td>
					        <?php echo date('g:i:s a',strtotime($row['Time'])); ?>
					    </td>
					    <td>
					        <?php echo $row['Speed']; ?>
					    </td>
					    <td>
					        <?php echo $row['TagID']; ?>
					    </td>

					    <td>
					        <?php echo  $row['TeamName']; ?>
					    </td>
					    <td>
					        <?php echo  $row['LoftName']; ?>
					    </td>
					    <td>
					        <?php echo $row['Color']; ?>
					    </td>
					    <td>
					        <?php echo $row['Sex']; ?>
					    </td>
                </tr>
                <?php
                    $k = 1 - $k;
                }
                ?>
            </tbody>
<?php
If(count($this->items)>5){
?>            
            <tfoot>
                <tr>
                  <td colspan="<?php echo $coloumnCount + 1; ?>"><?php echo $this->pagination->getListFooter(); ?></td>
                </tr>
            </tfoot>
<?php
}
?>            
        </table>
    </div>
    <input type="hidden" name="option" value="com_teamrace" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
<?php
If(count($this->items)>0){
?>    
    <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<?php
}
?>    
    <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
    <input type="hidden" name="controller" value="racer" />
    <input type="hidden" name="view" value="racers" />
    <?php echo JHTML::_( 'form.token' ); ?>
</form>
