<?php
defined('_JEXEC') or die('=;)');

jimport( 'joomla.application.component.view');

class ActionsViewActions extends JView
{
    function display($tpl = null)
    {
        JToolBarHelper::title(   JText::_( 'Action Manager' ), 'generic.png' );
        JToolBarHelper::deleteList();
        JToolBarHelper::editListX();
        JToolBarHelper::addNewX();

        //-- Get data from the model
        $items =& $this->get('Data');
        $pagination =& $this->get('Pagination');

        //-- push data into the template
        $this->assignRef('items', $items);
        $this->assignRef('pagination', $pagination);

        parent::display($tpl);
    }
}
