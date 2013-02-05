<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');
class emergencypreparednessModelinventory_detail extends JModel
{
	var $_id = null;
	var $_data = null;
	var $_table_prefix = null;	
	function __construct()
	{
		parent::__construct();
	  	$this->_table_prefix = '#__ep_';		
		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}
	function setId($id)
	{
		$this->_id		= $id;
		$this->_data	= null;
	}
	function &getData()
	{
		if (!$this->_loadData())
		{  
			$this->_initData();
		}
   	return $this->_data;
	}
	function checkout($uid = null)
	{
		if ($this->_id)
		{
			if (is_null($uid)) {
				$user	=& JFactory::getUser();
				$uid	= $user->get('id');
			}
			$inventory_detail = & $this->getTable();			
			if(!$inventory_detail->checkout($uid, $this->_id)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			return true;
		}
		return false;
	}
	function checkin()
	{
		if ($this->_id)
		{
			$inventory_detail = & $this->getTable();
			if(! $inventory_detail->checkin($this->_id)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return false;
	}			
	function _loadData()
	{	
		$query = 'SELECT * FROM '.$this->_table_prefix.'inventory 
 									WHERE id = '. $this->_id;
		$this->_db->setQuery($query);
		$this->_data = $this->_db->loadObject();
		return (boolean) $this->_data;
	}
	function _initData()
	{
		if (empty($this->_data))
		{
			$detail = new stdClass();
			$detail->id						= 0;
			$detail->description			= null;
			$detail->asset_type			= 0;
			$detail->location				= 0;
			$detail->lastlocation		= null;		
			$detail->athome				= null;		
			$detail->dateinservice		= null;
			$detail->datecheckedout		= null;	
			$detail->dateexpectedback	= null;	
			$detail->notes					= null;	
			$checked_out_time				= null;	
			$detail->published			= null;					
			$this->_data				 	= $detail;
			return (boolean) $this->_data;
		}
		return true;
	}  	
	function store($data)
	{		
		global $mainframe;
		$post	= JRequest::get('post'); 
		$db = &JFactory::getDBO();
		If(isset($post["location"]) and $post['location'] <> 0){
			$mainframe->setUserState('LocationFilter',$post["location"]);
		}elseIf(isset($post["LocationFilter"])){
			$mainframe->setUserState('LocationFilter',$post["LocationFilter"]);
		}
		If(strlen(trim($post['description'])) == 0){
			JError::raiseWarning(500, 'No Record Created. Please enter a description.');	
			return false;
		}
		If($post['location'] == 0){
			JError::raiseWarning(500, 'No Record Created. Please choose a location.');
			return false;
		}
		$row =& $this->getTable();
		if (!$row->bind($data)) {
			return false;
		}
		if (!$row->store()) {
			return false;
		}
	  	$this->_table_prefix = '#__ep_';
		If(!isset($post['id']) OR $post['id']==0){
			// echo $db->insertid();exit;
			// $query = "SELECT MAX(id) FROM " .$this->_table_prefix . 'inventory';
			// $db->setQuery($query);
			$InventoryID = $db->insertid();
		}else{
			$InventoryID = $post['id'];		
		}		
	  	$Specifications = $this->getSpecifications($InventoryID);
	  	// $this->var_dump_pre($Specifications);echo "<br><br><br><br><br>";
		// $this->var_dump_pre($post);echo "<br><br><br><br><br>";exit;		
		Foreach($post['KeywordInput'] as $keywordid=>$value){
			// echo $keywordid . "=keywordid<br>";
			if (!isset($Specifications[$InventoryID]) OR !array_key_exists($keywordid,$Specifications[$InventoryID])) {
				$query = "INSERT INTO ".$this->_table_prefix."specifications 
										SET 	inventory_id="	. $InventoryID . ",
												asset_type 	=" . $post['asset_type'] . ",
												keyword_id 	="	. $keywordid . ",
												value       ='". $value . "'";
				// echo "Insert " . 	$keywordid . "=keywordid<br>";											
			}else{
				$query = "UPDATE ".$this->_table_prefix."specifications 
										SET 	value       ='". $value . "'
									 WHERE	inventory_id="	. $InventoryID . " AND
									 			keyword_id 	="	. $keywordid;
				// echo "Update " . 	$keywordid . "=keywordid<br>";			
			}
			$db->setQuery($query);
			$result = $db->query();
		}
		// exit;
		return true;
	}
	
	function delete($cid = array())
	{
		$result = false;
		if (count( $cid ))
		{
			$cids = implode( ',', $cid );
			$query = 'DELETE FROM '.$this->_table_prefix.'inventory WHERE id IN ( '.$cids.' )';
			$this->_db->setQuery( $query );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			$query = 'DELETE FROM '.$this->_table_prefix.'specifications WHERE inventory_id IN ( '.$cids.' )';
			$this->_db->setQuery( $query );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return true;
	}
	function getAssetType(){
		
		global $mainframe;
		$post	= JRequest::get('post');
		// if we have a new asset the id is $post['']
		// echo $mainframe->getUserState('formpost.asset_type') . "=mainframe->getUserState('formpost.asset_type')<br>";
		If(array_key_exists('ID', $post)){
			// if this is a new entry get id from post
			Foreach($post['ID'] as $id=>$AssetType){
				// echo $id . "=id 175 model<br>";
				$AssetTypeID = $id;
				// echo $AssetTypeID . "=AssetTypeID as a new asset entry 177 Model<br>";
			}
			// IF WE ARE COMING BACK TO THE FORM AFTER AN ERROR THEN THE ASSET TYPE IS IN THE SESSION VARIABLE.
		}elseif($mainframe->getUserState('formpost') AND  $mainframe->getUserState('formpost.asset_type') AND strlen(trim($mainframe->getUserState('formpost.asset_type'))) > 0){
			// New Asset type was just entered
			$AssetTypeID = $mainframe->getUserState('formpost.asset_type');
			// echo $AssetTypeID . "=AssetTypeID from Sessionformpost going back to fix error model 183<br>";
		}elseif($mainframe->getUserState('GID')){
			$AssetTypeID = $mainframe->getUserState('GID');
		}else{			
			// if this is an edit get id this->data
			$AssetTypeID = $this->_data->asset_type;
			// echo $AssetTypeID . "=AssetTypeID from edit selection Model 189<br>";
		} 
		$db = &JFactory::getDBO();
		If(!isset($AssetTypeID) OR $AssetTypeID==0 ){
			// $query = "SELECT MAX(id) FROM " .$this->_table_prefix . 'asset_type';
			// $db->setQuery($query);
			$AssetTypeID = $db->insertid();	
		}
		$this->_table_prefix = '#__ep_';
		$db->setQuery( ' SELECT * FROM '.$this->_table_prefix.'asset_type 
										 WHERE id =' . $AssetTypeID );	                 
		$AssetType =& $db->loadAssoc();
	  	return $AssetType;
	}
	function getAssetDescriptions(){
		$post	= JRequest::get('post');
		$db = &JFactory::getDBO();
		$this->_table_prefix = '#__ep_';
		$query = ' SELECT description FROM '.$this->_table_prefix.'asset_type';
		$db->setQuery($query);	                 
		$AssetDescriptions =& $db->loadResultArray();
		return $AssetDescriptions;
	}
	function getLocations(){	
		$db = &JFactory::getDBO();
		$this->_table_prefix = '#__ep_';
		$db->setQuery( ' SELECT * FROM '.$this->_table_prefix.'locations 
									 ORDER BY description');	                 
		$rows = $db->loadObjectList();
		$Locations = array();
  		foreach ( $rows as $row ) {
    		$id 	= $row->id;
    		$Locations['description'][$id]		= $row->description;
    	}
	  	return $Locations;
	}	
	function getKeywords($AssetTypeID){	
		$db = &JFactory::getDBO();
		$this->_table_prefix = '#__ep_';
		$query = ' SELECT * FROM '.$this->_table_prefix.'keyword 
										 WHERE asset_type = ' . $AssetTypeID . ' 
									 ORDER BY description';		 
		$db->setQuery( $query);	                 
		$rows = $db->loadObjectList();
		$Keywords = array();		
		If(count($rows) > 0){
	  		foreach ( $rows as $row ) {
	    		$ID				= $row->id;
	    		$Keywords['KeywordDescription'][$ID]	= $row->description;
	    		$Keywords['notes'][$ID]			= $row->notes;
	    	}
    	}
	  	return $Keywords;
	}
	function getSpecifications($InventoryID){	
		$db = &JFactory::getDBO();
		$this->_table_prefix = '#__ep_';
		$post	= JRequest::get('post');
		$db->setQuery( ' SELECT * FROM '.$this->_table_prefix.'specifications 
										 WHERE inventory_id = ' . $InventoryID);	                 
		$rows = $db->loadAssocList();
		$Specifications = array();
  		foreach ( $rows as $row ) {
    		$ID												= $row['inventory_id'];
    		$Specifications[$ID][$row['keyword_id']]	= $row['value'];
    		$Specifications[$ID]['SpecificationID']= $row['id'];
    	}
	  	return $Specifications;
	}
	function saveassettyperecord()
	{
			
		$post	= JRequest::get('post');	
		$GID = '';
		$AssetDescriptions = $this->getAssetDescriptions();
		$UpperAssetDescription=array();
		If(count($AssetDescriptions ) > 0){
			Foreach($AssetDescriptions as $id=>$description){
				$UpperAssetDescription[$id] = strtoupper($description);
			}	
		}
		If(isset($UpperAssetDescription) AND strlen(trim($post['assetdescription'])) > 0 AND 
			!in_array(strtoupper($post['assetdescription']),$UpperAssetDescription)){
			$data['id']				=	0;
			$data['description'] = 	$post['assetdescription'];
			$data['notes']			=	$post['notes'];
			$GID = '';
			// echo "storing assettype model 268<br>";
			if ($GID = $this->storeassettype($data)) {
				$msg = JText::_( 'Asset Type Saved' );
			} else {
				$msg = JText::_( 'Error Saving Asset Type' . $this->_error);
			}
		}
		// echo $GID . "=GID in model saveassettyperecord model 275<br>";
		return $GID;
	}
	function storeassettype($data)
	{				
		JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_emergencypreparedness'.DS.'tables');
		$row =& JTable::getInstance('assettype_detail', 'Table'); 
		$db = &JFactory::getDBO();
		if (!$row->bind($data)) {
			echo $this->_db->getErrorMsg();exit;
			return false;
		}
		if (!$row->store()) {
			echo $this->_db->getErrorMsg();exit;
			return false;
		}		
		// $query = "SELECT MAX(id) FROM " .$this->_table_prefix . 'asset_type';
		// $db->setQuery($query);
		$GID = $db->insertid();
		// $GID = mysql_insert_id();
		// echo $GID . "=GID in model storeassettype model 291<br>";
		return $GID;
	}
	function savekeywordrecord($GID)
	{				
		// echo $GID . "=GID in Model savekeywordrecord now going to check for Post['ID'] to override model 296<br>";
		$post	= JRequest::get('post');		
		If(array_key_exists('ID', $post)){
			// if this is a new entry get id from post
			foreach($post['ID'] as $key=>$value){
				$AssetTypeID =$key ;
			}
		}elseif(isset($GID)){
			$AssetTypeID = $GID ;
		}
		$db = &JFactory::getDBO();
		If(!isset($AssetTypeID) OR $AssetTypeID==0 ){
			// $query = "SELECT MAX(id) FROM " .$this->_table_prefix . 'asset_type';
			// $db->setQuery($query);
			$AssetTypeID = $db->insertid();		
		}
		// echo $AssetTypeID . "=AssetTypeID in Model savekeywordrecord now going to store keywords It WORKED! model 306<br>";
		$KeywordData = emergencypreparednessModelinventory_detail::getKeywords($AssetTypeID);
		// convert array to upper case to be sure we do not enter a keyword twice.
		If(count($KeywordData) > 0){
			Foreach($KeywordData['KeywordDescription'] as $id=>$value){
				$UpperDescription[$id] = strtoupper($value);
			}
		}else{
			$UpperDescription = array();
		}
		for ($i = 1; $i <= 4; $i++) {			
			If(strlen(trim($post['NewKeyword'][$i])) > 0){
				$keyworddata['id']				=	0;
				$keyworddata['asset_type'] 	= 	$AssetTypeID;
				$keyworddata['description'] 	= 	$post['NewKeyword'][$i];
				If(count($UpperDescription)==0 OR !in_array(strtoupper($keyworddata['description']),$UpperDescription)){
					If(isset($post['typeofdata'][$i])){
						$keyworddata['typeofdata'] = 	"N";
					}else{
						$keyworddata['typeofdata'] = 	"A";
					}
					$keyworddata['notes']			=	$post['newnotes'][$i];
					if ($this->storekeyword($keyworddata)) {
						$msg = JText::_( 'Keyword Saved' );
					} else {
						$msg = JText::_( 'Error Saving Keyword' . $this->_error);
					}
				}
			}
		}
		return true;
	}	
	function storekeyword($data)
	{		
		JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_emergencypreparedness'.DS.'tables');
		$row =& JTable::getInstance('keyword_detail', 'Table'); 
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		return true;
	}
	function saveinventory()
	{	
		global $mainframe;
		$post	= JRequest::get('post');
		// set session location filter to stay on one location while entering	
		If(isset($post['LocationFilter'])){
			$mainframe->setUserState('LocationFilter',$post['location']);
		}
		// $this->var_dump_pre($post);
		if ($this->store($post)) {
			$msg = JText::_( 'Inventory Saved' );
			return true;
		} else {
			$mainframe->setUserState('formpost', $post);
			return false;
		}
		$this->checkin();
	}
	function var_dump_pre($mixed = null) {
  		echo '<pre>';
  		var_dump($mixed);
  		echo '</pre>';
  		return null;
	}
}

?>
