<?php
/**
 * Copyright © Lyra Network.
 * This file is part of PayZen plugin for ZenCart. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

// Administration interface - multi payment options.
define('MODULE_PAYMENT_PAYZEN_OPTIONS_TITLE', "Payment options");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_DESC', "Click on « Add » to configure one or more payment options. Refer to documentation for more information. <b>Do not forget to click on « Update » to save your modifications.</b>");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_LABEL', "Label");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_MIN_AMOUNT', "Min amount");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_MAX_AMOUNT', "Max amount");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_CONTRACT', "Contract");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_COUNT', "Count");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_PERIOD', "Period");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_FIRST', "1st installment");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_ADD', "Add");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_DELETE', "Delete");

// Multi payment catalog messages.
define('MODULE_PAYMENT_PAYZEN_MULTI_TITLE', "PayZen - Payment in installments by credit card");
define('MODULE_PAYMENT_PAYZEN_MULTI_SHORT_TITLE', "PayZen - Payment in installments");

define('MODULE_PAYMENT_PAYZEN_MULTI_WARNING', "ATTENTION: The payment in installments feature activation is subject to the prior agreement of Société Générale.<br />If you enable this feature while you have not the associated option, an error 10000 – INSTALLMENTS_NOT_ALLOWED or 07 - PAYMENT_CONFIG will occur and the buyer will not be able to pay.");
