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
define('MODULE_PAYMENT_PAYZEN_TITLE', "PayZen - Paiement par carte bancaire");
define('MODULE_PAYMENT_PAYZEN_TECHNICAL_ERROR', "Une erreur est survenue dans le processus de paiement.");
define('MODULE_PAYMENT_PAYZEN_PAYMENT_ERROR', "Votre commande n'a pas pu &ecirc;tre confirm&eacute;e. Une erreur s'est produite lors du paiement.");
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN', "La validation automatique n'a pas fonctionn&eacute;. Avez-vous configur&eacute; correctement l'URL de notification dans le Back Office PayZen ?");
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN_DETAIL', "Afin de comprendre la probl&eacute;matique, reportez vous &agrave; la documentation du module :<br />&nbsp;&nbsp;&nbsp;- Chapitre &laquo;A lire attentivement avant d'aller loin&raquo;<br />&nbsp;&nbsp;&nbsp;- Chapitre &laquo;Param&eacute;trage de l'URL de notification&raquo;.");
define('MODULE_PAYMENT_PAYZEN_GOING_INTO_PROD_INFO', " <b>PASSAGE EN PRODUCTION :</b> Vous souhaitez savoir comment passer votre boutique en production, merci de consulter les chapitres &laquo; Proc&eacute;der &agrave; la phase des tests &raquo; et &laquo; Passage d'une boutique en mode production &raquo; de la documentation du module.");
define('MODULE_PAYMENT_PAYZEN_MAINTENANCE_MODE_WARN' , "La boutique est en mode maintenance. La notification automatique ne peut fonctionner.");

// Administration interface - informations.
define('MODULE_PAYMENT_PAYZEN_MODULE_INFORMATION', "INFORMATIONS SUR LE MODULE");
define('MODULE_PAYMENT_PAYZEN_DEVELOPED_BY', "D&eacute;velopp&eacute; par : ");
define('MODULE_PAYMENT_PAYZEN_CONTACT_EMAIL', "Courriel de contact : ");
define('MODULE_PAYMENT_PAYZEN_CONTRIB_VERSION', "Version du module : ");
define('MODULE_PAYMENT_PAYZEN_GATEWAY_VERSION', "Version de la plateforme : ");
define('MODULE_PAYMENT_PAYZEN_CHECK_URL', "URL de notification &agrave; copier dans le Back Office PayZen: <br />");

// Administration interface - module settings.
define('MODULE_PAYMENT_PAYZEN_STATUS_TITLE', "Activation");
define('MODULE_PAYMENT_PAYZEN_STATUS_DESC', "Activer / d&eacute;sactiver le module de paiement PayZen.");
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_TITLE', "Ordre d'affichage");
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_DESC', "Le plus petit indice est affich&eacute; en premier.");
define('MODULE_PAYMENT_PAYZEN_ZONE_TITLE', "Zone de paiement");
define('MODULE_PAYMENT_PAYZEN_ZONE_DESC', "Si une zone est choisie, ce mode de paiement ne sera effectif que pour celle-ci.");

// Administration interface - gateway settings.
define('MODULE_PAYMENT_PAYZEN_SITE_ID_TITLE', "Identifiant de la boutique");
define('MODULE_PAYMENT_PAYZEN_SITE_ID_DESC', "Identifiant fourni par PayZen.");
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_TITLE', "Cl&eacute; en mode test");
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_DESC', "Cl&eacute; fournie par PayZen pour le mode test (disponible sur le Back Office PayZen de votre boutique).");
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_TITLE', "Cl&eacute; en mode production");
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_DESC', "Cl&eacute; fournie par PayZen (disponible sur le Back Office PayZen de votre boutique apr&egrave;s passage en production).");
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_TITLE', "Mode");
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_DESC', "Mode de fonctionnement du module.");
define('MODULE_PAYMENT_PAYZEN_SIGN_ALGO_TITLE', "Algorithme de signature");

if (PayzenTools::$pluginFeatures['shatwo']) {
    define('MODULE_PAYMENT_PAYZEN_SIGN_ALGO_DESC', "Algorithme utilis&eacute; pour calculer la signature du formulaire de paiement. L'algorithme s&eacute;lectionn&eacute; doit &ecirc;tre le m&ecirc;me que celui configur&eacute; sur le Back Office PayZen.");
} else {
    define('MODULE_PAYMENT_PAYZEN_SIGN_ALGO_DESC', "Algorithme utilis&eacute; pour calculer la signature du formulaire de paiement. L'algorithme s&eacute;lectionn&eacute; doit &ecirc;tre le m&ecirc;me que celui configur&eacute; sur le Back Office PayZen. <br /><b>Le HMAC-SHA-256 ne doit pas &ecirc;tre activ&eacute; si celui-ci n'est pas encore  disponible depuis le Back Office PayZen, la fonctionnalit&eacute; sera disponible prochainement.</b>");
}

