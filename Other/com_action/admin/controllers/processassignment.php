<?php

defined('_JEXEC') or die('=;)');

jimport('joomla.application.component.controller');

class ActionsControllerprocessassignment extends JController
{
	var $cid;

	function __construct()
	{
		parent::__construct();
		JRequest::setVar( 'view', 'processassignments' );
		JRequest::setVar( 'layout', 'default'  );
		JRequest::setVar('hidemainmenu', 0);
		$this->registerTask( 'add'  , 	'edit' );
		$this->registerTask( 'unpublish', 	'publish');

		$this->cid = JRequest::getVar( 'cid', array(0), '', 'array' );
		JArrayHelper::toInteger($this->cid, array(0));
	}
	function _buildQuery()
	{
		$this->_query = 'UPDATE #__action_processassignment'
		. ' SET published = ' . (int) $this->publish
		. ' WHERE id IN ( '. $this->cids .' )'
		;
		return $this->_query;
	}
	function edit()
	{
		JRequest::setVar( 'view', 'processassignment' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);
		parent::display();
	}

	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_Action&view=processassignments', $msg );
	}
	function publish()
	{
		$cid		= JRequest::getVar( 'cid', array(), '', 'array' );
		$this->publish	= ( $this->getTask() == 'publish' ? 1 : 0 );

		JArrayHelper::toInteger($cid);
		if (count( $cid ) < 1)
		{
			$action = $publish ? 'publish' : 'unpublish';
			JError::raiseError(500, JText::_( 'Select an item to' .$action, true ) );
		}

		$this->cids = implode( ',', $cid );

		$query = $this->_buildQuery();
		$db = &JFactory::getDBO();
		$db->setQuery($query);
		if (!$db->query())
		{
			JError::raiseError(500, $db->getError() );
		}
		$link = 'index.php?option=com_Action&view=processassignments';
		$this->setRedirect($link, $msg);
	}

	function save()
	{
		$post	= JRequest::get('post');
		$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		#_ECR_SMAT_DESCRIPTION_CONTROLLER1_
		$post['id'] 	= (int) $cid[0];

		$model = $this->getModel( 'processassignment' );
		if ($model->store($post)) {
			$msg = JText::_( 'Item Saved' );
		} else {
			$msg = JText::_( 'Error Saving Item' );
		}

		$link = 'index.php?option=com_Action&view=processassignments';
		$this->setRedirect( $link, $msg );
	}

	function remove()
	{
		$model = $this->getModel('processassignment');
		if(!$model->delete()) {
			$msg = JText::_( 'Error Deleting Item' );
		} else {
			$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
			foreach($cids as $cid) {
				$msg .= JText::_( 'Item Deleted '.' : '.$cid );
			}
		}

		$this->setRedirect( 'index.php?option=com_Action&view=processassignments', $msg );
	}

	function _reOrder($direction)
{
	global $mainframe;

	// Check for request forgeries
	JRequest::checkToken() or jexit( 'Invalid Token' );

	// Initialize variables
	$db	= & JFactory::getDBO();
	$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );

	if (isset( $cid[0] ))
	{
		$row = & JTable::getInstance('processassignment', 'Table');
		$row->load( (int) $cid[0] );
		$row->move($direction);

		$cache = & JFactory::getCache('com_Action');
		$cache->clean();
	}

	$mainframe->redirect('index.php?option=com_Action&view=processassignments');
}

function saveorder()
{
	global $mainframe;

	// Check for request forgeries
	JRequest::checkToken() or jexit( 'Invalid Token' );

	// Initialize variables
	$db =& JFactory::getDBO();
	$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );

	$total = count( $cid );
	$order = JRequest::getVar( 'order', array(0), 'post', 'array' );
	JArrayHelper::toInteger($order, array(0));

	$row =& JTable::getInstance('".$element_name."', 'Table');

	// update ordering values
	for( $i=0; $i < $total; $i++ ) {
		$row->load( (int) $cid[$i] );
		// track sections
		if ($row->ordering != $order[$i]) {
			$row->ordering = $order[$i];
			if (!$row->store()) {
				JError::raiseError(500, $db->getError());
			}
		}
	}

	$row->reorder();

	$msg = JText::_( 'New ordering saved' );
	$mainframe->redirect('index.php?option=com_Action&view=processassignments', $msg);
}

function orderup()
{
	if ($this->order == 'desc')
	$this->_reOrder(1);
	else
	$this->_reOrder(-1);
}

function orderdown()
{
	if ($this->order == 'desc')
	$this->_reOrder(-1);
	else
	$this->_reOrder(1);
}

}
