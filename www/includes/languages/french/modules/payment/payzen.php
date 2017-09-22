<?php
/**
 * PayZen V2-Payment Module version 1.5.0 for zencart 1.3.x. Support contact : support@payzen.eu.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @category  payment
 * @package   payzen
 * @author    Lyra Network (http://www.lyra-network.com/)
 * @copyright 2014-2015 Lyra Network and contributors
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html  GNU General Public License (GPL v2)
 * @version   1.5.0 (revision 67237)
*/

## CATALOG MESSAGES ##
define('MODULE_PAYMENT_PAYZEN_TITLE', "PayZen - Paiement s�curis� par carte bancaire");
define('MODULE_PAYMENT_PAYZEN_TECHNICAL_ERROR', "Une erreur est survenue dans le processus de paiement.");
define('MODULE_PAYMENT_PAYZEN_PAYMENT_ERROR', "Votre commande n'a pas pu �tre confirm�e. Le paiement n'a pas �t� accept�.");
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN', "La validation automatique n'a pas fonctionn�. Avez-vous configur� correctement l'URL de notification dans le Back Office PayZen ?");
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN_DETAIL', "Afin de comprendre la probl�matique, reportez vous � la documentation du module :<br />&nbsp;&nbsp;&nbsp;- Chapitre �A lire attentivement avant d'aller loin�<br />&nbsp;&nbsp;&nbsp;- Chapitre �Param�trage de l'URL de notification�.");
define('MODULE_PAYMENT_PAYZEN_GOING_INTO_PROD_INFO', "<b>PASSAGE EN PRODUCTION :</b> Vous souhaitez savoir comment passer votre boutique en production, merci de consulter cette URL : ");
define('MODULE_PAYMENT_PAYZEN_MAINTENANCE_MODE_WARN' , "La boutique est en mode maintenance. La notification automatique ne peut fonctionner.");

## ADMINISTRATION INTERFACE - INFORMATIONS ##
define('MODULE_PAYMENT_PAYZEN_MODULE_INFORMATION', "INFORMATIONS SUR LE MODULE");
define('MODULE_PAYMENT_PAYZEN_DEVELOPED_BY', "D�velopp� par : ");
define('MODULE_PAYMENT_PAYZEN_CONTACT_EMAIL', "Courriel de contact : ");
define('MODULE_PAYMENT_PAYZEN_CONTRIB_VERSION', "Version du module : ");
define('MODULE_PAYMENT_PAYZEN_GATEWAY_VERSION', "Version de la plateforme : ");
define('MODULE_PAYMENT_PAYZEN_CHECK_URL', "URL de notification � copier dans le Back Office PayZen: <br />");

## ADMINISTRATION INTERFACE - MODULE SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_STATUS_TITLE', "Activation");
define('MODULE_PAYMENT_PAYZEN_STATUS_DESC', "Activer / d�sactiver le module de paiement PayZen.");
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_TITLE', "Ordre d'affichage");
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_DESC', "Le plus petit indice est affich� en premier.");
define('MODULE_PAYMENT_PAYZEN_ZONE_TITLE', "Zone de paiement");
define('MODULE_PAYMENT_PAYZEN_ZONE_DESC', "Si une zone est choisie, ce mode de paiement ne sera effectif que pour celle-ci.");

## ADMINISTRATION INTERFACE - PLATFORM SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_SITE_ID_TITLE', "Identifiant boutique");
define('MODULE_PAYMENT_PAYZEN_SITE_ID_DESC', "Identifiant fourni par PayZen.");
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_TITLE', "Certificat en mode test");
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_DESC', "Certificat fourni par PayZen pour le mode test (disponible sur le Back Office de votre boutique).");
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_TITLE', "Certificat en mode production");
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_DESC', "Certificat fourni par PayZen (disponible sur le Back Office de votre boutique apr�s passage en production).");
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_TITLE', "Mode");
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_DESC', "Mode de fonctionnement du module.");
define('MODULE_PAYMENT_PAYZEN_PLATFORM_URL_TITLE', "URL de la page de paiement");
define('MODULE_PAYMENT_PAYZEN_PLATFORM_URL_DESC', "URL vers laquelle l'acheteur sera redirig� pour le paiement.");

