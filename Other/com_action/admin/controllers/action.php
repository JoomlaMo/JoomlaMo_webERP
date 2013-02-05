<?php

defined('_JEXEC') or die('=;)');

jimport('joomla.application.component.controller');

class ActionsControllerAction extends ActionsController
{
    function __construct()
    {
        parent::__construct();
        $this->registerTask('add', 'edit');
    }
    function edit()
    {
        JRequest::setVar('view', 'Action');
        JRequest::setVar('layout', 'form');
        JRequest::setVar('hidemainmenu', 1);
        parent::display();
    }
    function save()
    {
        $model = $this->getModel('Action');

        if($model->store())
        {
            $msg = JText::_('Record Saved!');
        }
        else
        {
            $msg = JText::_('Error Saving Record');
        }

        $link = 'index.php?option=com_action';
        $this->setRedirect($link, $msg);
    }
    function remove()
    {
        $model = $this->getModel('Action');
        if(!$model->delete()){
            $msg = JText::_('Error: One or More Records Could not be Deleted');
        } else {
            $msg = JText::_('Record(s) Deleted');
        }

        $this->setRedirect('index.php?option=com_action', $msg);
    }
    function cancel()
    {
        $msg = JText::_('Operation Cancelled');
        $this->setRedirect('index.php?option=com_action&controller=action', $msg);
    }

}
