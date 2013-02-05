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
 * Class for table bat_uniforms
 *
 */
class Tablejos_team_uniforms extends JTable
{
	/**
	 * @var Database object
	 */
	var $db = null;


	/**
	 * @var bigint
	 */
	var $UniformID = null;

	/**
	 * @var varchar
	 */
	var $UniformDescription = null;

	/**
	 * @var decimal,
	 */
	var $TeamID = null;

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
        parent::__construct('#__team_uniforms', 'id', $_db);
        $this->db = $_db;
    }// function

}// class
