<?php
global $mainframe;
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view' );
jimport('joomla.application.component.helper');
require_once( JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'toolbar.php' );
$iconPath = JURI::base()."components".DS."com_emergencypreparedness".DS. "icon.css";
$doc =& JFactory::getDocument();
$doc->addStyleSheet($iconPath);
$mainframe->addCustomHeadTag ('<script type="text/javascript" src="/includes/js/joomla.javascript.js"></script>');
class emergencypreparednessViewinventory extends JView
{
	function __construct( $config = array())
	{  
    global $mainframe, $context;
     
 	 parent::__construct( $config );
	}
 
	function display($tpl = null)
	{		 
    	global $mainframe, $context;
		// $bar =& new JToolBar( 'Associations Toolbar' );
		$document = & JFactory::getDocument();
		$document->setTitle( JText::_('INVENTORY') );
		
		$uri	=& JFactory::getURI();		
		$items			=& $this->get( 'Data');
		$assettypes		=& $this->get( 'AssetTypes' );
		$locations 		=& $this->get( 'Locations' );
		$keywords 		=& $this->get( 'Keywords' );
		$specifications=& $this->get( 'Specifications' );
		$pagination 	=& $this->get( 'Pagination' );
		
    	$this->assignRef('user',				JFactory::getUser());	
  		$this->assignRef('items',				$items); 		
    	$this->assignRef('pagination',		$pagination);
    	$this->assignRef('assettypes',		$assettypes);
    	$this->assignRef('locations',			$locations);
    	$this->assignRef('keywords',			$keywords);
    	$this->assignRef('specifications',	$specifications);
    	$this->assignRef('request_url',		$uri->toString());

		parent::display($tpl);
  	}
}
?>
