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

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class stockcountModelstockcount extends JModel
{
	var $_id = null;

	var $_data = null;
	
	var $_pagination = null;

	var $_table_prefix = null;
	
	function __construct()
	{
		parent::__construct();

		global $mainframe, $context;
		$mainframe = JFactory::getApplication();
	}
	
	
}
?>
