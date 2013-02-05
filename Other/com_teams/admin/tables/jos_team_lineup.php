<?php
/**
 * @version SVN: $Id$
 * @package    team
 * @subpackage Tables
 * @author     Mo Kelly {@link http://www.joomlamo.com Integration King!}
 * @author     Mo Kelly {@link http://joomlamo.com}
 * @author     Created on 04-Aug-10
 * @license    GNU/GPL
 * This program is free software: you can redistribute it and/or modify    
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.*
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.*

 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

//-- No direct access
defined('_JEXEC') or die('=;)');

/**
 * Class for table bat_lineup
 *
 */
class Tablejos_team_lineup extends JTable
{
	/**
	 * @var Database object
	 */
	var $db = null;


	/**
	 * @var bigint
	 */
	var $GameStatID = null;

	/**
	 * @var decimal,
	 */
	var $PlayerID = null;

	/**
	 * @var int
	 */
	var $PlayerNumber = 0;

	/**
	 * @var decimal,
	 */
	var $TeamID = null;

	/**
	 * @var decimal,
	 */
	var $GameID = null;

	/**
	 * @var int
	 */
	var $BattingOrder = 0;

	/**
	 * @var int
	 */
	var $Position = 0;

	/**
	 * @var int
	 */
	var $AtBat = 0;

	/**
	 * @var int
	 */
	var $Outs = 0;

	/**
	 * @var int
	 */
	var $StrikeOuts = 0;

	/**
	 * @var int
	 */
	var $Walks = 0;

	/**
	 * @var int
	 */
	var $HitByPitch = 0;

	/**
	 * @var int
	 */
	var $FieldersChoice = 0;

	/**
	 * @var int
	 */
	var $OnByError = 0;

	/**
	 * @var int
	 */
	var $Singles = 0;

	/**
	 * @var int
	 */
	var $Doubles = 0;

	/**
	 * @var int
	 */
	var $Triples = 0;

	/**
	 * @var int
	 */
	var $HomeRuns = 0;

	/**
	 * @var int
	 */
	var $StolenBases = 0;

	/**
	 * @var int
	 */
	var $RunsBattedIn = 0;

	/**
	 * @var int
	 */
	var $Runs = 0;

	/**
	 * @var int
	 */
	var $OutsPitched = 0;

	/**
	 * @var int
	 */
	var $EarnedRuns = 0;

	/**
	 * @var int
	 */
	var $BenchedInnings = 0;

	/**
	 * @var int
	 */
	var $PlayedInnings = 0;

	/**
	 * @var int
	 */
	var $Sacrifice = 0;

	/**
	 * @var int
	 */
	var $SacrificeBunt = 0;

	/**
	 * @var int
	 */
	var $PitcherWalks = 0;

	/**
	 * @var int
	 */
	var $PitcherStrikeOuts = 0;

	/**
	 * @var int
	 */
	var $userid = 0;


   /**
    * Constructor.
    *
    * @param object $_db Database connector object.
    */
    function __construct( &$_db )
    {
        parent::__construct('#__team_lineup', 'id', $_db);
        $this->db = $_db;
    }// function

}// class
