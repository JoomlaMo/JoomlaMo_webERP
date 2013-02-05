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
global $mainframe;
jimport('joomla.application.component.view');
jimport('joomla.application.component.helper');
require_once( JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'edittoolbar.php' );
$iconPath = JURI::base()."components".DS."com_teams".DS. "icon.css";
$doc =& JFactory::getDocument();
$doc->addStyleSheet($iconPath);
$mainframe->addCustomHeadTag ('<script type="text/javascript" src="/includes/js/joomla.javascript.js"></script>');
class teamsViewleague extends JView
{
    function display($tpl = null)
    {
        //-- Custom css
        JHTML::stylesheet( 'team.css', 'administrator/components/com_team/assets/' );
		  $bar = new JToolBar( 'Associations Toolbar' );
		  $document = & JFactory::getDocument();
		  $document->setTitle( JText::_('league') );
        //-- Get data from the model
        $item =& $this->get('Data');
        $isNew = ($item['LeagueID'] < 1);
        $text = $isNew ? JText::_('New') : JText::_('Edit');

        $this->assignRef('item', $item);

        parent::display($tpl);
    }//function

}//class
