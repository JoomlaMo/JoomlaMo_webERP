<?php

defined('_JEXEC') or die('=;)');
class Tableprecedent extends JTable
{
	var $db = null;
	var $id = 0;
	var $Precedent = NULL;
	var $Action = NULL;
	
	function __construct( &$_db )
	{
		parent::__construct( '#__action_precedent', 'id', $_db );
		$this->db = $_db;
	}
}
