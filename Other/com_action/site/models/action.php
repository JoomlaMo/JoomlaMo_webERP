<?php
/**
 * @version SVN: $Id$
 * @package    ActionList
 * @subpackage Models
 * @author     EasyJoomla {@link http://www.easy-joomla.org Easy-Joomla.org}
 * @author     Mo Kelly {@link http://joomlamo.com}
 * @author     Created on 28-Apr-2010
 */

//-- No direct access
defined('_JEXEC') or die('=;)');

jimport('joomla.application.component.model');

/**
 * ActionList Model
 *
 * @package    ActionList
 * @subpackage Models
 */
class ActionListModelActionList extends JModel
{
    /**
     * Gets the greetings.
     *
     * @return ObjectList The greetings to be displayed to the user
     */
    function getGreetings()
    {
        $db =& JFactory::getDBO();

        $query = 'SELECT greeting FROM #__actionlist';
        $db->setQuery($query);
        $greetings = $db->loadObjectList();

        return $greetings;
    }//function

    /**
     * gets a random greeting
     *
     * @return string a random greeting
     */
    function getRandom()
    {
        $greetings = $this->getGreetings();

        return $greetings[rand(0, count($greetings) - 1)]->greeting;
    }//function

}// class
