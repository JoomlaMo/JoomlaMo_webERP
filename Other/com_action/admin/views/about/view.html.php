<?php
/**
 * @version	1.0
 * @package	Associatedparts
 * @author Mo Kelly
 * @author mail	mokelly@rockwall-computer.com
 * @copyright	Copyright (C) 2009 Mo Kelly - All rights reserved.
 * @license		GNU/GPL
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.application.component.view' );
class ActionsViewabout extends Jview
{

	function __construct()
	{
		parent::__construct();
	}
	
	function display($tpl = null)
	{		 
    	global $mainframe, $context;
		
		$document = & JFactory::getDocument();
		$document->setTitle( JText::_('About Actions') );
   
    	JToolBarHelper::title(   JText::_( 'About Actions' ), 'generic.png' );
		parent::display($tpl);
  	}
}