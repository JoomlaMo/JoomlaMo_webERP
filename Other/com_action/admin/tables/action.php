<?php

defined('_JEXEC') or die('=;)');

class TableAction extends JTable
{

	var $id = null;
	var $Date  = null;
	var $Time  = null;
	var $Done  = null;
	var $DoneTime  = null;
	var $Notes  = null;
	var $PersonID  = 0;
	var $DocumentNumber  = null;
	var $JobID  = 0;
	var $ProcessID  = 0;
	var $StartTime  = null;
	var $StartDate  = null;
	var $DueTime  = null;
	var $DueDate  = null;
	var $Complete  = null;
	var $Thread  = 0;
	var $CompletedBy  = null;

    function TableAction(& $db)
    {
        parent::__construct('#__action', 'id', $db);
    }

}
