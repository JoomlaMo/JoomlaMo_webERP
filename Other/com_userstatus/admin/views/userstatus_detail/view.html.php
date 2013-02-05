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
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

class userstatus_detailViewuserstatus_detail extends JView
{
	function __construct( $config = array())
	{	 
    	global $mainframe, $context; 
 	 	parent::__construct( $config );
	} 
	function display($tpl = null)
	{		 
    	global $mainframe, $context;
		$document 		= & JFactory::getDocument();
		$document->setTitle( JText::_('Add Status Record') );
		JToolBarHelper::title(   JText::_( 'Status Manager' ), 'generic.png' );	
		JToolBarHelper::save( 'save' );     
		$uri							=& JFactory::getURI();
		$pagination 				=& $this->get( 'Pagination' );
		$users						=& $this->get( 'Data');
		$userstatus					=  $this->get( 'UserStatus');
		$locationdescriptions	=& $this->get( 'LocationDescriptions');
		$post	= JRequest::get('post');
		If($post['task'] == 'edit'){		
			$userstatuslocation	=& userstatus_detailModeluserstatus_detail::getUserStatusLocation($post['cid'][0]);
    		$this->assignRef('userstatuslocation',	$userstatuslocation);
		}
    	$this->assignRef('user',						JFactory::getUser());	
  		$this->assignRef('users',						$users); 			
  		$this->assignRef('userstatus',				$userstatus); 	 	
  		$this->assignRef('locationdescriptions',	$locationdescriptions);
    	$this->assignRef('pagination',				$pagination);
    	$this->assignRef('request_url',				$uri->toString());
		parent::display($tpl);
  	}
  	function var_dump_pre($mixed = null) {
  		echo '<pre>';
  		var_dump($mixed);
  		echo '</pre>';
  		return null;
	}
}
?>
