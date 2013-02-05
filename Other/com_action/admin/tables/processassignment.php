<?php

defined('_JEXEC') or die('=;)');

class Tableprocessassignment extends JTable
{
	var $db = null;
	var $id = 0;
	var $title = NULL;
	var $PersonID = 0;
	var $ProcessID = 0;
	var $ordering = 0;
	var $published = 0;
	
	function __construct( &$_db )
	{
		parent::__construct( '#__action_processassignment', 'id', $_db );
		$this->db = $_db;
	}
}
