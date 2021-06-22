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
 * Main class implementing multiple payment module for ZenCart.
 */
// Include tools class.
require_once (DIR_FS_CATALOG . 'includes/classes/payzen_tools.php');
require_once(DIR_FS_CATALOG . 'includes/modules/payment/payzen.php');

if (PayzenTools::$pluginFeatures['multi']) {

    // Load module language file.
    include_once (DIR_FS_CATALOG . 'includes/languages/' . $_SESSION['language'] . '/modules/payment/payzen.php');
    include_once (DIR_FS_CATALOG . 'includes/languages/' . $_SESSION['language'] . '/modules/payment/payzen_multi.php');

    class payzen_multi extends payzen
    {
        var $prefix = 'MODULE_PAYMENT_PAYZEN_MULTI_';

        /**
         * Class constructor.
         */
        function __construct()
        {
            parent::__construct();

            // Initialize code.
            $this->code = 'payzen_multi';

            if (PayzenTools::$pluginFeatures['restrictmulti']) {
                $this->description = '<p style="background-color: #FFFFE0; border: 1px solid #E6DB55; font-size: 13px;  margin: 0 0 20px; padding: 10px;">' .
                    MODULE_PAYMENT_PAYZEN_MULTI_WARNING . '</p>' . $this->description;
            }
        }

        /**
         * Payment zone and amount restriction checks.
         */
        function update_status()
        {
            parent::update_status();

            if (! $this->enabled) {
                return;
            }

            // Check multi payment options.
            $options = $this->get_available_options();
            if (empty($options)) {
                $this->enabled = false;
            }
        }

        function get_available_options()
        {
            global $order;

            $amount = $order->info['total'];

            $options = MODULE_PAYMENT_PAYZEN_MULTI_OPTIONS ? json_decode(MODULE_PAYMENT_PAYZEN_MULTI_OPTIONS, true) : array();

            $availOptions = array();
            if (is_array($options) && ! empty($options)) {
                foreach ($options as $code => $option) {
                    if (empty($option)) {
                        continue;
                    }

                    if ((! $option['min_amount'] || $amount >= $option['min_amount'])
                        && (! $option['max_amount'] || $amount <= $option['max_amount'])) {
                        // Option will be available.
                        $availOptions[$code] = $option;
                    }
                }
            }

            return $availOptions;
        }

        /**
         * Parameters for what the payment option will look like in the list.
         * @return array
         */
        function selection()
        {
            $selection = array(
                'id' => $this->code,
                'module' => $this->title
            );

            $first = true;
            foreach ($this->get_available_options() as $code => $option) {
                $checked = '';
                if ($first) {
                    $checked = ' checked="checked"';
                    $first = false;
                }

                $selection['fields'][] = array(
                    'title' => '',
                    'field' => '<input type="radio" id="payzen_option_' . $code . '" name="payzen_option" value="' . $code . '" onclick="$(\'input[name=payment][value=payzen_multi]\').click();" style="margin-left: -13em;"' . $checked . '>' .
                               '<label for="payzen_option_' . $code . '">' . $option['label'] . '</label>'
                );
            }

            return $selection;
        }

        /**
         * Prepare the form that will be sent to the payment gateway.
         * @return string
         */
        function process_button()
        {
            $data = $this->_build_request();

            // Set multi payment options.
            $options = $this->get_available_options();
            $option = $options[zen_output_string($_POST['payzen_option'])];

            $first = (isset($option['first']) && $option['first']) ?
                (int) (string) (($option['first'] / 100) * $data['amount']) /* Amount is in cents. */ : null;

            // Override cb contract.
            $data['contracts'] = $option['contract'] ? 'CB=' . $option['contract'] : null;

            require_once(DIR_FS_CATALOG . 'includes/classes/payzen_request.php');
            $request = new PayzenRequest(CHARSET);

            $request->setFromArray($data);
            $request->setMultiPayment(null /* Use already set amount. */, $first, $option['count'], $option['period']);

            // To recover order session.
            $request->addExtInfo('session_id', session_id());

            return $request->getRequestHtmlFields();
        }

        /**
         * Module install (register admin-managed parameters in database).
         */
        function install()
        {
            parent::install();

            // Multi-payment parameters.
            $this->_install_query('OPTIONS', '', 35, 'payzen_cfg_draw_table_multi_options(', 'payzen_get_multi_options');
        }

        /**
         * Returns the names of module's parameters.
         * @return array[int]string
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

            $keys[] = $this->prefix . 'OPTIONS';

            $keys[] = $this->prefix . 'REDIRECT_ENABLED';
            $keys[] = $this->prefix . 'REDIRECT_SUCCESS_TIMEOUT';
            $keys[] = $this->prefix . 'REDIRECT_SUCCESS_MESSAGE';
            $keys[] = $this->prefix . 'REDIRECT_ERROR_TIMEOUT';
            $keys[] = $this->prefix . 'REDIRECT_ERROR_MESSAGE';
            $keys[] = $this->prefix . 'RETURN_MODE';
            $keys[] = $this->prefix . 'ORDER_STATUS';

            return $keys;
        }
    }
}
