<?php

defined('_JEXEC') or die('=;)');

jimport('joomla.application.component.view');

class ActionsViewchecklists extends JView
{

	function display($tpl = null)
	{
		JHTML::stylesheet( 'Action.css', 'administrator/components/com_Action/assets/' );
		JToolBarHelper::title(   '&nbsp;&nbsp;' .JText::_( 'checklists' ), 'checklist');

		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();

		$items	= & $this->get( 'Data');
		$pagination =& $this->get('Pagination');

		$lists = & $this->get('List');

		$this->assignRef('items', $items);
		$this->assignRef('pagination', $pagination);
		$this->assignRef('lists', $lists);

		parent::display($tpl);
	}

}
