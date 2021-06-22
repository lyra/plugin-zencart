<?php
/**
 * Copyright © Lyra Network.
 * This file is part of PayZen plugin for ZenCart. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
*/

/**
 * This file is an access point from the payment gateway.
 */

// Restore session if this is a server call.
if (key_exists('vads_hash', $_POST) && isset($_POST['vads_hash'])
    && key_exists('vads_ext_info_session_id', $_POST) && isset($_POST['vads_ext_info_session_id'])) {
    session_id($_POST['vads_ext_info_session_id']);
}

// Save received request from gateway.
$GLOBALS['payzen_request'] = $_REQUEST;

$_GET['main_page'] = 'checkout_process';
include 'index.php';