define('MODULE_PAYMENT_PAYZEN_PLATFORM_URL_TITLE', "URL de la page de paiement");
define('MODULE_PAYMENT_PAYZEN_PLATFORM_URL_DESC', "URL vers laquelle l'acheteur sera redirig&eacute; pour le paiement.");

// Administration interface - payment settings.
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_TITLE', "Langue par d&eacute;faut");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_DESC', "S&eacute;lectionner la langue par d&eacute;faut &agrave; utiliser sur la page de paiement.");
define('MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES_TITLE', "Langues disponibles");
define('MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES_DESC', "S&eacute;lectionner les langues &agrave; proposer sur la page de paiement.");
define('MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY_TITLE', "D&eacute;lai avant remise en banque");
define('MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY_DESC', "Le nombre de jours avant la remise en banque (param&eacute;trable sur votre Back Office PayZen).");
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_TITLE', "Mode de validation");
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_DESC', "En mode manuel, vous devrez confirmer les paiements dans le Back Office PayZen de votre boutique.");
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_TITLE', "Types de carte");
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_DESC', "Le(s) type(s) de carte pouvant &ecirc;tre utilis&eacute;(s) pour le paiement. Ne rien s&eacute;lectionner pour utiliser la configuration de la plateforme.");
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_TITLE', "G&eacute;rer le 3DS");
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_DESC', "Montant en dessous duquel l'acheteur pourrait &ecirc;tre exempt&eacute; de l'authentification forte. N&eacute;cessite la souscription &agrave; l'option «Selective 3DS1» ou l'option  «Frictionless 3DS2». Pour plus d'informations, reportez-vous &agrave; la documentation du module.");

// Administration interface - amount restricition settings.
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MIN_TITLE', "Montant minimum");
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MIN_DESC', "Montant minimum pour lequel cette m&eacute;thode de paiement est disponible.");
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MAX_TITLE', "Montant maximum");
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MAX_DESC', "Montant maximum pour lequel cette m&eacute;thode de paiement est disponible.");

// Administration interface - back to store settings.
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED_TITLE', "Redirection automatique");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED_DESC', "Si activ&eacute;e, l'acheteur sera redirig&eacute; automatiquement vers votre site &agrave; la fin du paiement.");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT_TITLE', "Temps avant redirection (succ&egrave;s)");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT_DESC', "Temps en secondes (0-300) avant que l'acheteur ne soit redirig&eacute; automatiquement vers votre site lorsque le paiement a r&eacute;ussi.");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_TITLE', "Message avant redirection (succ&egrave;s)");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_DEFAULT', "Redirection vers la boutique dans quelques instants...");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_DESC', "Message affich&eacute; sur la page de paiement avant redirection lorsque le paiement a r&eacute;ussi.");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT_TITLE', "Temps avant redirection (&eacute;chec)");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT_DESC', "Temps en secondes (0-300) avant que l'acheteur ne soit redirig&eacute; automatiquement vers votre site lorsque le paiement a &eacute;chou&eacute;.");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_TITLE', "Message avant redirection (&eacute;chec)");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_DEFAULT', "Redirection vers la boutique dans quelques instants...");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_DESC', "Message affich&eacute; sur la page de paiement avant redirection, lorsque le paiement a &eacute;chou&eacute;.");
define('MODULE_PAYMENT_PAYZEN_RETURN_MODE_TITLE', "Mode de retour");
define('MODULE_PAYMENT_PAYZEN_RETURN_MODE_DESC', "Fa&ccedil;on dont l'acheteur transmettra le r&eacute;sultat du paiement lors de son retour &agrave; la boutique.");
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_TITLE', "Statut des commandes");
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_DESC', "D&eacute;finir le statut des commandes pay&eacute;es par ce mode de paiement.");

// Administration interface - misc constants.
define('MODULE_PAYMENT_PAYZEN_VALUE_0', "D&eacute;sactiv&eacute;");
define('MODULE_PAYMENT_PAYZEN_VALUE_1', "Activ&eacute;");

define('MODULE_PAYMENT_PAYZEN_VALIDATION_DEFAULT', "Configuration Back Office");
define('MODULE_PAYMENT_PAYZEN_VALIDATION_0', "Automatique");
define('MODULE_PAYMENT_PAYZEN_VALIDATION_1', "Manuel");

define('MODULE_PAYMENT_PAYZEN_LANGUAGE_FRENCH', "Fran&ccedil;ais");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_GERMAN', "Allemand");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_ENGLISH', "Anglais");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_SPANISH', "Espagnol");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_CHINESE', "Chinois");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_ITALIAN', "Italien");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_JAPANESE', "Japonais");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_PORTUGUESE', "Portugais");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_POLISH', "Polonais");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_DUTCH', "N&eacute;erlandais");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_SWEDISH', "Su&eacute;dois");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_RUSSIAN', "Russe");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_TURKISH', "Turc");
