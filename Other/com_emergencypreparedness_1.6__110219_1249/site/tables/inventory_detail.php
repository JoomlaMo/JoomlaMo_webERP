<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');
class Tableinventory_detail extends JTable
{

	var $id 						= null;
	var $description 			= null;
	var $asset_type			= 0;
	var $location 				= 0;
	var $lastlocation			= null;		
	var $athome					= null;		
	var $dateinservice		= null;
	var $datecheckedout		= null;	
	var $dateexpectedback	= null;	
	var $notes					= null;	
	var $checked_out_time	= null;	
	var $published				= null;
	var $params 				= null;	

	function Tableinventory_detail(& $db){	
	  $this->_table_prefix = '#__ep_';			
		parent::__construct($this->_table_prefix.'inventory', 'id', $db);		
	}
	function bind($array, $ignore = '')
	{	

		if (key_exists( 'params', $array ) && is_array( $array['params'] )) {
			$registry = new JRegistry();
			$registry->loadArray($array['params']);
			$array['params'] = $registry->toString();
		}
		return parent::bind($array, $ignore);
	}	
}
?>