## ADMINISTRATION INTERFACE - PAYMENT SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_TITLE', "Langue par d�faut");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_DESC', "S�lectionner la langue par d�faut � utiliser sur la page de paiement.");
define('MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES_TITLE', "Langues disponibles");
define('MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES_DESC', "S�lectionner les langues � proposer sur la page de paiement.");
define('MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY_TITLE', "D�lai avant remise en banque");
define('MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY_DESC', "Le nombre de jours avant la remise en banque (param�trable sur votre Back Office PayZen).");
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_TITLE', "Mode de validation");
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_DESC', "En mode manuel, vous devrez confirmer les paiements dans le Back Office de votre boutique.");
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_TITLE', "Types de carte");
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_DESC', "Le(s) type(s) de carte pouvant �tre utilis�(s) pour le paiement. Ne rien s�lectionner pour utiliser la configuration de la plateforme.");
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_TITLE', "Montant minimum pour lequel activer 3-DS");
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_DESC', "N�cessite la souscription � l'option 3-D Secure s�lectif.");

## ADMINISTRATION INTERFACE - AMOUNT RESTRICTIONS SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MIN_TITLE', "Montant minimum");
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MIN_DESC', "Montant minimum pour lequel cette m�thode de paiement est disponible.");
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MAX_TITLE', "Montant maximum");
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MAX_DESC', "Montant maximum pour lequel cette m�thode de paiement est disponible.");

## ADMINISTRATION INTERFACE - BACK TO STORE SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED_TITLE', "Redirection automatique");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED_DESC', "Si activ�e, l'acheteur sera redirig� automatiquement vers votre site � la fin du paiement.");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT_TITLE', "Temps avant redirection (succ�s)");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT_DESC', "Temps en secondes (0-300) avant que l'acheteur ne soit redirig� automatiquement vers votre site lorsque le paiement a r�ussi.");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_TITLE', "Message avant redirection (succ�s)");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_DESC', "Message affich� sur la page de paiement avant redirection lorsque le paiement a r�ussi.");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT_TITLE', "Temps avant redirection (�chec)");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT_DESC', "Temps en secondes (0-300) avant que l'acheteur ne soit redirig� automatiquement vers votre site lorsque le paiement a �chou�.");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_TITLE', "Message avant redirection (�chec)");
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_DESC', "Message affich� sur la page de paiement avant redirection, lorsque le paiement a �chou�.");
define('MODULE_PAYMENT_PAYZEN_RETURN_MODE_TITLE', "Mode de retour");
define('MODULE_PAYMENT_PAYZEN_RETURN_MODE_DESC', "Fa�on dont l'acheteur transmettra le r�sultat du paiement lors de son retour � la boutique.");
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_TITLE', "Statut des commandes");
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_DESC', "Definir le statut des commandes pay�es par ce mode de paiement.");

## ADMINISTRATION INTERFACE - MISC CONSTANTS ##
define('MODULE_PAYMENT_PAYZEN_VALUE_0', "D�sactiv�");
define('MODULE_PAYMENT_PAYZEN_VALUE_1', "Activ�");

define('MODULE_PAYMENT_PAYZEN_VALIDATION_DEFAULT', "Configuration Back Office");
define('MODULE_PAYMENT_PAYZEN_VALIDATION_0', "Automatique");
define('MODULE_PAYMENT_PAYZEN_VALIDATION_1', "Manuel");

define('MODULE_PAYMENT_PAYZEN_LANGUAGE_FRENCH', "Fran�ais");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_GERMAN', "Allemand");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_ENGLISH', "Anglais");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_SPANISH', "Espagnol");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_CHINESE', "Chinois");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_ITALIAN', "Italien");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_JAPANESE', "Japonais");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_PORTUGUESE', "Portugais");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_POLISH', "Polonais");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_DUTCH', "N�erlandais");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_SWEDISH', "Su�dois");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_RUSSIAN', "Russe");
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_TURKISH', "Turc");
?>