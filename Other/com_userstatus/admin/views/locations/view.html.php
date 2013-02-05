<?php
/**
* @package UserStatus
* @version 1.5
* @copyright Copyright (C) 2010 Mo Kelly. All rights reserved.
   
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
   
   
    	JToolBarHelper::title(   JText::_( 'Status Location Manager' ), 'generic.png' );
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
