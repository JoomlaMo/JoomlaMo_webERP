<?php
/**
 * @version	1.0
 * @package	barcode
 * @author Mo Kelly
 * @author mail	mokelly@rockwall-computer.com
 * @copyright	Copyright (C) 2009 Mo Kelly - All rights reserved.
 * @license		GNU/GPL
 */
 
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class barcodeController extends JController
{

	function __construct()
	{
		parent::__construct();
	}
	
	function display($tpl = null)
	{
		parent::display($tpl);
	}

}