<?php

defined('_JEXEC') or die('=;)');

jimport('joomla.application.component.model');

class ActionsModelAction extends JModel
{
    function __construct()
    {
        parent::__construct();

        $array = JRequest::getVar('cid',  0, '', 'array');
        $this->setId((int)$array[0]);
    }
    function setId($id)
    {
        $this->_id = $id;
        $this->_data = null;
    }
    function &getData()
    {
        if(empty($this->_data))
        {
            $query = 'SELECT * FROM #__action'
                    . ' WHERE id = '.$this->_id;
            $this->_db->setQuery($query);
            $this->_data = $this->_db->loadObject();
        }

        if( ! $this->_data)
        {
            $this->_data = $this->getTable();
        }

        return $this->_data;
    }
    function store()
    {
        $row =& $this->getTable();

        $data = JRequest::get('post');

        if( ! $row->bind($data))
        {
            $this->setError($this->_db->getError());
            return false;
        }
        if( ! $row->check())
        {
            $this->setError($this->_db->getError());
            return false;
        }
        if( ! $row->store())
        {
            $this->setError($row->getError());
            return false;
        }

        return true;
    }
    function delete()
    {
        $cids = JRequest::getVar('cid', array(0), 'post', 'array');

        $row =& $this->getTable();

        if(count($cids))
        {
            foreach($cids as $cid)
            {
                if( ! $row->delete($cid))
                {
                    $this->setError($row->getError());
                    return false;
                }
            }
        }

        return true;
    }
}
