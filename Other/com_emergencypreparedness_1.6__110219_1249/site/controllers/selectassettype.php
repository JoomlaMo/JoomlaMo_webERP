<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.controller' );
class emergencypreparednesscontrollerselectassettype extends JController
{
	function __construct( $default = array())
	{
      JRequest::setVar('view' , 'selectassettype');
		parent::__construct( $default );
	}
	function display()
	{
		parent::display();
	} 
	function save(){ 
       parent::display();
   }
   function remove()
	{
		global $mainframe;

		$model = $this->getModel('selectassettype');

		$this->setRedirect( 'index.php?option=com_emergencypreparedness' );
	}	
	function cancel()
	{
		$model = $this->getModel('inventory_detail');
		$model->checkin();
		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=inventory' );
	}
}	
?>