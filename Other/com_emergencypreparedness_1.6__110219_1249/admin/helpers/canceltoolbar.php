<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.toolbar');
class EmergencypreparednesscancelHelperToolbar extends JObject
{        
	function getToolbar() { 		
		$bar = new JToolBar( 'Cancel' );
		$bar->appendButton( 'Standard', 'cancel', 'Cancel', 'cancel', false );
		$bar->appendButton( 'Separator' ); 
   	return $bar->render(); 
   } 
 }
?>