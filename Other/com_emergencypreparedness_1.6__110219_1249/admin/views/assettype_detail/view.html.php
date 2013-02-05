<?php


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//DEVNOTE: import VIEW object class
jimport( 'joomla.application.component.view' );


class assettype_detailVIEWassettype_detail extends JView
{
	/**
	 * Display the view
	 */
	function display($tpl = null)
	{
	
		global $mainframe, $option;	
    //DEVNOTE: Set ToolBar title
    JToolBarHelper::title(   JText::_( 'Asset Type Manager Detail' ), 'generic.png' );

		$uri 	=& JFactory::getURI();
		$user 	=& JFactory::getUser();
		$model	=& $this->getModel();


    //DEVNOTE: let's be the template 'form.php' instead of 'default.php' 
		$this->setLayout('form');

    //DEVNOTE: prepare array 
		$lists = array();


		$detail	=& $this->get('data');
		
    //DEVNOTE: the new record ?  Edit or Create?
    
		$isNew		= ($detail->id < 1);



		// Set toolbar items for the page
		$text = $isNew ? JText::_( 'NEW' ) : JText::_( 'EDIT' );
		JToolBarHelper::title(   JText::_( 'Model' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}
		JToolBarHelper::help( 'screen.assettype.edit' );

		$this->assignRef('lists',			$lists);
		$this->assignRef('detail',			$detail);
		$this->assignRef('request_url',	$uri->toString());

		parent::display($tpl);
	}
	
}	

?>
