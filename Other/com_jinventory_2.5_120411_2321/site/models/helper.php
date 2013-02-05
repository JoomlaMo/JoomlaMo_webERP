<?php
jimport( 'joomla.application.component.model');	
jimport( 'joomla.application.application' );
class modelData extends JModel
{
	function setErrorMessage($errorMessage){
		$app =& JFactory::getApplication();
		// echo gettype($errorMessage)  . "=gettype(errorMessage)<br>";
		If(gettype($errorMessage) <> 'array'){
			$app->enqueueMessage(JText::_($errorMessage));
			echo $errorMessage  . "=errorMessage<br>";
		}
		Foreach($errorMessage as $count=>$message){
				$app->enqueueMessage(JText::_($message));
		}
		return;
	}
	function getResult($query,$database,$errorMessage,$publicMessage=1){
		global $weberp;
		If($UserArray = JFactory::getUser()->groups){
			$UserType = JFactory::getUser()->groups["Super Users"];
		}else{
			$UserType = 0;
		}
		$error = array();
		If($database == 'Joomla'){
			$dbj 		=& JFactory::getDBO();
			$dbj->setQuery($query);
			If(!$Value = $dbj->loadResult()){
				if($UserType == 8 AND $weberp['debug'] > 0){
					array_push($error,  '<br>' . $dbj->getErrorMsg());
					array_push($error, '<br>' . $query);
					If($publicMessage==0){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Get Result Error<br><span style='color:brown'><hr></span>");
					}
				}
				if($UserType == 8 OR strlen(trim($errorMessage)) > 0){
					If($publicMessage==1){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Get Result Error<br><span style='color:brown'><hr></span>");
					}
					modelData::setErrorMessage($error);
				}
				return FALSE;
			}else{
				return $Value;
			}
		}elseif($database == 'webERP'){
			If(gettype($weberp) <> 'array' OR !array_key_exists('database', $weberp)){
				$weberp	= modelData::getwebERP();
			}
			$dbw 		=& JFactory::getDBO();
			$dbw 		=& JDatabase::getInstance( $weberp );
			If(isset($dbw->message) AND substr($dbw->message,0,17) == 'Unable to connect'){				
				array_push($error, '<br>Error Code-H' .  __LINE__  . ' Trying to connect to webERP database.  Check Host, Username, and Password in CARTwebERP parameters<br><span style="color:brown"><hr></span>');			
				array_push($error, $dbw->message);
				modelData::setErrorMessage($error);
				return FALSE;
			}
			$dbw->setQuery($query);
			If(!$Value = $dbw->loadResult()){
				if($UserType == 8 AND $weberp['debug'] > 0){
					array_push($error,  '<br>' . $dbw->getErrorMsg());
					array_push($error, '<br>' . $query);
					If($publicMessage==0){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Get Result Error<br><span style='color:brown'><hr></span>");
					}
				}
				if($UserType == 8 OR strlen(trim($errorMessage)) > 0){
					If($publicMessage==1){
						array_push($error,  '<br>' . $errorMessage . '<br>' );
					}
					modelData::setErrorMessage($error);
				}
				return FALSE;
			}else{
				return $Value;
			}
		}
	}
	function getRowArray($query,$database,$errorMessage,$index=NULL,$publicMessage=1){
		global $weberp;
		If($UserArray = JFactory::getUser()->groups){
			$UserType = JFactory::getUser()->groups["Super Users"];
		}else{
			$UserType = 0;
		}
		$error = array();
		If($database == 'Joomla'){
			$dbj 		=& JFactory::getDBO();
			$dbj->setQuery($query);
			If(!$RowArray = $dbj->loadAssoc()){
				if($UserType == 8 AND $weberp['debug'] > 0){
					array_push($error,  '<br>' . $dbj->getErrorMsg());
					array_push($error, '<br>' . $query);
					If($publicMessage==0){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Get Row Array Error<br><span style='color:brown'><hr></span>");
					}
				}
				if($UserType == 8 OR strlen(trim($errorMessage)) > 0){
					If($publicMessage==1){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Get Row Array Error<br><span style='color:brown'><hr></span>");
					}
					modelData::setErrorMessage($error);
				}
				return FALSE;
			}else{
				return $RowArray;
			}
		}elseif($database == 'webERP'){			
			If(gettype($weberp) <> 'array' OR !array_key_exists('database', $weberp)){
				$weberp	= modelData::getwebERP();
			}
			$dbw 		=& JFactory::getDBO();
			$dbw = & JDatabase::getInstance( $weberp );
			If(isset($dbw->message) AND substr($dbw->message,0,17) == 'Unable to connect'){	
				array_push($error,$errorMessage);			
				array_push($error, '<br>Error Code-H' .  __LINE__  . ' Trying to connect to webERP database.  Check Host, Username, and Password in CARTwebERP parameters');			
				array_push($error, '<br>' . $dbw->message . '<br>' );
				modelData::setErrorMessage($error);
				return FALSE;
			}
			$dbw->setQuery($query);
			If(!$RowArray = $dbw->loadAssoc()){
				if($UserType == 8 AND $weberp['debug'] > 0){
					array_push($error,  '<br>' . $dbw->getErrorMsg());
					array_push($error, '<br>' . $query);
					If($publicMessage==0){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Get Row Array Error<br><span style='color:brown'><hr></span>");
					}
				}
				if($UserType == 8 OR strlen(trim($errorMessage)) > 0){
					If($publicMessage==1){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Get Row Array Error<br><span style='color:brown'><hr></span>");
					}
					modelData::setErrorMessage($error);
				}
				return FALSE;
			}else{
				return $RowArray;
			}
		}
	}
	function getCollumnArray($query,$database,$errorMessage,$publicMessage=1){
		global $weberp;		
		If($UserArray = JFactory::getUser()->groups){
			$UserType = JFactory::getUser()->groups["Super Users"];
		}else{
			$UserType = 0;
		}
		$error = array();
		If($database == 'Joomla'){
			$dbj 		=& JFactory::getDBO();
			$dbj->setQuery($query);
			If(!$CollumnArray = $dbj->loadResultArray()){
				if($UserType == 8 AND $weberp['debug'] > 0){
					array_push($error,  '<br>' . $dbj->getErrorMsg());
					array_push($error, '<br>' . $query);
					If($publicMessage==0){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Get Collumn Array Error<br><span style='color:brown'><hr></span>");
					}
				}
				if($UserType == 8 OR strlen(trim($errorMessage)) > 0){
					If($publicMessage==1){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Get Collumn Array Error<br><span style='color:brown'><hr></span>");
					}
					modelData::setErrorMessage($error);
				}
				return FALSE;
			}else{
				return $CollumnArray;
			}
		}elseif($database == 'webERP'){		
			If(gettype($weberp) <> 'array' OR !array_key_exists('database', $weberp)){
				$weberp	= modelData::getwebERP();
			}
			$dbw 		=& JFactory::getDBO();
			$dbw = & JDatabase::getInstance( $weberp );
			If(isset($dbw->message) AND substr($dbw->message,0,17) == 'Unable to connect'){				
				array_push($error, '<br>Error Code-H' .  __LINE__  . ' Trying to connect to webERP database.  Check Host, Username, and Password in CARTwebERP parameters');			
				array_push($error, '<br>' . $dbw->message . '<br>');
				modelData::setErrorMessage($error);
				return FALSE;
			}
			$dbw->setQuery($query);
			If(!$CollumnArray = $dbw->loadResultArray()){
				if($UserType == 8 AND $weberp['debug'] > 0){
					array_push($error,  '<br>' . $dbw->getErrorMsg());
					array_push($error, '<br>' . $query);
					If($publicMessage==0){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Get Collumn Array Error<br><span style='color:brown'><hr></span>");
					}
				}
				if($UserType == 8 OR strlen(trim($errorMessage)) > 0){
					If($publicMessage==1){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Get Collumn Array Error<br><span style='color:brown'><hr></span>");
					}
					modelData::setErrorMessage($error);
				}
				return FALSE;
			}else{
				return $CollumnArray;
			}
		}
	}
	function getRowList($query,$database,$errorMessage,$index=NULL,$publicMessage=1){
		global $weberp;
		If($UserArray = JFactory::getUser()->groups){
			$UserType = JFactory::getUser()->groups["Super Users"];
		}else{
			$UserType = 0;
		}
		$error = array();
		If($database == 'Joomla'){
			$dbj 		=& JFactory::getDBO();
			$dbj->setQuery($query);
			If(!$RowArray = $dbj->loadAssocList($index)){
				if($UserType == 8 AND $weberp['debug'] > 0){
					array_push($error,  '<br>' . $dbj->getErrorMsg());
					array_push($error, '<br>' . $query);
					If($publicMessage==0){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Get Row List Error<br><span style='color:brown'><hr></span>");
					}
				}
				if(strlen(trim($errorMessage)) > 0){
					If($publicMessage==1){
						array_push($error,  '<br>' . $errorMessage . '<br>');
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Get Row List Error<br><span style='color:brown'><hr></span>");
					}
					// echo gettype($error)  . "=gettype(error)<br>";
					modelData::setErrorMessage($error);
				}
				return FALSE;
			}else{
				return $RowArray;
			}
		}elseif($database == 'webERP'){		
			If(gettype($weberp) <> 'array' OR !array_key_exists('database', $weberp)){
				$weberp	= modelData::getwebERP();        
			}
			$dbw 		=& JFactory::getDBO();
			If(isset($dbw->message) AND substr($dbw->message,0,17) == 'Unable to connect'){				
				array_push($error, '<br>Error Code-H' .  __LINE__  . ' Trying to connect to webERP database.  Check Host, Username, and Password in CARTwebERP parameters');			
				array_push($error, $dbw->message);
				modelData::setErrorMessage($error);
				If($publicMessage==0){
					array_push($error,  '<br>' . $errorMessage . '<br>');
				}
				return FALSE;
			}			
			$dbw 		=& JDatabase::getInstance( $weberp );
			If(isset($dbw->message) AND substr($dbw->message,0,17) == 'Unable to connect'){				
				array_push($error, '<br>Error Code-H' .  __LINE__  . ' Trying to connect to webERP database.  Check Host, Username, and Password in CARTwebERP parameters');			
				array_push($error, $dbw->message);
				modelData::setErrorMessage($error);
				If($publicMessage==0){
					array_push($error,  '<b1128r>' . $errorMessage . '<br>');
				}
				return FALSE;
			}
			$dbw->setQuery($query);
			If(!$RowArray = $dbw->loadAssocList($index)){
				if($UserType == 8 AND $weberp['debug'] > 0){
					array_push($error,  '<br>' . $dbw->getErrorMsg());
					array_push($error, '<br>' . $query);
					If($publicMessage==0){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Get Row List Error<br><span style='color:brown'><hr></span>");
					}
				}
				if($UserType == 8 OR strlen(trim($errorMessage)) > 0){
					If($publicMessage==1){
						array_push($error,  '<br>' . $errorMessage );
						array_push($error, '<br>Error Code-H' .  __LINE__  . ' Get Row List Error<br><span style="color:brown"><hr></span>');
					}
					modelData::setErrorMessage($error);
				}
				return FALSE;
			}else{
				return $RowArray;
			}
		}
	}
	function getInsertUpdate($query,$database,$errorMessage,$publicMessage=1){
		global $weberp;
		If($UserArray = JFactory::getUser()->groups){
			$UserType = JFactory::getUser()->groups["Super Users"];
		}else{
			$UserType = 0;
		}
		$error = array();
		If($database == 'Joomla'){
			$dbj 		=& JFactory::getDBO();
			$dbj->setQuery($query);
			If(!$Result = $dbj->query()){
				if($UserType == 8 AND $weberp['debug'] > 0){
					array_push($error,  '<br>' . $dbj->getErrorMsg());
					If($publicMessage==0){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Insert/Update Error<br><span style='color:brown'><hr></span>");
					}
					array_push($error, '<br>' . $query);
				}				
				if(strlen(trim($errorMessage)) > 0){
					If($publicMessage==1){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Insert/Update Error<br><span style='color:brown'><hr></span>");
					}
					modelData::setErrorMessage($error);
				}
				return FALSE;
			}else{
				return TRUE;
			}
		}elseif($database == 'webERP'){		
			If(gettype($weberp) <> 'array' OR !array_key_exists('database', $weberp)){
				$weberp	= modelData::getwebERP();
			}
			$dbw 		=& JFactory::getDBO();
			$dbw = & JDatabase::getInstance( $weberp );
			If(isset($dbw->message) AND substr($dbw->message,0,17) == 'Unable to connect'){
					If($publicMessage==0){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "Error Code-H" .  __LINE__  . " Insert/Update Error<br><span style='color:brown'><hr></span>");
					}
				array_push($error, 'Error Code-H' .  __LINE__  . ' Trying to connect to webERP database.  Check Host, Username, and Password in CARTwebERP parameters');			
				array_push($error, $dbw->message);
				modelData::setErrorMessage($error);
				return FALSE;
			}
			$dbw->setQuery($query);
			If(!$Result = $dbw->query()){
				if($UserType == 8 AND $weberp['debug'] > 0){
					array_push($error,  '<br>' . $dbw->getErrorMsg());
					array_push($error, '<br>' . $query);
				}
				if(strlen(trim($errorMessage)) > 0){
					If($publicMessage==1){
						array_push($error,  '<br>' . $errorMessage);
					}
					array_push($error, "Insert/Update Error");
					modelData::setErrorMessage($error);
				}
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}
	function getDelete($query,$database,$errorMessage,$publicMessage=1){
	global $weberp;
	If($UserArray = JFactory::getUser()->groups){
		$UserType = JFactory::getUser()->groups["Super Users"];
	}else{
		$UserType = 0;
	}
	$error = array();
		If($database == 'Joomla'){
			$dbj 		=& JFactory::getDBO();
			$dbj->setQuery($query);
			If(!$Result = $dbj->query()){
				if($UserType == 8 AND $weberp['debug'] > 0){
					array_push($error,  '<br>' . $dbj->getErrorMsg());
					If($publicMessage==0){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Insert/Update Error<br><span style='color:brown'><hr></span>");
					}
					array_push($error, '<br>' . $query);
				}				
				if(strlen(trim($errorMessage)) > 0){
					If($publicMessage==1){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "<br>Error Code-H" .  __LINE__  . " Insert/Update Error<br><span style='color:brown'><hr></span>");
					}
					modelData::setErrorMessage($error);
				}
				return FALSE;
			}else{
				return TRUE;
			}
		}elseif($database == 'webERP'){		
			If(gettype($weberp) <> 'array' OR !array_key_exists('database', $weberp)){
				$weberp	= modelData::getwebERP();
			}
			$dbw 		=& JFactory::getDBO();
			$dbw = & JDatabase::getInstance( $weberp );
			If(isset($dbw->message) AND substr($dbw->message,0,17) == 'Unable to connect'){
					If($publicMessage==0){
						array_push($error,  '<br>' . $errorMessage);
						array_push($error, "Error Code-H" .  __LINE__  . " Insert/Update Error<br><span style='color:brown'><hr></span>");
					}
				array_push($error, 'Error Code-H' .  __LINE__  . ' Trying to connect to webERP database.  Check Host, Username, and Password in CARTwebERP parameters');			
				array_push($error, $dbw->message);
				modelData::setErrorMessage($error);
				return FALSE;
			}
			$dbw->setQuery($query);
			If(!$Result = $dbw->query()){
				if($UserType == 8 AND $weberp['debug'] > 0){
					array_push($error,  '<br>' . $dbw->getErrorMsg());
					array_push($error, '<br>' . $query);
				}
				if(strlen(trim($errorMessage)) > 0){
					If($publicMessage==1){
						array_push($error,  '<br>' . $errorMessage);
					}
					array_push($error, "Insert/Update Error");
					modelData::setErrorMessage($error);
				}
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}
}
?>