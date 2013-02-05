<?php


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//DEVNOTE: import CONTROLLER object class
jimport( 'joomla.application.component.controller' );

class assettype_detailController extends JController
{

	/**
	 * Custom Constructor
	 */
	function __construct( $default = array())
	{
		// echo "construct";exit;
		parent::__construct( $default );

		// Register Extra tasks
		$this->registerTask( 'add'  , 	'edit' );
	}


	function save()
	{
		$post	= JRequest::get('post');
		$model = $this->getModel('assettype_detail');
		if ($model->store($post)) {
			$msg = JText::_( 'Asset Type Saved' );
		} else {
			$msg = JText::_( 'Error Saving Asset Type' . $this->_error);
		}
		// echo $msg . " save";exit;
		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=assettype',$msg );
	}

	function remove()
	{
		global $mainframe;

		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('assettype_detail');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=assettype',$msg );
	}

	function cancel()
	{
		$model = $this->getModel('assettype_detail');
		$model->checkin();
		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=assettype',$msg );
	}		
}
