<?php


defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class Tableassettype_detail extends JTable
{

	var $id = 0;

	var $description = null;
	var $notes = null;	
		

	function Tableassettype_detail(& $db){	
		//initialize class property
	  $this->_table_prefix = '#__ep_';
			
		parent::__construct($this->_table_prefix.'asset_type', 'id', $db);		
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
	function check()
	{	
		if (trim($this->id) == '') {
			$this->_error = JText::_('Id must have a value.');
			return false;
		}
		if (trim($this->model) == '') {
			$this->_error = JText::_('Description must have a value.');
			return false;
		}
		
		/** check for existing part */
		$query = 'SELECT id FROM '.$this->_table_prefix.'asset_type  WHERE description = "'.$this->description.'"';
		$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
		if($row = mysql_fetch_object($result)){
			$Description = $row->description;
			if ($Description == $this->description) {
				$this->_error = JText::_('Duplicate Description -'. $Description);
				return false;
			}
		}
		return true;
	}
	
}
?>
