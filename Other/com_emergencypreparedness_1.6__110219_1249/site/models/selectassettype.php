<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');
class emergencypreparednessModelselectassettype extends JModel
{
	var $_data = null;
	var $_total = null;
	var $_table_prefix = null;
	function __construct()	{
		parent::__construct();
		global $mainframe, $context;
	  	$this->_table_prefix = '#__ep_';			
	}	
	function getData()
	{
		if (empty($this->_data))
		{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList($query);
		}
		return $this->_data;
	}		
	function _buildQuery()
	{		
		$post	= JRequest::get('post');
		$this->_table_prefix = '#__ep_';
		$Where="";
		If(array_key_exists('Filter',$post) AND $post['Filter'] <> 'ALL'){
			$Where=" WHERE description LIKE '%" . $post['Filter'] . "%'" ;
		}
		$query = ' SELECT * FROM '.$this->_table_prefix.'asset_type ' . $Where . ' ORDER BY description' ;
		return $query;
	}	
}	
?>

