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
define('MODULE_PAYMENT_PAYZEN_OPTIONS_TITLE', "Opciones de pago");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_DESC', "Haga clic en el botón « Agregar » para configurar una o más opciones de pago. Consulte la documentación para más información. <b>No olvide hacer clic en el botón « Actualizar » para guardar sus modificaciones.</b>");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_LABEL', "Etiqueta");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_MIN_AMOUNT', "Monto mínimo");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_MAX_AMOUNT', "Monto máximo");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_CONTRACT', "Afiliación");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_COUNT', "Conteo");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_PERIOD', "Periodo");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_FIRST', "Primer vencimiento");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_ADD', "Agregar");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_DELETE', "Eliminar");

// Multi payment catalog messages.
define('MODULE_PAYMENT_PAYZEN_MULTI_TITLE', "PayZen - Pago con tarjeta de crédito en cuotas");
define('MODULE_PAYMENT_PAYZEN_MULTI_SHORT_TITLE', "PayZen - Pago en cuotas");

define('MODULE_PAYMENT_PAYZEN_MULTI_WARNING', "ATENCIÓN: La activación de la función de pago en cuotas está sujeta al acuerdo previo de Societé Générale.<br />Si habilita esta función cuando no tiene la opción asociada, ocurrirá un error 10000 – INSTALLMENTS_NOT_ALLOWED o 07 - PAYMENT_CONFIG y el comprador no podrá pagar.");
