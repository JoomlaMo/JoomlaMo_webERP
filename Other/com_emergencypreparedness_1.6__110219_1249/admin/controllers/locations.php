<?php


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.controller' );

class locationsController extends JController
{

	function __construct( $default = array())
	{
		parent::__construct( $default );
	}

	function cancel()
	{
		$this->setRedirect( 'index.php' );
	}
	function remove()
	{
		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select a location to delete' ) );
		}
		$model = $this->getModel('locations');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}
		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=locations',$msg );
	}
	function edit()
	{
		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );		
		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=locations_detail&taks=edit&cid=' . $cid[0],$msg );
	}
	function add()
	{		
		$this->setRedirect( 'index.php?option=com_emergencypreparedness&task=add&controller=locations_detail',$msg );
	}
	function display() {
		parent::display();
	}
}	
?>
