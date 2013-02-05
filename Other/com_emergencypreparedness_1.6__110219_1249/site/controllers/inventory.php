<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.controller' );
class emergencypreparednesscontrollerinventory extends JController
{
	function __construct( $default = array())
	{
		global $mainframe;
      JRequest::setVar('view' , 'inventory');
      // If we previously had data entry error then we must clear out $mainframe->getUserState('formpost') to prevent the values
      // stored here from being in the form
      If($mainframe->getUserState('formpost')){
      	$mainframe->setUserState( "formpost",null) ;
      }
      // If we previously added an assety type then we must clear out mainframe variable
      If($mainframe->getUserState('ID')){
      	$mainframe->setUserState( "ID",null) ;
      }
		parent::__construct( $default );
	}
	function display()
	{
		// echo "<BR>display - controller<BR>";
		parent::display();
	}
   function delete()
	{
		global $mainframe;
		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}
		$model = $this->getModel('inventory_detail');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}
		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=inventory' );
	}
}	
?>