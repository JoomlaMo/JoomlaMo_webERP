<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.controller' );
class locations_detailcontroller extends JController
{
	function __construct( $default = array())
	{
		parent::__construct( $default );
		$this->registerTask( 'add'  , 	'edit' );
	}
	function save()
	{
		$post	= JRequest::get('post');
		$model = $this->getModel('locations_detail');	
		if ($model->store($post)) {
			$msg = JText::_( 'Location Saved' );
		} else {
			$msg = JText::_( 'Error Saving Location' . $this->_error);
		}
		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=locations',$msg );
	}
	function remove()
	{
		global $mainframe;
		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select a location to delete' ) );
		}
		$model = $this->getModel('locations_detail');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=locations',$msg );
	}
	function cancel()
	{
		// Checkin the detail
		$model = $this->getModel('locations_detail');
		$model->checkin();
		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=locations',$msg );
	}	
}
