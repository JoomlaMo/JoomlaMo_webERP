<?php
global $mainframe;
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view' );
jimport('joomla.application.component.helper');
require_once( JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'canceltoolbar.php' );
class emergencypreparednessViewselectassettype extends JView
{
	function __construct( $config = array())
	{  
    global $mainframe, $context;
     
 	 parent::__construct( $config );
	}
 
	function display($tpl = null)
	{		 
    	global $mainframe, $context;
		$uri	=& JFactory::getURI();		
		// $bar =& new JToolBar( 'Asset Type Toolbar' );
		$document = & JFactory::getDocument();
		$document->setTitle( JText::_('Choose Asset Type') );
		$items			=& $this->get( 'Data');
		
    	$this->assignRef('user',				JFactory::getUser());	
  		$this->assignRef('items',				$items); 		
    	$this->assignRef('request_url',		$uri->toString());

		parent::display($tpl);
  	}
}
?>
