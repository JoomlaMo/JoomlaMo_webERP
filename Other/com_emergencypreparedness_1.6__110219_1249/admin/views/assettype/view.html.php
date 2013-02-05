<?php


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//DEVNOTE: import VIEW object class
jimport( 'joomla.application.component.view' );

/**
 [controller]View[controller]
 */
 
class assettypeViewassettype extends JView
{
	/**
	 * Custom Constructor
	 */
	function __construct( $config = array())
	{
	 /** set up global variable for sorting etc.
	  * $context is used in VIEW abd in MODEL
	  **/	  
	 
 	 global $context;
	 $context = 'asset_type.list.';
 
 	 parent::__construct( $config );
	}
 

    
	function display($tpl = null)
	{			 
    	global $mainframe, $context;
		
		$document = & JFactory::getDocument();
		$document->setTitle( JText::_('Asset Type') );   
   
    	JToolBarHelper::title(   JText::_( 'Asset Type' ), 'generic.png' );
 		JToolBarHelper::addNewX();
 		JToolBarHelper::editListX();		
		JToolBarHelper::deleteList(); 
		
		$uri	=& JFactory::getURI();
		// build list of models
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
