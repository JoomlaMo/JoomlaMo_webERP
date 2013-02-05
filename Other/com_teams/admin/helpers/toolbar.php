<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.toolbar');
class teamsHelperToolbar extends JObject
{        
	function getToolbar() { 
		$bar = new JToolBar( 'My Toolbar' );
		$bar->appendButton( 'Standard', 'new', 'New Record', 'new', false );
		$bar->appendButton( 'Separator' );
		$bar->appendButton( 'Standard', 'delete', 'Delete Record', 'delete', false ); 
		$bar->appendButton( 'Separator' );
		$bar->appendButton( 'Standard', 'edit', 'Edit Record', 'edit', false ); 
   	return $bar->render(); 
   } 
 }
?>