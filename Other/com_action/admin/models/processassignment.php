<?php

defined('_JEXEC') or die('=;)');

jimport('joomla.application.component.model');

class ActionsModelprocessassignment extends JModel
{
	function __construct()
	{
		parent::__construct();
	}

	function store($data)
	{
		$row =& $this->getTable('processassignment');
		$app =& JFactory::getApplication();
		if (!$row->bind($data)) {			
			$app->enqueueMessage(JText::_( 'Bind Error'  . $row->getError() ));
			return false;
		}
		if (!$row->check()) {
			$app->enqueueMessage(JText::_( 'Check Error'  . $row->getError() ));
			return false;
		}
		if (!$row->store()) {
			$app->enqueueMessage(JText::_( 'Store Error ' . $row->getError() ));
			return false;
		}

		return true;
	}

	function delete()
	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$row =& $this->getTable('processassignment');

		if (count( $cids )) {
			foreach($cids as $cid) {
				if (!$row->delete( $cid )) {
					$this->setError( $row->getError() );
					return false;
				}
			}
		}
		return true;
	}

	function getData()
	{
		$id = JRequest::getVar('cid');
		$row =& $this->getTable('processassignment');
		$row->load($id[0]);
		return $row;
	}
}
