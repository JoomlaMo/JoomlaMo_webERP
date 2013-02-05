<?php
/**
* @package Inventory
* @version 1.5
* @copyright Copyright (C) 2008 Mo Kelly. All rights reserved.
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.controller' );
class ReceiptsController extends JController
{
	function __construct( $default = array())
	{
		parent::__construct( $default );
	}
	function display()
	{
		// echo "<BR>display - controller<BR>";exit;
		parent::display();
	}
	function printrec()
	{		
		$_SESSION['cid']	= JRequest::getVar( 'cid', array(0), 'request', 'array' );
		header("Location: ".JURI::base() . "index.php?option=com_jbarcode&controller=printrec&view=printrec&typelabel=receipt" );
	}
}
