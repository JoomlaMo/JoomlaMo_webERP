<?php
/**
* @package Inventory
* @version 1.5
* @copyright Copyright (C) 2008 Mo Kelly. All rights reserved.
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//DEVNOTE: import VIEW object class
jimport( 'joomla.application.component.view' );


/**
 [controller]View[controller]
 */
class inventory_detailVIEWinventory_detail extends JView
{
	/**
	 * Display the view
	 */
	function display($tpl = null)
	{
	
		global $mainframe, $option;	
    //DEVNOTE: Set ToolBar title
    JToolBarHelper::title(   JText::_( 'INVENTORY MANAGER DETAIL' ), 'generic.png' );

		//DEVNOTE: Get URL, User,Model
		$uri 		=& JFactory::getURI();
		$user 	=& JFactory::getUser();
		$model	=& $this->getModel();

		$this->setLayout('form');

		$lists = array();


		//get the inventory
		$detail	=& $this->get('data');
	
    //DEVNOTE: the new record ?  Edit or Create?
		$isNew		= ($detail->id < 1);


		// Set toolbar items for the page
		$text = $isNew ? JText::_( 'NEW' ) : JText::_( 'EDIT' );
		JToolBarHelper::title(   JText::_( 'INVENTORY' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}
		JToolBarHelper::help( 'screen.inventory.edit' );



		// Edit or Create?
		if (!$isNew)
		{
		  //EDIT - check out the item
			$model->checkout( $user->get('id') );			
		}
		else
		{
			// initialise new record
			$detail->published = 1;
			$detail->approved 	= 1;
			$detail->order 	= 0;
		}	
		$this->assignRef('lists',			$lists);
		$this->assignRef('detail',		$detail);
		$this->assignRef('request_url',	$uri->toString());
		parent::display($tpl);
	}
}

?>
