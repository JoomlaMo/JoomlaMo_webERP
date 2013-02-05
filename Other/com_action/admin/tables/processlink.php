<?php

defined('_JEXEC') or die('=;)');

class Tableprocesslink extends JTable
{
	var $db = null;
	var $id = 0;
	var $title = NULL;
	var $description = NULL;
	var $ordering = 0;
	var $published = 0;

	function __construct( &$_db )
	{
		parent::__construct( '#__action_processlink', 'id', $_db );
		$this->db = $_db;
	}
}
