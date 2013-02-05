<?php
/**
 * @version SVN: $Id$
 * @package    teamstandings
 * @subpackage Base
 * @author     Mo Kelly {@link http://www.joomlamo.com Integration King!}
 * @author     Mo Kelly {@link http://joomlamo.com}
 * @author     Created on 21-Aug-2010
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

defined('_JEXEC') or die('=;)');
require_once dirname(__FILE__).DS.'helper.php';		  $Standings_params['StandingType'] = $params->get('StandingType');

$Standings_params['moduleclass_sfx'] 	= $params->get( 'moduleclass_sfx' );
$Standings_params['StandingType'] 		= $params->get( 'StandingType' );
$Standings_params['WinPoints'] 			= $params->get( 'WinPoints');
$Standings_params['TiePoints'] 			= $params->get( 'TiePoints' );
$Standings_params['LoosePoints'] 		= $params->get( 'LoosePoints' );
$Games 		=& ModteamstandingsHelper::getGames();
$Record 		=& ModteamstandingsHelper::getRecord($Games);
$Standings	=& ModteamstandingsHelper::getTeams($Record,$Standings_params);
$Leagues 	=& ModteamstandingsHelper::getLeagues();
$post			= JRequest::get('request');
If(array_key_exists('LeagueChoice',$post)){
	$LeagueChoice = intval($post['LeagueChoice']);			
}
require JModuleHelper::getLayoutPath('mod_teamstandings');