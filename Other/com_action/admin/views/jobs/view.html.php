<?php

defined('_JEXEC') or die('=;)');

jimport('joomla.application.component.view');

class ActionsViewjobs extends JView
{

	function display($tpl = null)
	{
		JHTML::stylesheet( 'Action.css', 'administrator/components/com_Action/assets/' );
		JToolBarHelper::title(   '&nbsp;&nbsp;' .JText::_( 'Jobs' ), 'job');

		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();

		$items	= & $this->get( 'Data');
		If(count($items) > 0){
			$pagination =& $this->get('Pagination');
			$this->assignRef('pagination', $pagination);
		}

		$lists = & $this->get('List');

		$this->assignRef('items', $items);
		$this->assignRef('lists', $lists);

		parent::display($tpl);
	}

}
