<?php
/**
 * Copyright © Lyra Network.
 * This file is part of PayZen plugin for ZenCart. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
*/

// Include tools class.
require_once (DIR_FS_CATALOG . 'includes/classes/payzen_tools.php');

// Catalog messages.
define('MODULE_PAYMENT_PAYZEN_TITLE', "PayZen - Zahlung mit EC-/Kreditkarte");
define('MODULE_PAYMENT_PAYZEN_TECHNICAL_ERROR', "Ein Fehler ist bei dem Zahlungsvorgang unterlaufen.");
define('MODULE_PAYMENT_PAYZEN_PAYMENT_ERROR', "Ihre Bestellung konnte nicht best&auml;tigt werden. Ein Fehler ist bei dem Zahlungsvorgang unterlaufen.");
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN', "Es konnte keine automatische Benachrichtigung erstellt werden. Bitte pr&uuml;fen Sie, ob die Benachrichtigung-URL in Ihrem PayZen Back Office korrekt eingerichtet?");
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN_DETAIL', "N&auml;here Informationen zu diesem Problem entnehmen Sie bitte der Moduldokumentation:<br />&nbsp;&nbsp;&nbsp;- Kapitel &laquo; Bitte vor dem Weiterlesen aufmerksam lesen &raquo;<br />&nbsp;&nbsp;&nbsp;- Kapitel &laquo; Benachrichtigung-URL Einstellungen &raquo;");
define('MODULE_PAYMENT_PAYZEN_GOING_INTO_PROD_INFO', "<b>UMSTELLUNG AUF PRODUKTIONSUMFELD:</b> Sie m&ouml;chten wissen, wie Sie auf Produktionsumfeld umstellen k&ouml;nnen, bitte lesen Sie die Kapitel &laquo; Weiter zur Testphase &raquo; und &laquo; Verschieben des Shops in den Produktionsumfeld &raquo; in der Dokumentation des Moduls.");
define('MODULE_PAYMENT_PAYZEN_MAINTENANCE_MODE_WARN' , "Dieser Shop befindet sich im Wartungsmodus. Es kann keine automatische Benachrichtigung erstellt werden.");

// Administration interface - informations.
define('MODULE_PAYMENT_PAYZEN_MODULE_INFORMATION', "MODULINFORMATIONEN");
define('MODULE_PAYMENT_PAYZEN_DEVELOPED_BY', "Entwickelt von : ");
define('MODULE_PAYMENT_PAYZEN_CONTACT_EMAIL', "E-Mail-Adresse : ");
define('MODULE_PAYMENT_PAYZEN_CONTRIB_VERSION', "Modulversion : ");
define('MODULE_PAYMENT_PAYZEN_GATEWAY_VERSION', "Kompatibel mit Zahlungsschnittstelle : ");
define('MODULE_PAYMENT_PAYZEN_CHECK_URL', "Benachrichtigung-URL die Sie in Ihre PayZen Back Office kopieren sollen > Einstellung > Regeln der: <br />");

// Administration interface - module settings.
define('MODULE_PAYMENT_PAYZEN_STATUS_TITLE', "Aktivierung");
define('MODULE_PAYMENT_PAYZEN_STATUS_DESC', "M&ouml;chten Sie die PayZen-Zahlungsart akzeptieren?");
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_TITLE', "Anzeigereihenfolge");
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_DESC', "Anzeigereihenfolge: Von klein nach gross.");
define('MODULE_PAYMENT_PAYZEN_ZONE_TITLE', "Zahlungsraum");
define('MODULE_PAYMENT_PAYZEN_ZONE_DESC', "Ist ein Zahlungsraum ausgew&auml;hlt, so wird diese Zahlungsart nur f&uuml;r diesen verf&uuml;gbar sein.");

// Administration interface - gateway settings.
define('MODULE_PAYMENT_PAYZEN_SITE_ID_TITLE', "Shop ID");
define('MODULE_PAYMENT_PAYZEN_SITE_ID_DESC', "Kennung, die von PayZen bereitgestellt wird.");
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_TITLE', "Schl&uuml;ssel im Testbetrieb");
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_DESC', "Schl&uuml;ssel, das von Ihrer Bank zu Testzwecken bereitgestellt wird (im PayZen Back Office verf&uuml;gbar).");
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_TITLE', "Schl&uuml;ssel im Produktivbetrieb");
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_DESC', "Schl&uuml;ssel, das von PayZen zu Testzwecken bereitgestellt wird (im PayZen Back Office verf&uuml;gbar).");
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_TITLE', "Modus");
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_DESC', "Kontextmodus dieses Moduls.");
define('MODULE_PAYMENT_PAYZEN_SIGN_ALGO_TITLE', "Signaturalgorithmus");

if (PayzenTools::$pluginFeatures['shatwo']) {
    define('MODULE_PAYMENT_PAYZEN_SIGN_ALGO_DESC', 'Algorithmus zur Berechnung der Zahlungsformsignatur. Der ausgew&auml;hlte Algorithmus muss derselbe sein, wie er im PayZen Back Office.');
} else {
    define('MODULE_PAYMENT_PAYZEN_SIGN_ALGO_DESC', 'Algorithmus zur Berechnung der Zahlungsformsignatur. Der ausgew&auml;hlte Algorithmus muss derselbe sein, wie er im PayZen Back Office.<br /><b>Der HMAC-SHA-256-Algorithmus sollte nicht aktiviert werden, wenn er noch nicht im PayZen Back Office verf&uuml;gbar ist. Die Funktion wird in K&uuml;rze verf&uuml;gbar sein.</b>');
}

