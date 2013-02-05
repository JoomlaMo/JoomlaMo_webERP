<?php
/**
 * @version SVN: $Id$
 * @package    ActionList
 * @subpackage Views
 * @author     EasyJoomla {@link http://www.easy-joomla.org Easy-Joomla.org}
 * @author     Mo Kelly {@link http://joomlamo.com}
 * @author     Created on 28-Apr-2010
 */

//-- No direct access
defined('_JEXEC') or die('=;)');

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the ActionList Component
 *
 * @package    ActionList
 * @subpackage Views
 */
class ActionListViewActionList extends JView
{
    /**
     * ActionList view display method
     * @return void
     **/
    function display($tpl = null)
    {
        $random = $this->get('random');
        $this->assignRef('random', $random);

        $this->setLayout('raw');

        parent::display($tpl);
    }//function

}//class
