<?php
/**
 * Copyright © Lyra Network.
 * This file is part of PayZen plugin for ZenCart. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
*/

// Include gateway API class.
require_once (DIR_FS_CATALOG . 'includes/classes/payzen_api.php');

// Include tools class.
require_once (DIR_FS_CATALOG . 'includes/classes/payzen_tools.php');

/* include the admin configuration functions */
if (defined('DIR_FS_ADMIN')) {
    include_once (DIR_FS_ADMIN . 'includes/functions/payzen_output.php');
}

// Load module language file.
include_once (DIR_FS_CATALOG . 'includes/languages/' . $_SESSION['language'] . '/modules/payment/payzen.php');

/**
 * Main class implementing ZenCart payment module API.
 */
class payzen extends base
{
    var $prefix = 'MODULE_PAYMENT_PAYZEN_';

    /**
     * @var string
     */
    var $code;

    /**
     * @var string
     */
    var $title;

    /**
     * @var string
     */
    var $description;

    /**
     * @var boolean
     */
    var $enabled;

    /**
     * @var int
     */
    var $sort_order;

    /**
     * @var string
     */
    var $form_action_url;

    /**
     * @var int
     */
    var $order_status;

    // Class constructor.
    function __construct()
    {
        global $order;

        // Initialize code.
        $this->code = 'payzen';

        // Initialize title.
        $this->title = constant($this->prefix . 'TITLE');

        // Initialize description.
        $this->description  = '';
        $this->description .= '<b>' . MODULE_PAYMENT_PAYZEN_MODULE_INFORMATION . '</b>';
        $this->description .= '<br/><br/>';

        $this->description .= '<table class="infoBoxContent">';
        $this->description .= '<tr><td style="text-align: right;">' . MODULE_PAYMENT_PAYZEN_DEVELOPED_BY . '</td><td><a href="https://www.lyra.com/" target="_blank"><b>Lyra network</b></a></td></tr>';
        $this->description .= '<tr><td style="text-align: right;">' . MODULE_PAYMENT_PAYZEN_CONTACT_EMAIL . '</td><td><b>' . PayzenApi::formatSupportEmails(PayzenTools::getDefault('SUPPORT_EMAIL')) . '</b></td></tr>';
        $this->description .= '<tr><td style="text-align: right;">' . MODULE_PAYMENT_PAYZEN_CONTRIB_VERSION . '</td><td><b>' . PayzenTools::getDefault('PLUGIN_VERSION') . '</b></td></tr>';
        $this->description .= '<tr><td style="text-align: right;">' . MODULE_PAYMENT_PAYZEN_GATEWAY_VERSION . '</td><td><b>V2</b></td></tr>';
        $this->description .= '</table>';

        $this->description .= '<br/>';
        $this->description .= MODULE_PAYMENT_PAYZEN_CHECK_URL . '<b>' . HTTP_SERVER . DIR_WS_CATALOG . 'checkout_process_payzen.php</b>';
        $this->description .= '<hr />';

        // Initialize enabled.
        if (defined($this->prefix . 'STATUS')) {
            $this->enabled = (constant($this->prefix . 'STATUS') == '1');
        }

        // Initialize sort_order.
        if (defined($this->prefix . 'SORT_ORDER')) {
            $this->sort_order = constant($this->prefix . 'SORT_ORDER');
        }

        if (defined($this->prefix . 'PLATFORM_URL')) {
            $this->form_action_url = constant($this->prefix . 'PLATFORM_URL');
        }

        if (defined($this->prefix . 'ORDER_STATUS') && (int)constant($this->prefix . 'ORDER_STATUS') > 0) {
            $this->order_status = constant($this->prefix . 'ORDER_STATUS');
        }

        // Detect CMS encoding.
        $this->charset = (defined('CHARSET')) ? CHARSET : 'UTF-8';

        // If there's an order to treat, start preliminary payment zone check.
        if (is_object($order)) {
            $this->update_status();
        }
    }

