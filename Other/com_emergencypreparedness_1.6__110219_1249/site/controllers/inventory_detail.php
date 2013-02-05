<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.controller' );
class emergencypreparednesscontrollerinventory_detail  extends JController
{
	function __construct( $default = array())
	{		
		global $GID, $mainframe;
		JRequest::setVar( 'view', 'inventory_detail' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar( 'hidemainmenu', 1);
		$post	= JRequest::get('post');
		If(isset($post['assetdescription']) AND strlen(trim($post['assetdescription'])) > 0 ){		
			$GID = $this->saveassettype();
		}
		// echo $GID . "=GID in construct controller now going to save keywords<br>";
		If(isset($post['NewKeyword'][1]) AND strlen(trim($post['NewKeyword'][1])) > 0){
			// if post['ID'] is set then there is no new asset and a button was pressed.
			// therefore $GID has no value because no new asset was created.
			If(isset($post['ID'])){
				foreach($post['ID'] as $key=>$value){
					$GID =$key ;
				}
				// echo $GID . "=GID in construct controller but got value from post variable<br>";				
			}
			$this->savekeyword($GID);
			$mainframe->setUserState('GID',$GID);
		}
		parent::__construct( $default );
		$this->registerTask( 'add'  , 	'edit' );
	}
	function save()
	{	
		$model = $this->getModel('inventory_detail');
		If($model->saveinventory()){		
			$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=inventory',$msg );
		}else{	
			// emergencypreparednessModelinventory_detail::var_dump_pre($mainframe->getUserState('formpost'));exit;
			// WE HAD AN ERROR IN THE FORM SO WE ARE GOING BACK TO FIX IT	
			$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=inventory_detail',$msg );
		}
	}
	function saveassettype()
	{	
		require_once(JPATH_COMPONENT.DS.'models'.DS.'inventory_detail.php');
		$model=new emergencypreparednessModelinventory_detail;
		// echo "in Controller going to store asset record<br>";
		$GID = $model->saveassettyperecord();
		// echo $GID . "=GID from control function to save assettype<br>";
		return $GID;
	}	
	function savekeyword($GID)
	{	
		require_once(JPATH_COMPONENT.DS.'models'.DS.'inventory_detail.php');
		$model=new emergencypreparednessModelinventory_detail;
		// echo $GID . "=GID in controller savekeyword function<br>";
		$model->savekeywordrecord($GID);
		return ;
		
	}
	function cancel()
	{
		$model = $this->getModel('inventory_detail');
		$model->checkin();
		$this->setRedirect( 'index.php?option=com_emergencypreparedness&controller=inventory' );
	}	
}
