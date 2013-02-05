<?php

defined('_JEXEC') or die('=;)');

class Tableprocesschecklist extends JTable
{
	var $db = null;
	var $id = 0;
	var $title = NULL;
	var $Process = 0;
	var $CheckDescription = NULL;

	function __construct( &$_db )
	{
		parent::__construct( '#__action_processchecklist', 'id', $_db );
		$this->db = $_db;
	}
}
