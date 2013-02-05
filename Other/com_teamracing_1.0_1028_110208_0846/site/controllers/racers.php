<?php
/**
 * @version SVN: $Id$
 * @package    teamrace
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

//-- No direct access
defined('_JEXEC') or die('=;)');

jimport('joomla.application.component.controller');
/**
 * team Controller
 *
 * @package    team
 * @subpackage Controllers
 */
class teamracingControllerracer extends teamsController
{
    /**
     * constructor (registers additional tasks to methods)
     * @return void
     */
    function __construct()
    {
        parent::__construct();

        //-- Register Extra tasks
        $this->registerTask('add' , 'edit');
    }// function

    /**
     * display the edit form
     * @return void
     */
    function edit()
    {
        JRequest::setVar('view', 'racer');
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
        $model = $this->getModel('racer');

        if( $model->store() )
        {
            $msg = JText::_('Record Saved');
        }
        else
        {
            $msg = JText::_('Error Saving Record');
        }

        $link = 'index.php?option=com_teamrace';
        $this->setRedirect($link, $msg);
    }// function

    /**
     * remove record(s)
     * @return void
     */
    function remove()
    {
        $model = $this->getModel('racer');
        if( ! $model->delete() )
        {
            $msg = JText::_('Error: One or More Records Could not be Deleted' );
        }
        else
        {
            $msg = JText::_( 'Records Deleted' );
        }

        $this->setRedirect( 'index.php?option=com_teamrace', $msg );
    }// function

    /**
     * cancel editing a record
     * @return void
     */
    function cancel()
    {
        $msg = JText::_( 'Operation Cancelled' );
        $this->setRedirect( 'index.php?option=com_teamrace', $msg );
    }//function

}//class
