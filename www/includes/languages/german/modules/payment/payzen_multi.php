<?php
/**
 * Copyright © Lyra Network.
 * This file is part of PayZen plugin for ZenCart. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

// Administration interface - multi payment settings.
define('MODULE_PAYMENT_PAYZEN_OPTIONS_TITLE', "Zahlungsarten");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_DESC', "Auf « Hinzufügen » klicken, um eine oder mehrere Zahlungsarten zu konfigurieren. Für weitere Informationen, Sie bitte der Moduldokumentation. <b>Bitte speichern Sie Ihre Änderungen durch Klicken auf « Aktualisieren ».</b>");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_LABEL', "Kennzeichnung");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_MIN_AMOUNT', "Mindestbetrag");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_MAX_AMOUNT', "Höchstbetrag");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_CONTRACT', "Vertrag");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_COUNT', "Nummer");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_PERIOD', "Zeitraum");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_FIRST', "1. Rate");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_ADD', "Hinzufügen");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_DELETE', "Löschen");

// Multi payment catalog messages.
define('MODULE_PAYMENT_PAYZEN_MULTI_TITLE', "PayZen - Ratenzahlung mit EC-/Kreditkarte");
define('MODULE_PAYMENT_PAYZEN_MULTI_SHORT_TITLE', "PayZen - Ratenzahlung");

define('MODULE_PAYMENT_PAYZEN_MULTI_WARNING', "ATTENTION: The payment in installments feature activation is subject to the prior agreement of Société Générale.<br />If you enable this feature while you have not the associated option, an error 10000 – INSTALLMENTS_NOT_ALLOWED or 07 - PAYMENT_CONFIG will occur and the buyer will not be able to pay.");
