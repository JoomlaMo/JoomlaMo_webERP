<?php
/**
* @package Inventory
* @version 1.5
* @copyright Copyright (C) 2008 Mo Kelly. All rights reserved.
*/



// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML Article View class for the Content component
 *
 * @package		Joomla
 * @subpackage	Content
 * @since 1.5
 */
class printrecViewprintrec extends JView
{
	function display($tpl = null)
	{
    	global $mainframe, $context;		
		$items			=& $this->get( 'Data');	
		// var_dump($items);echo "<BR><BR>items<BR><BR><BR>";exit;
  		$this->assignRef('items',			$items); 		
		parent::display($tpl);
	}

	
}
?>

