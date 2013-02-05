<?php

defined('_JEXEC') or die('=;)');

jimport('joomla.application.component.view');

class ActionsViewchecklist extends JView
{
	function display($tpl = null)
	{
		JHTML::stylesheet( 'Action.css', 'administrator/components/com_Action/assets/' );

		//Data from model
		$item =& $this->get('Data');
		$isNew = ($item->id < 1);
		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );

		JToolBarHelper::title(   '&nbsp;&nbsp;' .JText::_( 'Check List' ).': <small><small>[ ' . $text.' ]</small></small>', 'checklist');

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
