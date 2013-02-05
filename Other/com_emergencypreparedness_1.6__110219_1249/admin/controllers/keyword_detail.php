<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.controller' );
class keyword_detailController extends JController
{

	function __construct( $default = array())
	{
		parent::__construct( $default );
		$this->registerTask( 'add'  , 	'edit' );
	}
	function save()
	{
		$post	= JRequest::get('post');
		$model = $this->getModel('keyword_detail');	
		if ($model->store($post)) {
			$msg = JText::_( 'Keyword Saved' );
		} else {
			$msg = JText::_( 'Error Saving Keyword' . $this->_error);
		}
		// echo $msg . " save";exit;
		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=keyword',$msg );
	}

	function remove()
	{
		global $mainframe;

		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an keyword to delete' ) );
		}

		$model = $this->getModel('keyword_detail');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=keyword',$msg );
	}
	function cancel()
	{
		$model = $this->getModel('keyword_detail');
		$model->checkin();
		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=keyword',$msg );
	}	
}
