<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view' );
class locations_detailVIEWlocations_detail extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;	
    	JToolBarHelper::title(   JText::_( 'Location Manager' ), 'generic.png' );
		$uri 	=& JFactory::getURI();
		$user 	=& JFactory::getUser();
		$model	=& $this->getModel();
		$this->setLayout('form');
		$detail	=& $this->get('data');		
		$isNew		= ($detail->id < 1);
		$text = $isNew ? JText::_( 'NEW' ) : JText::_( 'EDIT' );
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}
		JToolBarHelper::help( 'screen.version.edit' );
		jimport('joomla.filter.filteroutput');	
		JFilterOutput::objectHTMLSafe( $detail, ENT_QUOTES );	
		$this->assignRef('detail',			$detail);
		$this->assignRef('request_url',	$uri->toString());
		parent::display($tpl);
	}	
}	

?>
