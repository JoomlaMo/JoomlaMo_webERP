<?php
/**
* @package Inventory
* @version 1.5
* @copyright Copyright (C) 2008 Mo Kelly. All rights reserved.
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.controller' );
class printpdfController extends JController
{
	function __construct( $default = array())
	{
		parent::__construct( $default );
	}
	function display()
	{
		$VIEW= & $this->getView( 'printpdf','pdf');
		// echo "<BR>display - controller<BR>";
		parent::display();
	}
	

}
