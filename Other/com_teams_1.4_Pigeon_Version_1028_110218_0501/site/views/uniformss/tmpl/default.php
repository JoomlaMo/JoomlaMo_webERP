<?php
/**
 * @version SVN: $Id$
 * @package    team
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
$TeamNames = $this->teams;

JHTML::_('behavior.tooltip');
?>
<script language="javascript" type="text/javascript">
function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
     
	 if (pressbutton=='new')
	 {
	  form.controller.value="uniform";
	 }
	 if(pressbutton=='delete')
	 {
	  form.controller.value="uniform";
	 }
	 if(pressbutton=='edit')
	 {	
	  form.controller.value="uniform";	
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	
	form.submit();
}
</script>
<div style="float:left"><h1><?php echo JText::_('UNIFORMS'); ?></h1></div>
<div class="div_block" style="float:right"><?php echo teamsHelperToolbar::getToolbar();?></div><br clear="all">
<form action="index.php" method="post" name="adminForm">
<?php
$this->search		= $mainframe->getUserStateFromRequest( "$option.search", 'search', '', 'string' );
If(count($this->items)>5 OR $this->search){
?>    
    <table>
        <tr>
            <td align="left" width="100%">
                <?php echo JText::_('DESCRIPTION_FILTER'); ?>:
                <input type="hidden" name="searchsource" value="uniforms">
                <input type="text" name="search" id="search" value="<?php echo $this->search;?>" class="text_area" onchange="document.adminForm.submit();" />
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
        <table class="adminlist">
            <thead>
                <tr>
                    <th width="5">
                        <?php echo JText::_('NUM'); ?>
                    </th>
                    <th width="5%">
                        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
                    </th>
                    <?php $coloumnCount = 2; ?>
                       <!--  <th>
        <?php echo JHTML::_('grid.sort', 'UniformID', 'UniformID', $this->lists['order_Dir'], $this->lists['order']);?>
    </th> -->
<?php
If(count($this->items)>5){
?>    
    <th>
        <?php echo JHTML::_('grid.sort', 'UNIFORM_DESCRIPTION', 'UNIFORM_DESCRIPTION', $this->lists['order_Dir'], $this->lists['order']);?>
    </th>
    <th>
        <?php echo JText::_('TEAM');?>
    </th>
<?php
}else{
?>    
    <th>
        <?php echo  JText::_('UNIFORM_DESCRIPTION');?>
    </th>
    <th>
        <?php echo  JText::_('TEAM');?>
    </th>
<?php
}
?>    
   <!--  <th>
        <?php echo JHTML::_('grid.sort', 'userid', 'userid', $this->lists['order_Dir'], $this->lists['order']);?>
    </th> -->
    <?php $coloumnCount += 4; ?>

                </tr>
            </thead>

            <tbody>
            <?php
            $k = 0;
            for ($i=0, $n=count( $this->items ); $i < $n; $i++)
            {
                $row = &$this->items[$i];
                $link = JRoute::_('index.php?option=com_teams&controller=uniform&task=edit&cid[]='. $row->UniformID);

                $checked = JHTML::_('grid.id',  $i, $row->UniformID );
            ?>
                <tr class="<?php echo "row$k"; ?>">
                    <td width="5%">
                        <span class="editlinktip hasTip" title="<?php echo JText::_('Edit'); ?>">
                            <a href="<?php echo $link; ?>">
                                <?php echo $this->pagination->getRowOffset($i); ?>
                            </a>
                        </span>
                    </td>
                    <td width="5%">
                        <?php echo $checked; ?>
                    </td>
                        <!-- <td>
        <?php echo $row->UniformID; ?>
    </td> -->
    <td>
        <?php echo $row->UniformDescription; ?>
    </td>
    <td>
<?php
If(isset($TeamNames[$row->TeamID]['TeamName'])){
?>    
        <?php echo $TeamNames[$row->TeamID]['TeamName']; ?>
<?php
}else{
			echo "Any Team";
}
?>        &nbsp;
    </td>
    <!-- <td>
        <?php echo $row->userid; ?>
    </td> -->

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
    <input type="hidden" name="option" value="com_teams" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
    <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
    <input type="hidden" name="controller" value="uniforms" />
    <input type="hidden" name="view" value="uniformss" />
    <?php echo JHTML::_( 'form.token' ); ?>
</form>
