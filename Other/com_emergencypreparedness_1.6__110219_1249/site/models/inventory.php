<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');
class emergencypreparednessModelinventory extends JModel
{
	var $_data = null;
	var $_total = null;
	var $_pagination = null;
	var $_table_prefix = null;
	function __construct()	{
		parent::__construct();
		global $mainframe, $context;
	  	$this->_table_prefix = '#__ep_';			
		$limit		= $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 0);
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0 );
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}	
	function getData()
	{
		if (empty($this->_data))
		{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
		}
		return $this->_data;
	}
	function getTotal()
	{
		if (empty($this->_total))
		{
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);
		}
		return $this->_total;
	}	
	function getPagination()
	{
		global $totalitems;
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $totalitems, $this->getState('limitstart'), $this->getState('limit') );
		}
		return $this->_pagination;
	}  	
	function _buildQuery()
	{		
		global $mainframe;
		$post	= JRequest::get('post');
		$this->_table_prefix = '#__ep_';
		$Where="";
		If(isset($post["LocationFilter"])){
			$LocationFilter = $post["LocationFilter"];
			$mainframe->setUserState( "LocationFilter",$post["LocationFilter"]) ;
		}elseif($mainframe->getUserState('LocationFilter')){
			$LocationFilter = $mainframe->getUserState('LocationFilter');
		}
		If($mainframe->getUserState('LocationFilter') AND $mainframe->getUserState('LocationFilter') <> 'ALL'){
			$Where=" WHERE location=" . $mainframe->getUserState('LocationFilter');
		}
		$query = ' SELECT * FROM '.$this->_table_prefix.'inventory ' . $Where. ' order by asset_type' ;
		return $query;
	}
	function getAssetTypes(){	
		$db = &JFactory::getDBO();
		$this->_table_prefix = '#__ep_';
		$db->setQuery( ' SELECT * FROM '.$this->_table_prefix.'asset_type ORDER BY description');	                 
		$rows = $db->loadObjectList();
		$AssetTypes=array();
  		foreach ( $rows as $row ) {
    		$id 	= $row->id;
    		$AssetTypes['description'][$id]= $row->description;
    	}
	  	return $AssetTypes;
	}
	function getLocations(){	
		$db = &JFactory::getDBO();
		$this->_table_prefix = '#__ep_';
		$db->setQuery( ' SELECT * FROM '.$this->_table_prefix.'locations ORDER BY description');	                 
		$rows = $db->loadObjectList();
		$Locations=array();
  		foreach ( $rows as $row ) {
    		$id 	= $row->id;
    		$Locations['description'][$id]		= $row->description;
    	}
	  	return $Locations;
	}	
	function getKeywords(){	
		$db = &JFactory::getDBO();
		$this->_table_prefix = '#__ep_';
		$db->setQuery( ' SELECT * FROM '.$this->_table_prefix.'keyword ORDER BY description');	                 
		$rows = $db->loadObjectList();
		$Keywords = array();
  		foreach ( $rows as $row ) {
    		$id 	= $row->id;
    		$Keywords[$id]['assettype'] 		= $row->asset_type;
    		$Keywords[$id]['description']	= $row->description;
    		$Keywords[$id]['notes']			= $row->notes;
    	}
	  	return $Keywords;
	}
	function getSpecifications(){	
		$db = &JFactory::getDBO();
		$this->_table_prefix = '#__ep_';
		$db->setQuery( ' SELECT * FROM '.$this->_table_prefix.'specifications');	                 
		$rows = $db->loadObjectList();
		$Specifications = array();
  		foreach ( $rows as $row ) {
    		$InventoryId 										= $row->inventory_id;
    		$Specifications[$InventoryId]['assettype']= $row->asset_type;
    		$Specifications[$InventoryId]['keyword']	= $row->keyword_id;
    		$Specifications[$InventoryId]['value']		= $row->value;
    	}
	  	return $Specifications;
	}
}	
?>