define('MODULE_PAYMENT_PAYZEN_PLATFORM_URL_TITLE', "Plattform-URL");
define('MODULE_PAYMENT_PAYZEN_PLATFORM_URL_DESC', "Link zur Bezahlungsplattform.");

// Administration interface - payment settings.
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_TITLE', "Standardsprache");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_DESC', "Standardsprache auf Zahlungsseite.");
define('MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES_TITLE', "Verf&uuml;gbare Sprachen");
define('MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES_DESC', "Verf&uuml;gbare Sprachen der Zahlungsseite. Nichts ausw&auml;hlen, um die Einstellung der Zahlungsplattform zu benutzen.");
define('MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY_TITLE', "Einzugsfrist");
define('MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY_DESC', "Anzahl der Tage bis zum Einzug der Zahlung (Einstellung &uuml;ber Ihr PayZen Back Office).");
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_TITLE', "Best&auml;tigungsmodus");
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_DESC', "Bei manueller Eingabe m&uuml;ssen Sie Zahlungen manuell in Ihr PayZen Back Office best&auml;tigen.");
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_TITLE', "Kartentypen");
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_DESC', "W&auml;hlen Sie die zur Zahlung verf&uuml;gbaren Kartentypen aus. Nichts ausw&auml;hlen, um die Einstellungen der Plattform zu verwenden.");
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_TITLE', "Manage 3DS");
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_DESC', "Amount below which customer could be exempt from strong authentication. Needs subscription to «Selective 3DS1» or «Frictionless 3DS2» options. For more information, refer to the module documentation.");

// Administration interface - amount restricition settings.
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MIN_TITLE', "Mindestbetrag");
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MIN_DESC', "Mindestbetrag dieser Zahlungsmethode zu aktivieren.");
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MAX_TITLE', "H&ouml;chstbetrag");
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MAX_DESC', "Maximale Anzahl dieser Zahlungsmethode verf&uuml;gbar.");

// Administration interface - back to store settings.
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED_TITLE', "Automatische Weiterleitung");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED_DESC', "Falls erlaubt, der Kaufer wurde automatisch am Ende des Zahlungsprozesses auf Ihre Webseite weitergeleitet.");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT_TITLE', "Erfolgreiche timeout Umleitung");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT_DESC', "Zeit in Sekunden (0-300), bevor der K&auml;ufer automatisch zu Ihrer Shop umgeleitet wird, als die Bezahlung erfolgreich wurde.");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_TITLE', "Erfolgreiche Meldung vor Umleitung");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_DEFAULT', "Weiterleitung zum Shop in K&uuml;rze...");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_DESC', "Meldung auf die Zahlungsseite vor Umleitung als die Zahlung ist erfolgreich.");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT_TITLE', "Umleitung-Timeout auf Fehler");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT_DESC', "Zeit in Sekunden (0-300) bevor der K&auml;ufer automatisch zu Ihrer Shop umgeleitet wird, als die Bezahlung verweigert wurde.");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_TITLE', "Umleitung Timeout auf Fehler");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_DEFAULT', "Weiterleitung zum Shop in K&uuml;rze...");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_DESC', "Meldung angezeigt auf die Zahlungsseite vor Umleitung nach der verweigerten Zahlung.");
define('MODULE_PAYMENT_PAYZEN_RETURN_MODE_TITLE', "&Uuml;bermittlungs-Modus");
define('MODULE_PAYMENT_PAYZEN_RETURN_MODE_DESC', "Methode, die f&uuml;r die &Uuml;bermittlung des Zahlungsvorgang ben&uuml;tzt wird, kommt aus der Bezahlungsseite zu Ihrem Gesch&auml;ft.");
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_TITLE', "Bestellungen Status");
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_DESC', "Der Status der bezahlten Bestellungen durch dieses Beszahlungsmittel definieren.");

// Administration interface - misc constants.
define('MODULE_PAYMENT_PAYZEN_VALUE_0', "Deaktiviert");
define('MODULE_PAYMENT_PAYZEN_VALUE_1', "Aktiviert");

define('MODULE_PAYMENT_PAYZEN_VALIDATION_DEFAULT', "Back Office Konfiguration");
define('MODULE_PAYMENT_PAYZEN_VALIDATION_0', "Automatisch");
define('MODULE_PAYMENT_PAYZEN_VALIDATION_1', "Manuell");

define('MODULE_PAYMENT_PAYZEN_LANGUAGE_FRENCH', "Franz&ouml;sisch");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_GERMAN', "Deutsch");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_ENGLISH', "Englisch");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_SPANISH', "Spanisch");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_CHINESE', "Chinesisch");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_ITALIAN', "Italienisch");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_JAPANESE', "Japanisch");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_PORTUGUESE', "Portugiesisch");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_POLISH', "Polnisch");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_DUTCH', "Holl&auml;ndisch");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_SWEDISH', "Schwedisch");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_RUSSIAN', "Russisch");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_TURKISH', "T&uuml;rkisch");
