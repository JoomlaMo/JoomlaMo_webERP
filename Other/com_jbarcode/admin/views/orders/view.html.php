<?php
/**
* @package Inventory
* @version 1.5
* @copyright Copyright (C) 2008 Mo Kelly. All rights reserved.
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
 
class OrdersViewOrders extends JView
{
	function display($tpl = null)
	{		 
    	global $mainframe, $context;
		
		$document = & JFactory::getDocument();
		$document->setTitle( JText::_('BARCODE ORDERS') );
   	$PrintIcon = "edit.png";
   
    	JToolBarHelper::title(   JText::_( 'BARCODE MANAGER' ), 'generic.png' );
    	JToolBarHelper::custom('printord', $PrintIcon,$PrintIcon,'Print');
		
		$uri	=& JFactory::getURI();
		
		$items			= & $this->get( 'Data');
		$pagination = & $this->get( 'Pagination' );
		
    	$this->assignRef('user',		JFactory::getUser());
  	 	$this->assignRef('items',		$items); 		
    	$this->assignRef('pagination',	$pagination);
    	$this->assignRef('request_url',	$uri->toString());
    	
    	parent::display($tpl);
  }
}

?>
