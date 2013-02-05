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
defined('_JEXEC') or die('=;)');
jimport('joomla.application.component.controller');

class teamracingControllerracer extends teamracingController
{

    function __construct()
    {
        JRequest::setVar('view', 'racer');
        JRequest::setVar('layout', 'form');
        parent::__construct();

        //-- Register Extra tasks
        $this->registerTask('add' , 'edit');
    }
    function edit()
    {
        JRequest::setVar('view', 'racer');
        JRequest::setVar('layout', 'form');

        parent::display();
    }
    function save()
    {
    	global $mainframe;
        $model = $this->getModel('racer');
		  $post	= JRequest::get('request');
		  $user =& JFactory::getUser();
        $post['userid'] = $user->id;
        if( $model->store($post) )
        {
            $msg = JText::_('Record Saved');
        		$link = 'index.php?option=com_teamracing&view=racerss';
        		$this->setRedirect($link, $msg);
        }
        else
        {
        		$mainframe->setUserState( "post", $post);
            $msg = JText::_('Error - Record Not Saved');
        		$link = 'index.php?option=com_teamracing&controller=racer&task=add&view=racer&layout=form';
        		$this->setRedirect($link, $msg);
        }

    }
    function delete()
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

        $this->setRedirect( 'index.php?option=com_teamracing&view=racerss', $msg );
    }
    function cancel()
    {
        $msg = JText::_( 'Operation Cancelled' );
        $this->setRedirect( 'index.php?option=com_teamracing&view=racers', $msg );
    }//function

}//class
