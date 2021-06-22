<?php
/**
 * Copyright © Lyra Network.
 * This file is part of PayZen plugin for ZenCart. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
*/

// Include Tools class.
require_once (DIR_FS_CATALOG . 'includes/classes/payzen_tools.php');

// Catalog messages.
define('MODULE_PAYMENT_PAYZEN_TITLE', "PayZen - Pago con tarjeta de cr&eacute;dito");
define('MODULE_PAYMENT_PAYZEN_TECHNICAL_ERROR', "Ocurri&oacute; un error en el proceso de pago.");
define('MODULE_PAYMENT_PAYZEN_PAYMENT_ERROR', "Su pago no fue aceptado. Ocurri&oacute; un error en el proceso de pago.");
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN', "La validaci&oacute;n autom&aacute;tica no ha funcionado. &iquest;Configur&oacute; correctamente la URL de notificaci&oacute;n en su Back Office PayZen?");
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN_DETAIL', "Para entender el problema, lea la documentaci&oacute;n del m&oacute;dulo:<br />&nbsp;&nbsp;&nbsp;- Cap&iacute;tulo &laquo; Leer detenidamente antes de continuar &raquo;<br />&nbsp;&nbsp;&nbsp;- Cap&iacute;tulo &laquo; Configuraci&oacute;n de la URL de notificaci&oacute;n &raquo;");
define('MODULE_PAYMENT_PAYZEN_GOING_INTO_PROD_INFO', "<b>IR A PRODUCTION:</b> Si desea saber c&oacute;mo poner su tienda en modo production, lea los cap&iacute;tulos &laquo; Proceder a la fase de prueba &raquo; y &laquo; Paso de una tienda al modo producci&oacute;n &raquo; en la documentaci&oacute;n del m&oacute;dulo.");
define('MODULE_PAYMENT_PAYZEN_MAINTENANCE_MODE_WARN' , "La tienda est&aacute; en modo de mantenimiento. La notificaci&oacute;n autom&aacute;tica no puede funcionar.");

// Administration interface - informations.
define('MODULE_PAYMENT_PAYZEN_MODULE_INFORMATION', "DETALLES DEL M&Oacute;DULO");
define('MODULE_PAYMENT_PAYZEN_DEVELOPED_BY', "Desarrollado por : ");
define('MODULE_PAYMENT_PAYZEN_CONTACT_EMAIL', "Cont&aacute;ctenos : ");
define('MODULE_PAYMENT_PAYZEN_CONTRIB_VERSION', "Versi&oacute;n del m&oacute;dulo : ");
define('MODULE_PAYMENT_PAYZEN_GATEWAY_VERSION', "Versi&oacute;n del portal : ");
define('MODULE_PAYMENT_PAYZEN_CHECK_URL', "URL de notificaci&oacute;n de pago instant&aacute;neo a copiar en el Back Office PayZen > Configuraci&oacute;n > Reglas de notificaci&oacute;n: <br />");

// Administration interface - module settings.
define('MODULE_PAYMENT_PAYZEN_STATUS_TITLE', "Activaci&oacute;n");
define('MODULE_PAYMENT_PAYZEN_STATUS_DESC', "Habilita/deshabilita el m&oacute;dulo de pago PayZen.");
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_TITLE', "Orden de visualizaci&oacute;n");
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_DESC', "El &iacute;ndice m&aacute;s peque&ntilde;o se muestra primero.");
define('MODULE_PAYMENT_PAYZEN_ZONE_TITLE', "Area de pago");
define('MODULE_PAYMENT_PAYZEN_ZONE_DESC', "Si se selecciona un &aacute;rea, esta forma de pago solo estar&aacute; disponible para ella.");

// Administration interface - gateway settings.
define('MODULE_PAYMENT_PAYZEN_SITE_ID_TITLE', "Identificador de tienda");
define('MODULE_PAYMENT_PAYZEN_SITE_ID_DESC', "El identificador proporcionado por PayZen.");
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_TITLE', "Clave en modo test");
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_DESC', "Clave proporcionada por PayZen para modo test (disponible en el Back Office PayZen).");
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_TITLE', "Clave en modo production");
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_DESC', "Clave proporcionada por PayZen (disponible en el Back Office PayZen despu&eacute;s de habilitar el modo production).");
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_TITLE', "Modo");
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_DESC', "El modo de contexto de este m&oacute;dulo.");
define('MODULE_PAYMENT_PAYZEN_SIGN_ALGO_TITLE', "Algoritmo de firma");

if (PayzenTools::$pluginFeatures['shatwo']) {
    define('MODULE_PAYMENT_PAYZEN_SIGN_ALGO_DESC', 'Algoritmo usado para calcular la firma del formulario de pago. El algoritmo seleccionado debe ser el mismo que el configurado en el Back Office PayZen.');
} else {
    define('MODULE_PAYMENT_PAYZEN_SIGN_ALGO_DESC', 'Algoritmo usado para calcular la firma del formulario de pago. El algoritmo seleccionado debe ser el mismo que el configurado en el Back Office PayZen.<br /><b>El algoritmo HMAC-SHA-256 no se debe activar si a&uacute;n no est&aacute; disponible en el Back Office PayZen, la funci&oacute;n estar&aacute; disponible pronto.</b>');
}

