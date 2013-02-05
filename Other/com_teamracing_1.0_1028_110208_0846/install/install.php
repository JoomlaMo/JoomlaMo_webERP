<?php
/**
 * @package    TeamRacing
 * @subpackage Install
 * @author     Mo Kelly
 * @author     Created on 13-Jan-2011
 * @Joomla version 1.5
 * @copyright Copyright (C) 2010 Mo Kelly. All rights reserved.   
 *	This program is free software: you can redistribute it and/or modify    
 *	it under the terms of the GNU General Public License as published by
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
 * TeamRacing Main installer
 */
function com_install()
{
    echo '<h2>'.JText::sprintf('%s Installer', 'TeamRacing');

    /*
     * Custom install function
     *
     * If something goes wrong..
     */

    // return false;

    /*
     * otherwise...
     */

    return true;
}// function
