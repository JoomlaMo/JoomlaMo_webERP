<?php

defined('_JEXEC') or die('=;)');

class Tablejob extends JTable
{
	var $db = null;
	var $id = 0;
	var $title = NULL;
	var $ProcessCheckListID = NULL;
	var $Process = NULL;
	var $Thread = NULL;
	var $Checked = NULL;
	var $ordering = 0;
	var $published = 0;


	/**
	 * Constructor
	 *
	 * @param object $_db Database connector object
	 */
	function __construct( &$_db )
	{
		parent::__construct( '#__action_job', 'id', $_db );
		$this->db = $_db;
	}// function

}// class
