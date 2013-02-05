<?php


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.controller' );

class assettypecontroller extends JController
{     

	function __construct( $default = array())
	{
		parent::__construct( $default );
	}


	function save()
	{
		$post	= JRequest::get('post');
		$model = $this->getModel('assettype');
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

		$model = $this->getModel('assettype');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=assettype',$msg );
	}
	function edit()
	{
		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );		
		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=assettype_detail&task=edit&cid=' . $cid[0],$msg );
	}
	function add()
	{		
		$this->setRedirect( 'index.php?option=com_emergencypreparedness&task=add&controller=assettype_detail',$msg );
	}
	function cancel()
	{
		$model = $this->getModel('assettype');
		$model->checkin();
		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=assettype',$msg );
	}		

	function display() {
		parent::display();
	}
}	
?>
