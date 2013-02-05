<?php


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//DEVNOTE: import VIEW object class
jimport( 'joomla.application.component.view' );

/**
 [controller]View[controller]
 */
 
class locationsViewlocations extends JView
{

	function __construct( $config = array())
	{

	 
 	 global $context;
	 $context = 'locations.list.';
 
 	 parent::__construct( $config );
	}
 

    
	function display($tpl = null)
	{			 
    	global $mainframe, $context;
		
		$document = & JFactory::getDocument();
		$document->setTitle( JText::_('Locations') );
   
   
    	JToolBarHelper::title(   JText::_( 'Location Manager' ), 'generic.png' );
 		JToolBarHelper::addNewX();
 		JToolBarHelper::editListX();		
		JToolBarHelper::deleteList(); 
		
		$uri	=& JFactory::getURI();
		$javascript 	= 'onchange="document.adminForm.submit();"';
		$items			=& $this->get( 'Data');
		$pagination 	=& $this->get( 'Pagination' );
			
  	 	$this->assignRef('items',			$items); 			
    	$this->assignRef('pagination',	$pagination);
    	$this->assignRef('request_url',	$uri->toString());
    	parent::display($tpl);
  	}
}

?>