    /**
     * Payment zone check.
     *
     * @return boolean
     */
    function update_status()
    {
        global $order, $db;

        if (! $this->enabled) {
            return;
        }

        // Check customer zone.
        if ((int)constant($this->prefix . 'ZONE') > 0) {
            $flag = false;
            $check = $db->Execute('SELECT `zone_id` FROM `' . TABLE_ZONES_TO_GEO_ZONES . '`' .
                    " WHERE `geo_zone_id` = '" . constant($this->prefix . 'ZONE') . "'" .
                    " AND `zone_country_id` = '" . $order->billing['country']['id'] . "'" .
                    ' ORDER BY `zone_id` ASC');

            while (! $check->EOF) {
                if (($check->fields['zone_id'] < 1) || ($check->fields['zone_id'] == $order->billing['zone_id'])) {
                    $flag = true;
                    break;
                }

                $check->MoveNext();
            }

            if (! $flag) {
                $this->enabled = false;
            }
        }

        // Check amount restrictions.
        if ((constant($this->prefix . 'AMOUNT_MIN') && ($order->info['total'] < constant($this->prefix . 'AMOUNT_MIN')))
            || (constant($this->prefix . 'AMOUNT_MAX') && ($order->info['total'] > constant($this->prefix . 'AMOUNT_MAX')))) {
            $this->enabled = false;
        }

        // Check currency.
        $payzenApi = new PayzenApi($this->charset); // Load gateway payment API.

        $defaultCurrency = (defined('USE_DEFAULT_LANGUAGE_CURRENCY') && USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
        if (! $payzenApi->findCurrencyByAlphaCode($order->info['currency']) && ! $payzenApi->findCurrencyByAlphaCode($defaultCurrency)) {
            // Currency is not supported, module is not available.
            $this->enabled = false;
        }
    }

    /**
     * JS checks : we let the gateway do all the validation itself.
     * @return false
     */
    function javascript_validation()
    {
        return false;
    }

    /**
     * Parameters for what the payment option will look like in the list
     * @return array
     */
    function selection()
    {
        return array(
            'id' => $this->code,
            'module' => $this->title
        );
    }

    /**
     * Server-side checks after payment selection : We let the gateway do all the validation itself.
     * @return false
     */
    function pre_confirmation_check()
    {
        return false;
    }

    /**
     * Server-size checks before payment confirmation :  We let the gateway do all the validation itself.
     * @return false
     */
    function confirmation()
    {
        return false;
    }

    /**
     * Prepare the form that will be sent to the payment gateway.
     * @return string
     */
    function process_button()
    {
        require_once(DIR_FS_CATALOG . 'includes/classes/payzen_request.php');
        $request = new PayzenRequest($this->charset);

        $request->setFromArray($this->_build_request());

        // To recover order session.
        $request->addExtInfo('session_id', session_id());

        return $request->getRequestHtmlFields();
    }

    function _build_request()
    {
        global $db, $order, $currencies;

        $data = array();

        // Admin configuration parameters.
        $config_params = array(
            'site_id', 'key_test', 'key_prod', 'ctx_mode', 'sign_algo', 'platform_url', 'available_languages',
            'capture_delay', 'redirect_enabled', 'redirect_success_timeout', 'redirect_success_message',
            'redirect_error_timeout', 'redirect_error_message', 'return_mode', 'validation_mode', 'payment_cards'
        );

        foreach ($config_params as $name) {
            $data[$name] = constant($this->prefix . strtoupper($name));
        }

        $languages_id = $_SESSION['languages_id'];

        // Get the shop language code.
        $query = $db->Execute('SELECT `code` FROM `' . TABLE_LANGUAGES . "` WHERE `languages_id` = '$languages_id'");
        $payzenLanguage = PayzenApi::isSupportedLanguage($query->fields['code']) ?
        strtolower($query->fields['code']) : constant($this->prefix . 'LANGUAGE');

        // Get the currency to use.
        $currencyValue = $order->info['currency_value'];
        $payzenCurrency = PayzenApi::findCurrencyByAlphaCode($order->info['currency']);
        if (! $payzenCurrency) {
            // Currency is not supported, use the default shop currency.
            $defaultCurrency = (defined('USE_DEFAULT_LANGUAGE_CURRENCY') && USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ?
            LANGUAGE_CURRENCY : DEFAULT_CURRENCY;

            $payzenCurrency = PayzenApi::findCurrencyByAlphaCode($defaultCurrency);
            $currencyValue = 1;
        }

        // Calculate amount...
        $total = zen_round($order->info['total'] * $currencyValue, $currencies->get_decimal_places($payzenCurrency->getAlpha3()));

        // Activate 3DS?
        $threedsMpi = null;
        if (constant($this->prefix . '3DS_MIN_AMOUNT') && ($order->info['total'] < constant($this->prefix . '3DS_MIN_AMOUNT'))) {
            $threedsMpi = '2';
        }

        // Other parameters.
        $versionData = $db->Execute('SELECT * FROM ' . TABLE_PROJECT_VERSION . " WHERE project_version_key = 'Zen-Cart Main'", 1);
        $version = $versionData->fields['project_version_major'] . '.' . $versionData->fields['project_version_minor'];

        $data += array(
            // Order info.
            'amount' => $payzenCurrency->convertAmountToInteger($total),
            'order_id' => $this->_guess_order_id(),
            'contrib' => PayzenTools::getDefault('CMS_IDENTIFIER') . '_' . PayzenTools::getDefault('PLUGIN_VERSION') . '/' . $version . '/' . PayzenApi::shortPhpVersion(),

            // Misc data.
            'currency' => $payzenCurrency->getNum(),
            'language' => $payzenLanguage,
            'threeds_mpi' => $threedsMpi,
            'url_return' => HTTP_SERVER . DIR_WS_CATALOG . 'checkout_process_payzen.php',

            // Customer info.
            'cust_id' => $_SESSION['customer_id'],
            'cust_email' => $order->customer['email_address'],
            'cust_phone' => $order->customer['telephone'],
            'cust_cell_phone' => $order->customer['telephone'], // No cell phone defined, just use customer phone.
            'cust_first_name' => $order->billing['firstname'],
            'cust_last_name' => $order->billing['lastname'],
            'cust_address' => $order->billing['street_address'] . ' ' . $order->billing['suburb'],
            'cust_city' => $order->billing['city'],
            'cust_state' => $order->billing['state'],
            'cust_zip' => $order->billing['postcode'],
            'cust_country' => $order->billing['country']['iso_code_2']
        );

        // Delivery data.
        if ($order->delivery) {
            $data['ship_to_first_name'] = $order->delivery['firstname'];
            $data['ship_to_last_name'] = $order->delivery['lastname'];
            $data['ship_to_street'] = $order->delivery['street_address'];
            $data['ship_to_street2'] = $order->delivery['suburb'];
            $data['ship_to_city'] = $order->delivery['city'];
            $data['ship_to_state'] = $order->delivery['state'];

            $countryCode = $order->delivery['country']['iso_code_2'];
            if ($countryCode === 'FX') { // FX not recognized as a country code by PayPal.
                $countryCode = 'FR';
            }

            $data['ship_to_country'] = $countryCode;

            $data['ship_to_zip'] = $order->delivery['postcode'];
        }

        return $data;
    }

    /**
     * Verify client data after he returned from payment gateway.
     * @return boolean
     */
    function before_process()
    {
        global $order, $payzenResponse, $messageStack;

        require_once (DIR_FS_CATALOG . 'includes/classes/payzen_response.php');
        $payzenResponse = new PayzenResponse(
            $GLOBALS['payzen_request'],
            constant($this->prefix . 'CTX_MODE'),
            constant($this->prefix . 'KEY_TEST'),
            constant($this->prefix . 'KEY_PROD'),
            constant($this->prefix . 'SIGN_ALGO')
        );

        unset ($GLOBALS['payzen_request']);

        $fromServer = $payzenResponse->get('hash');

        // Check authenticity.
        if (! $payzenResponse->isAuthentified()) {
            if ($fromServer) {
                die($payzenResponse->getOutputForGateway('auth_fail'));
            } else {
                $messageStack->add_session('header', MODULE_PAYMENT_PAYZEN_TECHNICAL_ERROR, 'error');
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true));
                die();
            }
        }

        // Messages to display on payment result page.
        if (constant($this->prefix . 'CTX_MODE') === 'TEST' && PayzenTools::$pluginFeatures['prodfaq']) {
            $messageStack->add_session('header', MODULE_PAYMENT_PAYZEN_GOING_INTO_PROD_INFO , 'success');
        }

        // Act according to case.
        if ($payzenResponse->isAcceptedPayment()) {
            // Successful payment.
            if ($this->_is_order_paid()) {
                if ($fromServer) {
                    die ($payzenResponse->getOutputForGateway('payment_ok_already_done'));
                } else {
                    $_SESSION['cart']->reset(true);

                    // Unregister session variables used during checkout.
                    unset($_SESSION['sendto']);
                    unset($_SESSION['billto']);
                    unset($_SESSION['shipping']);
                    unset($_SESSION['payment']);
                    unset($_SESSION['comments']);

                    zen_redirect(zen_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));
                    require(DIR_WS_INCLUDES . 'application_bottom.php');
                    die();
                }
            } else {
                // Update order payment data.
                $order->info['cc_type'] = $payzenResponse->get('card_brand');
                $order->info['cc_number'] = $payzenResponse->get('card_number');
                $order->info['cc_expires'] = str_pad($payzenResponse->get('expiry_month'), 2, '0', STR_PAD_LEFT) . substr($payzenResponse->get('expiry_year'), 2);

                // Let's borrow the cc_owner field to store transaction ID.
                $order->info['cc_owner'] = '-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transaction: ' . $payzenResponse->get('trans_id');
                return false;
            }
        } else {
            // Payment process failed.
            if ($fromServer) {
                die($payzenResponse->getOutputForGateway('payment_ko'));
            } else {
                $messageStack->add_session('header', MODULE_PAYMENT_PAYZEN_PAYMENT_ERROR, 'error');
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
                die();
            }
        }
    }

    /**
     * Post-processing after the order has been finalised
     */
    function after_process()
    {
        // This function is called only when payment was successful and the order is not registered yet.
        global $cart, $payzenResponse, $messageStack, $order_total_modules, $zco_notifier;

        $fromServer = $payzenResponse->get('hash');

        if ($fromServer) {
            $order_total_modules->clear_posts(); // ICW added for credit class system.

            $zco_notifier->notify('NOTIFY_HEADER_END_CHECKOUT_PROCESS');
            die ($payzenResponse->getOutputForGateway('payment_ok'));
        } else {
            if (constant($this->prefix . 'CTX_MODE') === 'TEST') {
                // Payment confirmed by client retun, show a warning if TEST mode.
                if (DOWN_FOR_MAINTENANCE == 'true') { // If maintenance mode.
                    $messageStack->add_session('header', MODULE_PAYMENT_PAYZEN_MAINTENANCE_MODE_WARN , 'warning');
                } else {
                    $messageStack->add_session('header', MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN . '<br />' . MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN_DETAIL, 'warning');
                }
            }

            return false;
        }
    }

    /**
     * Return true/1 if the module is installed.
     */
    function check()
    {
        global $db;

        if (! isset($this->_check)) {
            $check_query = $db->Execute('SELECT configuration_value FROM ' . TABLE_CONFIGURATION .
                                        " WHERE configuration_key = '{$this->prefix}STATUS'");
            $this->_check = $check_query->RecordCount();
        }

        return $this->_check;
    }


    /**
     * Build and execute a query for the install() function
     *
     * @param string $key
     * @param string $value
     * @param string $group_id
     * @param string $sort_order
     * @param string $date_added
     * @param string $set_function
     * @param string $use_function
     * @return
     */
    function _install_query($key, $value, $sort_order, $set_function = null, $use_function = null)
    {
        $sql_data = array(
            'configuration_title' => constant('MODULE_PAYMENT_PAYZEN_' . $key . '_TITLE'),
            'configuration_key' => $this->prefix . $key,
            'configuration_value' => $value,
            'configuration_description' => constant('MODULE_PAYMENT_PAYZEN_' . $key . '_DESC'),
            'configuration_group_id' => '6',
            'sort_order' => $sort_order,
            'date_added' => 'now()'
        );

        if ($set_function) {
            $sql_data['set_function'] = $set_function;
        }

        if ($use_function) {
            $sql_data['use_function'] = $use_function;
        }

        zen_db_perform(TABLE_CONFIGURATION, $sql_data);
    }

    /**
     * Module install (defines admin-managed parameters).
     * @return unknown_type
     */
    function install()
    {
        global $db;

        // Ex: _install_query($key, $value, $group_id, $sort_order, $set_function=null, $use_function=null).
        // ZenCart specific parameters.
        $this->_install_query('STATUS', '1', 1, 'payzen_cfg_draw_pull_down_bools(', 'payzen_get_bool_title');
        $this->_install_query('SORT_ORDER', '0', 2);
        $this->_install_query('ZONE', '0', 3, 'zen_cfg_pull_down_zone_classes(', 'zen_get_zone_class_title');

        // Gateway access parameters.
        $this->_install_query('SITE_ID', PayzenTools::getDefault('SITE_ID'), 10);
        if (! PayzenTools::$pluginFeatures['qualif']) {
            $this->_install_query('KEY_TEST', PayzenTools::getDefault('KEY_TEST'), 11);
        }

        $this->_install_query('KEY_PROD', PayzenTools::getDefault('KEY_PROD'), 12);

        if (! PayzenTools::$pluginFeatures['qualif']) {
            $this->_install_query('CTX_MODE', PayzenTools::getDefault('CTX_MODE'), 13, "zen_cfg_select_option(array(\'TEST\', \'PRODUCTION\'),");
        } else {
            $this->_install_query('CTX_MODE', PayzenTools::getDefault('CTX_MODE'), 13, "zen_cfg_select_option(array(\'PRODUCTION\'),");
        }

        $this->_install_query('SIGN_ALGO', PayzenTools::getDefault('SIGN_ALGO'), 14, 'payzen_cfg_draw_pull_down_signature_algorithm(');
        $this->_install_query('PLATFORM_URL', PayzenTools::getDefault('GATEWAY_URL'), 15);

        $this->_install_query('LANGUAGE', PayzenTools::getDefault('LANGUAGE'), 21, 'payzen_cfg_draw_pull_down_langs(', 'payzen_get_lang_title');
        $this->_install_query('AVAILABLE_LANGUAGES', '', 22, 'payzen_cfg_draw_pull_down_multi_langs(', 'payzen_get_multi_lang_title');
        $this->_install_query('CAPTURE_DELAY', '', 23);
        $this->_install_query('VALIDATION_MODE', '', 24, 'payzen_cfg_draw_pull_down_validation_modes(', 'payzen_get_validation_mode_title');
        $this->_install_query('PAYMENT_CARDS', '', 25, 'payzen_cfg_draw_pull_down_cards(', 'payzen_get_card_title');
        $this->_install_query('3DS_MIN_AMOUNT', '', 26);

        // Amount restriction.
        $this->_install_query('AMOUNT_MIN', '', 30);
        $this->_install_query('AMOUNT_MAX', '', 31);

        // Gateway return parameters.
        $this->_install_query('REDIRECT_ENABLED', '0', 40, 'payzen_cfg_draw_pull_down_bools(', 'payzen_get_bool_title');
        $this->_install_query('REDIRECT_SUCCESS_TIMEOUT', '5', 41);
        $this->_install_query('REDIRECT_SUCCESS_MESSAGE', MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_DEFAULT , 42);
        $this->_install_query('REDIRECT_ERROR_TIMEOUT', '5', 43);
        $this->_install_query('REDIRECT_ERROR_MESSAGE', MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_DEFAULT, 44);
        $this->_install_query('RETURN_MODE', 'GET', 45, "zen_cfg_select_option(array(\'GET\', \'POST\'), ");
        $this->_install_query('ORDER_STATUS', '0', 48, 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name');
    }

    /**
     * Remove the module and all its settings.
     */
    function remove()
    {
        global $db;

        foreach ($this->keys() as $key) {
            $db->Execute('DELETE FROM `' . TABLE_CONFIGURATION . "` WHERE `configuration_key` = '$key'");
        }
    }

    /**
     * Returns the names of module's parameters.
     * @return array
     */
    function keys()
    {
        $keys = array();

        $keys[] = $this->prefix . 'STATUS';
        $keys[] = $this->prefix . 'SORT_ORDER';
        $keys[] = $this->prefix . 'ZONE';

        $keys[] = $this->prefix . 'SITE_ID';

        if (! PayzenTools::$pluginFeatures['qualif']) {
            $keys[] = $this->prefix . 'KEY_TEST';
        }

        $keys[] = $this->prefix . 'KEY_PROD';
        $keys[] = $this->prefix . 'CTX_MODE';
        $keys[] = $this->prefix . 'SIGN_ALGO';
        $keys[] = $this->prefix . 'PLATFORM_URL';

        $keys[] = $this->prefix . 'LANGUAGE';
        $keys[] = $this->prefix . 'AVAILABLE_LANGUAGES';
        $keys[] = $this->prefix . 'CAPTURE_DELAY';
        $keys[] = $this->prefix . 'VALIDATION_MODE';
        $keys[] = $this->prefix . 'PAYMENT_CARDS';
        $keys[] = $this->prefix . '3DS_MIN_AMOUNT';

        $keys[] = $this->prefix . 'AMOUNT_MIN';
        $keys[] = $this->prefix . 'AMOUNT_MAX';

        $keys[] = $this->prefix . 'REDIRECT_ENABLED';
        $keys[] = $this->prefix . 'REDIRECT_SUCCESS_TIMEOUT';
        $keys[] = $this->prefix . 'REDIRECT_SUCCESS_MESSAGE';
        $keys[] = $this->prefix . 'REDIRECT_ERROR_TIMEOUT';
        $keys[] = $this->prefix . 'REDIRECT_ERROR_MESSAGE';
        $keys[] = $this->prefix . 'RETURN_MODE';
        $keys[] = $this->prefix . 'ORDER_STATUS';

        return $keys;
    }

    /**
     * Try to guess what will be the order's id when ZenCart will register it at the end of the payment process.
     * This is only used to set order_id in the request to the payment gateway. It might be inconsistent with the
     * final ZenCart order id (in cases like two clients going to the payment gateway at the same time...)
     *
     * @return int
     */
    function _guess_order_id()
    {
        global $db;

        // Find out the last order number generated for this customer account.
        $order_query = 'SELECT * FROM ' . TABLE_ORDERS . ' ORDER BY date_purchased DESC LIMIT 1';
        $order = $db->Execute($order_query);

        return ($order->RecordCount() === 1 ? ($order->fields['orders_id'] + 1) : 1) ;
    }

    /**
     * Test if order corresponding to entered trans_id is already saved.
     *
     * @return boolean true if order already saved
     */
    function _is_order_paid()
    {
        global $payzenResponse, $db;

        $orderId = $payzenResponse->get('order_id');
        $customerId = $payzenResponse->get('cust_id');
        $transId = $payzenResponse->get('trans_id');

        $query =  $db->Execute('SELECT * FROM `' . TABLE_ORDERS . '`' .
                " WHERE orders_id >= $orderId" .
                " AND customers_id = $customerId" .
                " AND cc_owner LIKE '%Transaction: $transId'");

        return $query->RecordCount() > 0;
    }
}
