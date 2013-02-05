<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');
class Tablelocations_detail extends JTable
{
	var $id = 0;
	var $description = null;
	var $address = null;
	var $city = null;
	var $state = null;
	var $zip = null;
	var $notes = null;
	var $params = null;
	function Tablelocations_detail(& $db){	
	  $this->_table_prefix = '#__ep_';			
		parent::__construct($this->_table_prefix.'locations', 'id', $db);		
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
		if (trim($this->make) == '') {
			$this->_error = JText::_('Address must have a value.');
			return false;
		}
		if (trim($this->make) == '') {
			$this->_error = JText::_('City must have a value.');
			return false;
		}
		if (trim($this->make) == '') {
			$this->_error = JText::_('State must have a value.');
			return false;
		}
		if (trim($this->make) == '') {
			$this->_error = JText::_('Zip must have a value.');
			return false;
		}
		$query = 'SELECT id FROM '.$this->_table_prefix.'locations  WHERE id = "'.$this->id.'"';
		$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
		if($row = mysql_fetch_object($result)){
			$ID = $row->id;
			if ($ID == $this->id) {
				$this->_error = JText::_('Duplicate ID -'. $xpart);
				return false;
			}
		}
		return true;
	}
}
?>
