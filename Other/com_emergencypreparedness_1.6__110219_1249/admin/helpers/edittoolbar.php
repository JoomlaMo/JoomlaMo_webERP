<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.toolbar');
class EmergencypreparednesseditHelperToolbar extends JObject
{        
	function getToolbar() { 
		$bar = new JToolBar( 'AddEdit' );
		$bar->appendButton( 'Standard', 'save', 'Save Record', 'save', false );
		$bar->appendButton( 'Separator' );
		$bar->appendButton( 'Standard', 'cancel', 'Cancel', 'cancel', false ); 
   	return $bar->render(); 
   } 
 }
?>