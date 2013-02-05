<?php


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.controller' );

class keywordController extends JController
{

	function __construct( $default = array())
	{
		parent::__construct( $default );
	}
	function edit()
	{
		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );		
		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=keyword_detail&task=edit&cid=' . $cid[0],$msg );
	}
	function add()
	{		
		$this->setRedirect( 'index.php?option=com_emergencypreparedness&task=add&controller=keyword_detail',$msg );
	}
	function cancel()
	{
		$this->setRedirect( 'index.php' );
	}
	function remove()
	{
		global $mainframe;

		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('keyword');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=keyword',$msg );
	}

	function display() {
		parent::display();
	}
}	
?>
