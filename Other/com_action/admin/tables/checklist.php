<?php

defined('_JEXEC') or die('=;)');

class Tablechecklist extends JTable
{
	var $db 						= null;
	var $id 						= 0;
	var $title 					= NULL;
	var $ProcessCheckListID = 0;
	var $Process 				= 0;
	var $Thread 				= 0;
	var $Checked 				= 'N';

	function __construct( &$_db )
	{
		parent::__construct( '#__action_checklist', 'id', $_db );
		$this->db = $_db;
	}

}
