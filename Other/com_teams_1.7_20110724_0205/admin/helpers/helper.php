<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
class teamsHelper extends JObject
{	
	function getTeamNames()
    {
        $where = array();
        $user =& JFactory::getUser();
        $UserID = $user->id;
		  $where[] = " userid = $UserID ";
        $where =( count($where) ) ? ' WHERE ' . implode( ' AND ', $where ) : '';
        $orderby = '';

        #_ECR_MAT_FILTER_MODEL1_

        if (isset($this->filter_order) && ($this->filter_order) && ($this->filter_order_Dir))
        {
            $orderby 	= ' ORDER BY '. $this->filter_order .' '. $this->filter_order_Dir;
        }

        $query = ' SELECT TeamName,TeamID,TeamDescription'
        			. ' FROM #__team_teams'
        			. $where
        			. $orderby ;

		  $db 	= &JFactory::getDBO();
		  $db->setQuery($query);
		  $TeamNames =& $db->loadAssocList('TeamID');
        return $TeamNames;
    }
    function getLeagueNames()
    {
        $where = array();
        $user =& JFactory::getUser();
        $UserID = $user->id;
		  $where[] = " userid = $UserID ";
        $where =( count($where) ) ? ' WHERE ' . implode( ' AND ', $where ) : '';
        $orderby = '';

        #_ECR_MAT_FILTER_MODEL1_

        if (isset($this->filter_order) && ($this->filter_order) && ($this->filter_order_Dir))
        {
            $orderby 	= ' ORDER BY '. $this->filter_order .' '. $this->filter_order_Dir;
        }

        $query = ' SELECT LeagueName,LeagueID,LeagueDescription'
        			. ' FROM #__team_leagues'
        			. $where
        			. $orderby ;

		  $db 	= &JFactory::getDBO();
		  $db->setQuery($query);
		  $LeagueNames =& $db->loadAssocList('LeagueID');
        return $LeagueNames;
    }
    function getUniformDescriptions()
    {
        $where = array();
        $user =& JFactory::getUser();
        $UserID = $user->id;
		  $where[] = " userid = $UserID ";
        $where =( count($where) ) ? ' WHERE ' . implode( ' AND ', $where ) : '';
        $orderby = '';

        #_ECR_MAT_FILTER_MODEL1_

        if ((isset($this->filter_order)) && ($this->filter_order_Dir))
        {
            $orderby 	= ' ORDER BY '. $this->filter_order .' '. $this->filter_order_Dir;
        }

        $query = ' SELECT UniformDescription,UniformID'
        			. ' FROM #__team_uniforms'
        			. $where
        			. $orderby ;

		  $db 	= &JFactory::getDBO();
		  $db->setQuery($query);
		  $UniformDescriptions =& $db->loadAssocList('UniformID');
        return $UniformDescriptions;
    }
    function getUniformNumbers($PlayerID)
    {
        $where = array();
        $user =& JFactory::getUser();
        $UserID = $user->id;
		  $where[] = " userid = $UserID ";
		  $where[] = " PlayerID = $PlayerID ";
        $where =( count($where) ) ? ' WHERE ' . implode( ' AND ', $where ) : '';
        $orderby = '';

        #_ECR_MAT_FILTER_MODEL1_

        if ((isset($this->filter_order)) && ($this->filter_order_Dir))
        {
            $orderby 	= ' ORDER BY '. $this->filter_order .' '. $this->filter_order_Dir;
        }

        $query = ' SELECT UniformID,Number'
        			. ' FROM #__team_playernumbers'
        			. $where
        			. $orderby ;

		  $db 	= &JFactory::getDBO();
		  $db->setQuery($query);
		  $UniformNumbers =& $db->loadAssocList('UniformID');
        return $UniformNumbers;
    }
    function getTeamPlayer($PlayerID)
    {
        $where = array();
		  $where[] = " PlayerID = $PlayerID ";
        $where =( count($where) ) ? ' WHERE ' . implode( ' AND ', $where ) : '';
        $orderby = '';

        #_ECR_MAT_FILTER_MODEL1_

        if ((isset($this->filter_order)) && ($this->filter_order_Dir))
        {
            $orderby 	= ' ORDER BY '. $this->filter_order .' '. $this->filter_order_Dir;
        }

        $query = ' SELECT TeamID'
        			. ' FROM #__team_teamplayer'
        			. $where
        			. $orderby ;

		  $db 	= &JFactory::getDBO();
		  $db->setQuery($query);
		  $TeamPlayer =& $db->loadAssocList('TeamID');
        return $TeamPlayer;
    }    
}
?>    