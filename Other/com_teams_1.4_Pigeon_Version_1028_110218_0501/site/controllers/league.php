<?php
/**
 * @version SVN: $Id$
 * @package    team
 * @subpackage Controllers
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
// echo "stop23contorllerleague<br>";exit;
//-- No direct access
defined('_JEXEC') or die('=;)');
jimport('joomla.application.component.controller');

/**
 * team Controller
 *
 * @package    team
 * @subpackage Controllers
 */
class teamsControllerleague extends teamsController
{
    /**
     * constructor (registers additional tasks to methods)
     * @return void
     */
    function __construct()
    {
        parent::__construct();

        //-- Register Extra tasks
        $this->registerTask('new' , 'edit');
    }// function

    /**
     * display the edit form
     * @return void
     */
    function edit()
    {
        JRequest::setVar('view', 'league');
        JRequest::setVar('layout', 'form');
        JRequest::setVar('hidemainmenu', 1);

        parent::display();
    }// function

    /**
     * save a record (and redirect to main page)
     * @return void
     */
    function save()
    {
    	  global $mainframe;
        $model = $this->getModel('league');
		  $post	= (array)JRequest::get('post');
        if( $model->store($post) )
        {
            $msg = JText::_('Record Saved');
        		$link = 'index.php?option=com_teams&view=leaguess';
        		$this->setRedirect($link, $msg);
        }
        else
        {
        		$mainframe->setUserState( "post", $post);
            $msg = JText::_('Error - Record Not Saved');
        		$link = 'index.php?option=com_teams&controller=league&task=add&view=league&layout=form';
        		$this->setRedirect($link, $msg);
        }
    }// function

    /**
     * remove record(s)
     * @return void
     */
    function delete()
    {
        $model = $this->getModel('league');
        if( ! $model->delete() )
        {
            $msg = JText::_('Error: One or More Records Could not be Deleted' );
        }
        else
        {
            $msg = JText::_( 'Records Deleted' );
        }

        $this->setRedirect( 'index.php?option=com_teams&view=leaguess', $msg );
    }// function

    /**
     * cancel editing a record
     * @return void
     */
    function cancel()
    {
        $msg = JText::_( 'Operation Cancelled' );
        $this->setRedirect( 'index.php?option=com_teams&view=leaguess', $msg );
    }//function

}//class
