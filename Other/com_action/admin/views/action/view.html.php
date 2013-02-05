<?php

defined('_JEXEC') or die('=;)');

jimport( 'joomla.application.component.view');

class ActionsViewAction extends JView
{
    function display($tpl = null)
    {
        $Action =& $this->get('Data');
        $isNew = ($Action->id < 1);

        $text = $isNew ? JText::_('New') : JText::_('Edit');
        JToolBarHelper::title('Action: <small><small>[ '.$text.' ]</small></small>');
        JToolBarHelper::save();
        if($isNew)
        {
            JToolBarHelper::cancel();
        }
        else
        {
            JToolBarHelper::cancel('cancel', JText::_('Close'));
        }

        $this->assignRef('Action', $Action);

        parent::display($tpl);
    }

}
