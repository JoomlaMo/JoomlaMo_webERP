<?php


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//DEVNOTE: import VIEW object class
jimport( 'joomla.application.component.view' );

/**
 [controller]View[controller]
 */
 
class keywordViewkeyword extends JView
{

	function __construct( $config = array())
	{	 
 	 	global $context;
	 	$context = 'keyword.list.'; 
 	 	parent::__construct( $config );
	}    
	function display($tpl = null)
	{			 
    	global $mainframe, $context;
		
		$document = & JFactory::getDocument();
		$document->setTitle( JText::_('Keyword') );
   
   
    	JToolBarHelper::title(   JText::_( 'Keyword Manager' ), 'generic.png' );
 		JToolBarHelper::addNewX();
 		JToolBarHelper::editListX();		
		JToolBarHelper::deleteList(); 
		
		$uri	=& JFactory::getURI();
		// build list of models
		$javascript 	= 'onchange="document.adminForm.submit();"';
		$Asset_Types 	=& $this->get( 'Asset_Types'); 
		$items			=& $this->get( 'Data');
		$pagination 	=& $this->get( 'Pagination' );
			
  	 	$this->assignRef('items',			$items); 		
  	 	$this->assignRef('Asset_Types',$Asset_Types); 		
    	$this->assignRef('pagination',	$pagination);
    	$this->assignRef('request_url',	$uri->toString());
    	parent::display($tpl);
  	}
}

?>
