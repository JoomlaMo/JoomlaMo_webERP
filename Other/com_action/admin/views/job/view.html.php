<?php
/**
 * @version SVN: $Id$
 * @package    Action
 * @subpackage Views
 * @author     EasyJoomla {@link http://www.easy-joomla.org Easy-Joomla.org}
 * @author     Mo Kelly {@link http://joomlamo.com}
 * @author     Created on 27-Apr-10
 */

//-- No direct access
defined('_JEXEC') or die('=;)');

jimport('joomla.application.component.view');

class ActionsViewjob extends JView
{
	function display($tpl = null)
	{
		JHTML::stylesheet( 'Action.css', 'administrator/components/com_Action/assets/' );

		//Data from model
		$item =& $this->get('Data');
		$isNew = ($item->id < 1);
		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );

		JToolBarHelper::title(   '&nbsp;&nbsp;' .JText::_( 'job' ).': <small><small>[ ' . $text.' ]</small></small>', 'job');

		JToolBarHelper::save();
		JToolBarHelper::cancel();

		$editor =& JFactory::getEditor();
		$this->assignRef('editor', $editor);

		$this->assignRef('lists', $lists);

		$this->assignRef('item', $item);
		parent::display($tpl);
	}
}
