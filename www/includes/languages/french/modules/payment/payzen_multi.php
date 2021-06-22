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
define('MODULE_PAYMENT_PAYZEN_OPTIONS_TITLE', "Options de paiement");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_DESC', "Cliquer sur le bouton « Ajouter » pour configurer une ou plusieurs options de paiement. Pour plus d'informations, merci de consulter la documentation. <b>N'oubliez pas de cliquer sur le bouton « Mettre à jour » afin de sauvegarder vos modifications.</b>");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_LABEL', "Libellé");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_MIN_AMOUNT', "Montant min");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_MAX_AMOUNT', "Montant max");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_CONTRACT', "Contrat");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_COUNT', "Nombre");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_PERIOD', "Période");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_FIRST', "1ère échéance");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_ADD', "Ajouter");
define('MODULE_PAYMENT_PAYZEN_OPTIONS_DELETE', "Supprimer");

// Multi payment catalog messages.
define('MODULE_PAYMENT_PAYZEN_MULTI_TITLE', "PayZen - Paiement par carte bancaire en plusieurs fois");
define('MODULE_PAYMENT_PAYZEN_MULTI_SHORT_TITLE', "PayZen - Paiement en plusieurs fois");

define('MODULE_PAYMENT_PAYZEN_MULTI_WARNING', "ATTENTION: L'activation de la fonctionnalité de paiement en nfois est soumise à accord préalable de Société Générale.<br />Si vous activez cette fonctionnalité alors que vous ne disposez pas de cette option, une erreur 10000 – INSTALLMENTS_NOT_ALLOWED ou 07 - PAYMENT_CONFIG sera générée et l'acheteur sera dans l'incapacité de payer.");
