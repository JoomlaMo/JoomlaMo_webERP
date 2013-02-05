<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view' );
class keyword_detailVIEWkeyword_detail extends JView
{
	function display($tpl = null)
	{	
		global $mainframe, $option;	
    	JToolBarHelper::title(   JText::_( 'Keyword Manager Detail' ), 'generic.png' );
		$uri 		=& JFactory::getURI();
		$user 	=& JFactory::getUser();
		$model	=& $this->getModel(); 
		$this->setLayout('form');
		$detail	=& $this->get('data');
		$isNew		= ($detail->id < 1);
		$text = $isNew ? JText::_( 'NEW' ) : JText::_( 'EDIT' );
		JToolBarHelper::title(   JText::_( 'Keyword' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}
		jimport('joomla.filter.filteroutput');	
		JFilterOutput::objectHTMLSafe( $detail, ENT_QUOTES );			
		$assettypes =& $this->get('AssetTypes');
		$this->assignRef('assettypes',	$assettypes);
		$this->assignRef('detail',			$detail);
		$this->assignRef('request_url',	$uri->toString());
		parent::display($tpl);
	}	
}	
?>
