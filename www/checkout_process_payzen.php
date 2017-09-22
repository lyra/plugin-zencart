<?php
/**
 * PayZen V2-Payment Module version 1.5.0 for zencart 1.3.x. Support contact : support@payzen.eu.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @category  payment
 * @package   payzen
 * @author    Lyra Network (http://www.lyra-network.com/)
 * @copyright 2014-2015 Lyra Network and contributors
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html  GNU General Public License (GPL v2)
 * @version   1.5.0 (revision 67237)
*/

/*
 * This file is an access point for the payment gateway.
 */

// restore session if this is a server call.
if(key_exists('vads_hash', $_POST) && isset($_POST['vads_hash']) && key_exists('vads_result', $_POST) && isset($_POST['vads_result'])) {
	$sid = substr($_POST['vads_order_info'], strlen('session_id='));
	session_id($sid);

	$_GET['main_page'] = "checkout_process";
}
include 'index.php';
?>