<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');
class Tablekeyword_detail extends JTable
{
	var $id = 0;
	var $asset_type = null;
	var $description = null;
	var $typeofdata = null;
	var $notes = null;	
	var $params = null;

	function Tablekeyword_detail(& $db){
	  $this->_table_prefix = '#__ep_';			
		parent::__construct($this->_table_prefix.'keyword', 'id', $db);		
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
		if (trim($this->asset_type) == '') {
			$this->_error = JText::_('Asset type must have a value.');
			return false;
		}
		if (trim($this->description) == '') {
			$this->_error = JText::_('Description must have a value.');
			return false;
		}
		if (trim($this->typeofdata) == '') {
			$this->_error = JText::_('Type of Data must have a value.');
			return false;
		}
		/** check for existing part */
		$query = 'SELECT id FROM '.$this->_table_prefix.'keyword  WHERE id = "'.$this->id.'"';
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