define('MODULE_PAYMENT_PAYZEN_PLATFORM_URL_TITLE', "URL de p&aacute;gina de pago");
define('MODULE_PAYMENT_PAYZEN_PLATFORM_URL_DESC', "Enlace a la p&aacute;gina de pago.");

// Administration interface - payment settings.
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_TITLE', "Idioma por defecto");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_DESC', "Idioma por defecto en la p&aacute;gina de pago.");
define('MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES_TITLE', "Idiomas disponibles");
define('MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES_DESC', "Idiomas disponibles en la p&aacute;gina de pago. Si no selecciona ninguno, todos los idiomas compatibles estar&aacute;n disponibles.");
define('MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY_TITLE', "Plazo de captura");
define('MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY_DESC', "El n&uacute;mero de d&iacute;as antes de la captura del pago (ajustable en su Back Office de PayZen).");
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_TITLE', "Modo de validaci&oacute;n");
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_DESC', "Si se selecciona manual, deber&aacute; confirmar los pagos manualmente en su Back Office PayZen.");
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_TITLE', "Tipos de tarjeta");
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_DESC', "El tipo(s) de tarjeta que se puede usar para el pago. No haga ninguna selecci&oacute;n para usar la configuraci&oacute;n del portal.");
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_TITLE', "Gestionar el 3DS");
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_DESC', "Monto por debajo del cual el comprador podr&iacute;a estar exento de de la autenticaci&oacute;n fuerte. Requiere suscripci&oacute;n a la opci&oacute;n «Selective 3DS1» o a la opci&oacute;n «Frictionless 3DS2». Para m&aacute;s informaci&oacute;n, consulte la documentaci&oacute;n del m&oacute;dulo.");

// Administration interface - amount restricition settings.
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MIN_TITLE', "Monto m&iacute;nimo");
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MIN_DESC', "Monto m&iacute;nimo para activar este m&eacute;todo de pago.");
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MAX_TITLE', "Monto m&aacute;ximo");
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MAX_DESC', "Monto m&aacute;ximo para activar este m&eacute;todo de pago.");

// Administration interface - back to store settings.
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED_TITLE', "Redirecci&oacute;n autom&aacute;tica");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED_DESC', "Si est&aacute; habilitada, el comprador es redirigido autom&aacute;ticamente a su sitio al final del pago.");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT_TITLE', "Tiempo de espera de la redirecci&oacute;n en pago exitoso");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT_DESC', "Tiempo en segundos (0-300) antes de que el comprador sea redirigido autom&aacute;ticamente a su sitio web despu&eacute;s de un pago exitoso.");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_TITLE', "Mensaje de redirecci&oacute;n en pago exitoso");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_DEFAULT', "Redirecci&oacute;n a la tienda en unos momentos ...");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_DESC', "Mensaje mostrado en la p&aacute;gina de pago antes de la redirecci&oacute;n despu&eacute;s de un pago exitoso.");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT_TITLE', "Tiempo de espera de la redirecci&oacute;n en pago rechazado");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT_DESC', "Tiempo en segundos (0-300) antes de que el comprador sea redirigido autom&aacute;ticamente a su sitio web despu&eacute;s de un pago rechazado.");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_TITLE', "Mensaje de redirecci&oacute;n en pago rechazado");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_DEFAULT', "Redirecci&oacute;n a la tienda en unos momentos ...");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_DESC', "Mensaje mostrado en la p&aacute;gina de pago antes de la redirecci&oacute;n despu&eacute;s de un pago rechazado.");
define('MODULE_PAYMENT_PAYZEN_RETURN_MODE_TITLE', "Return mode");
define('MODULE_PAYMENT_PAYZEN_RETURN_MODE_DESC', "M&eacute;todo que se usar&aacute; para transmitir el resultado del pago de la p&aacute;gina de pago a su tienda.");
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_TITLE', "Estado del pedido");
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_DESC', "Define el estado de los pedidos pagados con este modo de pago.");

// Administration interface - misc constants.
define('MODULE_PAYMENT_PAYZEN_VALUE_0', "Deshabilitado");
define('MODULE_PAYMENT_PAYZEN_VALUE_1', "Habilitado");

define('MODULE_PAYMENT_PAYZEN_VALIDATION_DEFAULT', "Configuraci&oacute;n del Back Office");
define('MODULE_PAYMENT_PAYZEN_VALIDATION_0', "Autom&aacute;tico");
define('MODULE_PAYMENT_PAYZEN_VALIDATION_1', "Manual");

define('MODULE_PAYMENT_PAYZEN_LANGUAGE_FRENCH', "Franc&eacute;s");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_GERMAN', "Alem&aacute;n");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_ENGLISH', "Ingl&eacute;s");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_SPANISH', "Espa&ntilde;ol");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_CHINESE', "Chino");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_ITALIAN', "Italiano");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_JAPANESE', "Japon&eacute;s");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_PORTUGUESE', "Portugu&eacute;s");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_POLISH', "Polaco");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_DUTCH', "Holand&eacute;s");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_SWEDISH', "Sueco");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_RUSSIAN', "Ruso");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_TURKISH', "Turco");
