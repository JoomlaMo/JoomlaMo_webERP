<?php

defined('_JEXEC') or die('=;)');
class Tableprocess extends JTable
{
	var $db 					= null;
	var $id 					= 0;
	var $Process 			= NULL;
	var $Instruction 		= NULL;
	var $EstimatedTime 	= NULL;
	function __construct( &$_db )
	{
		parent::__construct( '#__action_process', 'id', $_db );
		$this->db = $_db;
	}
}
