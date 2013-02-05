<?php
global $mainframe;
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view' );
jimport('joomla.application.component.helper');
require_once( JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'edittoolbar.php' );
$iconPath = JURI::base()."components".DS."com_emergencypreparedness".DS. "icon.css";
$doc =& JFactory::getDocument();
$doc->addStyleSheet($iconPath);
$mainframe->addCustomHeadTag ('<script type="text/javascript" src="/includes/js/joomla.javascript.js"></script>');
class emergencypreparednessVIEWinventory_detail extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;
		$uri 		=& JFactory::getURI();
		$user 	=& JFactory::getUser();
		$model	=& $this->getModel();
		$this->setLayout('form');
		$lists = array();
		$detail	=& $this->get('data');
		$isNew		= ($detail->id < 1);
		$assettype		=& $this->get( 'AssetType' );
		$locations 		=& $this->get( 'Locations' );		
		$keywords 		=& emergencypreparednessModelinventory_detail::getKeywords( $assettype['id'] );
		// emergencypreparednessModelinventory_detail::var_dump_pre($keywords);exit;		
		$post	= JRequest::get('post');
		If(!$isNew){;
			$specifications = &emergencypreparednessModelinventory_detail::getSpecifications($post['cid'][0]);
		}
		$document = & JFactory::getDocument();
		$document->setTitle( JText::_('INVENTORY') );
		$text = $isNew ? JText::_( 'NEW' ) : JText::_( 'EDIT' );
		if (!$isNew)
		{
			$model->checkout( $user->get('id') );			
		}
		else
		{
			$detail->published 	= 1;
		}	
		$this->assignRef('lists',				$lists);
		$this->assignRef('detail',				$detail);
    	$this->assignRef('assettype',			$assettype);
    	$this->assignRef('locations',			$locations);
    	$this->assignRef('keywords',			$keywords);
    	$this->assignRef('specifications',	$specifications);
		$this->assignRef('request_url',		$uri->toString());
		parent::display($tpl);
	}
}

?>
