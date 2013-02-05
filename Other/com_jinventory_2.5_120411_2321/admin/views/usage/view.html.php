<?php
/**
* @package JInventory
* @version 1.5
* @copyright Copyright (C) 2008 Mo Kelly. All rights reserved.
   
*	This program is free software: you can redistribute it and/or modify    
*	it under the terms of the GNU General Public License as published by
*  the Free Software Foundation, either version 3 of the License, or
*  (at your option) any later version.*
*
*  This program is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.*

*  You should have received a copy of the GNU General Public License
*  along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/ 

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//DEVNOTE: import VIEW object class
jimport( 'joomla.application.component.view' );

/**
 [controller]View[controller]
 */
 
class usageViewusage extends JView
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
	 $context = 'usage.list.';
 
 	 parent::__construct( $config );
	}
 
	function display($tpl = null)
	{
	 	//DEVNOTE: we need these 2 globals			 
    global $mainframe, $context;
		
		//DEVNOTE: set document title
		$document = & JFactory::getDocument();
		$document->setTitle( JText::_('USAGE') );
   
   
    //DEVNOTE: Set ToolBar title
    JToolBarHelper::title(   JText::_( 'USAGE MANAGER' ), 'generic.png' );
    
    //DEVNOTE: Set toolbar items for the page
 		//JToolBarHelper::addNewX();
 		//JToolBarHelper::editListX();		
		//JToolBarHelper::deleteList();
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();  

    //DEVNOTE: Set ToolBar title
		$uri	=& JFactory::getURI();
		
		//DEVNOTE:give me ordering from request
		$filter_order     = $mainframe->getUserStateFromRequest( $context.'filter_order',      'filter_order', 	  'ordering' );
		$filter_order_Dir = $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',  'filter_order_Dir', '' );		
	
		//DEVNOTE:remember the actual order and column  
		$lists['order'] = $filter_order;  
		$lists['order_Dir'] = $filter_order_Dir;
  	
		//DEVNOTE:Get data from the model
		$items			= & $this->get( 'Data');
		$total			= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );
		
    //DEVNOTE:save a reference into view	
    $this->assignRef('user',			JFactory::getUser());	
    $this->assignRef('lists',			$lists);    
  	 $this->assignRef('items',			$items); 		
    $this->assignRef('pagination',	$pagination);
    $this->assignRef('request_url',	$uri->toString());

		//DEVNOTE:call parent display
    parent::display($tpl);
  }
}

?>
