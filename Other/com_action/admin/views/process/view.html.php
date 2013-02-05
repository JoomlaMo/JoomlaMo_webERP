<?php

defined('_JEXEC') or die('=;)');

jimport('joomla.application.component.view');

class ActionsViewprocess extends JView
{
	function display($tpl = null)
	{
		JHTML::stylesheet( 'Action.css', 'administrator/components/com_Action/assets/' );

		$item =& $this->get('Data');
		$isNew = ($item->id < 1);
		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );

		JToolBarHelper::title(   '&nbsp;&nbsp;' .JText::_( 'process' ).': <small><small>[ ' . $text.' ]</small></small>', 'process');

		JToolBarHelper::save();
		JToolBarHelper::cancel();

		$editor =& JFactory::getEditor();
		$this->assignRef('editor', $editor);

		// $lists['published'] = JHTML::_('select.booleanlist',  'published', 'class="inputbox"', $item->published );
		$this->assignRef('lists', $lists);

		$this->assignRef('item', $item);
		parent::display($tpl);
	}
}
