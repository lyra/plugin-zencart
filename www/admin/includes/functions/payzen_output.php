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
 * General functions to draw gateway configuration parameters.
 */

// Include tools class.
require_once (DIR_FS_CATALOG . 'includes/classes/payzen_tools.php');

global $payzen_supported_languages, $payzen_supported_cards;

// Detect CMS encoding.
$charset = (defined('CHARSET')) ? CHARSET : 'UTF-8';

// Load gateway payment API.
$payzenApi = new PayzenApi($charset);

$payzen_supported_languages = $payzenApi->getSupportedLanguages();
$payzen_supported_cards = $payzenApi->getSupportedCardTypes();


function payzen_get_bool_title($value)
{
    $key = 'MODULE_PAYMENT_PAYZEN_VALUE_' . $value;

    if (defined($key)) {
        return constant($key);
    }

    return $value;
}

function payzen_get_lang_title($value)
{
    global $payzen_supported_languages;

    $key = 'MODULE_PAYMENT_PAYZEN_LANGUAGE_' . strtoupper($payzen_supported_languages[$value]);

    if (defined($key)) {
        return constant($key);
    }

    return $value;
}

function payzen_get_multi_lang_title($value)
{
    if (! empty($value)) {
        $langs = explode(';', $value);

        $result = array();
        foreach ($langs as $lang) {
            $result[] = payzen_get_lang_title($lang);
        }

        return implode(', ', $result);
    }

    return '';
}

function payzen_get_validation_mode_title($value)
{
    $key = 'MODULE_PAYMENT_PAYZEN_VALIDATION_' . $value;

    if (defined($key)) {
        return constant($key);
    }

    return MODULE_PAYMENT_PAYZEN_VALIDATION_DEFAULT;
}

function payzen_get_card_title($value)
{
    global $payzen_supported_cards;

    if (! empty($value)) {
        $cards = explode(';', $value);

        $result = array();
        foreach ($cards as $card) {
            $result[] = $payzen_supported_cards[$card];
        }

        return implode(', ', $result);
    }

    return '';
}

function payzen_get_multi_options($value)
{
    if (! $value) {
        return '';
    }

    $options = json_decode($value, true);
    if (! is_array($options) || empty($options)) {
        return '';
    }

    $field = '<table>';
    $field .= '<thead><tr>';
    $field .= '<th style="padding: 2px;">' . MODULE_PAYMENT_PAYZEN_OPTIONS_LABEL . '</th>';
    $field .= '<th style="padding: 2px;">' . MODULE_PAYMENT_PAYZEN_OPTIONS_MIN_AMOUNT . '</th>';
    $field .= '<th style="padding: 2px;">' . MODULE_PAYMENT_PAYZEN_OPTIONS_MAX_AMOUNT . '</th>';
    $field .= '<th style="padding: 2px;">' . MODULE_PAYMENT_PAYZEN_OPTIONS_CONTRACT . '</th>';
    $field .= '<th style="padding: 2px;">' . MODULE_PAYMENT_PAYZEN_OPTIONS_COUNT . '</th>';
    $field .= '<th style="padding: 2px;">' . MODULE_PAYMENT_PAYZEN_OPTIONS_PERIOD . '</th>';
    $field .= '<th style="padding: 2px;">' . MODULE_PAYMENT_PAYZEN_OPTIONS_FIRST . '</th>';
    $field .= '</tr></thead>';

    $field .= '<tbody>';
    foreach ($options as $option) {
        $field .= '<tr>';
        $field .= '<td style="padding: 2px;">' . $option['label'] . '</td>';
        $field .= '<td style="padding: 2px;">' . $option['min_amount'] . '</td>';
        $field .= '<td style="padding: 2px;">' . $option['max_amount'] . '</td>';
        $field .= '<td style="padding: 2px;">' . $option['contract'] . '</td>';
        $field .= '<td style="padding: 2px;">' . $option['count'] . '</td>';
        $field .= '<td style="padding: 2px;">' . $option['period'] . '</td>';
        $field .= '<td style="padding: 2px;">' . $option['first'] . '</td>';
        $field .= '</tr>';
    }

    $field .= '</tbody></table>';

    return $field;
}

function payzen_cfg_draw_pull_down_bools($value, $name)
{
    $name = 'configuration[' . zen_output_string($name) . ']';
    if (empty($value) && isset($GLOBALS[$name])) $value = stripslashes($GLOBALS[$name]);

    $bools = array('1', '0');

    $field = '';
    foreach ($bools as $bool) {
        $field .= '<input type="radio" name="' . $name . '" value="' . $bool . '"';
        if ($value === $bool) {
            $field .= ' checked="checked"';
        }

        $field .= '> ' . zen_output_string(payzen_get_bool_title($bool)) . '<br />';
    }

    return $field;
}

function payzen_cfg_draw_pull_down_signature_algorithm($value, $name)
{
    $name = 'configuration[' . zen_output_string($name) . ']';

    if (empty($value) && isset($GLOBALS[$name])) $value = stripslashes($GLOBALS[$name]);
    $supported_algorithms = array('SHA-1' => 'SHA-1', 'SHA-256' => 'HMAC-SHA-256');

    $field = '<select name="' . $name . '">';
    foreach ($supported_algorithms as $algo => $algo_title) {
        $field .= '<option value="' . $algo . '"';
        if ($value === $algo) {
            $field .= ' selected="selected"';
        }

        $field .= '>' . $algo_title . '</option>';
    }

    $field .= '</select>';

    return $field;
}

function payzen_cfg_draw_pull_down_validation_modes($value, $name)
{
    $name = 'configuration[' . zen_output_string($name) . ']';

    if (empty($value) && isset($GLOBALS[$name])) $value = stripslashes($GLOBALS[$name]);
    $modes = array('', '0', '1');

    $field = '<select name="' . $name . '">';
    foreach ($modes as $mode) {
        $field .= '<option value="' . $mode . '"';
        if ($value === $mode) {
            $field .= ' selected="selected"';
        }

        $field .= '>' . zen_output_string(payzen_get_validation_mode_title($mode)) . '</option>';
    }

    $field .= '</select>';

    return $field;
}

function payzen_cfg_draw_pull_down_langs($value, $name)
{
    global $payzen_supported_languages;

    $name = 'configuration[' . zen_output_string($name) . ']';
    if (empty($value) && isset($GLOBALS[$name])) $value = stripslashes($GLOBALS[$name]);

    $field = '<select name="' . $name . '">';
    foreach ($payzen_supported_languages as $key => $label) {
        $field .= '<option value="' . $key . '"';
        if ($value === $key) {
            $field .= ' selected="selected"';
        }

        $field .= '>' . zen_output_string(payzen_get_lang_title($key)) . '</option>';
    }

    $field .= '</select>';

    return $field;
}

function payzen_cfg_draw_pull_down_multi_langs($value, $name)
{
    global $payzen_supported_languages;

    $fieldName = 'configuration[' . zen_output_string($name) . ']';
    if (empty($value) && isset($GLOBALS[$fieldName])) $value = stripslashes($GLOBALS[$fieldName]);

    $langs = empty($value) ? array() : explode(';', $value);

    $field = '<select name="' . zen_output_string($name) . '" multiple="multiple" onChange="JavaScript:payzenProcessLangs()">';
    foreach ($payzen_supported_languages as $key => $label) {
        $field .= '<option value="' . $key . '"';
        if (in_array($key, $langs)) {
            $field .= ' selected="selected"';
        }

        $field .= '>' . zen_output_string(payzen_get_lang_title($key)) . '</option>';
    }

    $field .= '</select> <br />';

    $field .= <<<JSCODE
    <script type="text/javascript">
        function payzenProcessLangs() {
            var elt = document.forms['modules'].elements['$name'];

            var result = '';
            for (var i=0; i < elt.length; i++) {
                if (elt[i].selected) {
                    if (result) {
                        result += ';';
                    }

                    result += elt[i].value;
                }
            }

            document.forms['modules'].elements['$fieldName'].value = result;
        }
    </script>
JSCODE;

    $field .= '<input type="hidden" name="' . zen_output_string($fieldName) . '" value="' . $value . '">';

    return $field;
}

function payzen_cfg_draw_pull_down_cards($value, $name)
{
    global $payzen_supported_cards;

    $fieldName = 'configuration[' . zen_output_string($name) . ']';
    if (empty($value) && isset($GLOBALS[$fieldName])) $value = stripslashes($GLOBALS[$fieldName]);

    $cards = empty($value) ? array() : explode(';', $value);

    $field = '<select name="' . zen_output_string($name) . '" multiple="multiple" onChange="JavaScript:payzenProcessCards()">';
    foreach ($payzen_supported_cards as $key => $label) {
        $field .= '<option value="' . $key . '"';
        if (in_array($key, $cards)) {
            $field .= ' selected="selected"';
        }

        $field .= '>' . zen_output_string($label) . '</option>';
    }

    $field .= '</select> <br />';

    $field .= <<<JSCODE
    <script type="text/javascript">
        function payzenProcessCards() {
            var elt = document.forms['modules'].elements['$name'];

            var result = '';
            for (var i=0; i < elt.length; i++) {
                if (elt[i].selected) {
                    if (result) {
                        result += ';';
                    }

                    result += elt[i].value;
                }
            }

            document.forms['modules'].elements['$fieldName'].value = result;
        }
    </script>
JSCODE;

    $field .= '<input type="hidden" name="' . zen_output_string($fieldName) . '" value="' . $value . '">';

    return $field;
}

function payzen_cfg_draw_table_multi_options($value='', $name)
{
    $name = zen_output_string($name);

    $fieldName = 'configuration[' . $name . ']';
    if (empty($value) && isset($GLOBALS[$fieldName])) $value = stripslashes($GLOBALS[$fieldName]);

    $options = empty($value) ? array() : json_decode(html_entity_decode($value), true);

    $field = '<input id="' . $name . '_btn" class="' . $name . '_btn"' . (! empty($options) ? ' style="display: none;"' : '') . ' type="button" value="' . MODULE_PAYMENT_PAYZEN_OPTIONS_ADD . '" />';
    $field .= '<br /><div style="overflow-x: scroll;">';
    $field .= '<div style="width: 200px;">';
    $field .= '<table id="' . $name . '_table"'  . (empty($options) ? ' style="display: none; overflow-x: scroll;"' : 'style="overflow-x: scroll;"') . '>';
    $field .= '<thead><tr>';
    $field .= '<th style="padding: 2px;">' . MODULE_PAYMENT_PAYZEN_OPTIONS_LABEL . '</th>';
    $field .= '<th style="padding: 2px;">' . MODULE_PAYMENT_PAYZEN_OPTIONS_MIN_AMOUNT . '</th>';
    $field .= '<th style="padding: 2px;">' . MODULE_PAYMENT_PAYZEN_OPTIONS_MAX_AMOUNT . '</th>';
    $field .= '<th style="padding: 2px;">' . MODULE_PAYMENT_PAYZEN_OPTIONS_CONTRACT . '</th>';
    $field .= '<th style="padding: 2px;">' . MODULE_PAYMENT_PAYZEN_OPTIONS_COUNT . '</th>';
    $field .= '<th style="padding: 2px;">' . MODULE_PAYMENT_PAYZEN_OPTIONS_PERIOD . '</th>';
    $field .= '<th style="padding: 2px;">' . MODULE_PAYMENT_PAYZEN_OPTIONS_FIRST . '</th>';
    $field .= '<th style="padding: 2px;"></th>';
    $field .= '</tr></thead>';

    $field .= '<tbody>';
    $field .= '<tr id="' . $name . '_add">
                <td colspan="7"></td>
                <td style="padding: 2px;"><input class="' . $name . '_btn" type="button" value="' . MODULE_PAYMENT_PAYZEN_OPTIONS_ADD . '" /></td>
               </tr>';
    $field .= '</tbody></table></div></div>';

    $field .= "\n" . '<script type="text/javascript">';

    $field .= "\n" . 'jQuery(".' . $name . '_btn").click(function() {
                        payzenAddOption("' . $name . '");
                     });';

    // Add already inserted lines.
    if (! empty($options)) {
        foreach ($options as $code => $option) {
            $field .= "\n" . 'payzenAddOption("' . $name . '", "' . $code . '", ' . json_encode($option) . ');' . "\n";
        }
    }

    $deleteTxt = MODULE_PAYMENT_PAYZEN_OPTIONS_DELETE;

    $js_serialize = payzen_js_serialize($name);

    $field .= <<<JSCODE
        $js_serialize

        function payzenAddOption(name, key, record) {
            if (jQuery('#' + name + '_table tbody tr').length == 1) {
                jQuery('#' + name + '_btn').css('display', 'none');
                jQuery('#' + name + '_table').css('display', '');
            }

            if (! key && ! record) {
                // New line, generate key and use empty record.
                key = new Date().getTime();
                record = { label: "", min_amount: "", max_amount: "", contract: "", count: "", period: "", first: "" };
            }

            var inputPrefix = name + '[' + key + ']';

            var optionLine = '<tr id="' + name + '_line_' + key + '">';
            optionLine += '<td style="padding: 2px;"><input style="width: 152px;" name="' + inputPrefix + '[label]" type="text" value="' + record['label'] + '" /></td>';
            optionLine += '<td style="padding: 2px;"><input style="width: 75px;" name="' + inputPrefix + '[min_amount]" type="text" value="' + record['min_amount'] + '" /></td>';
            optionLine += '<td style="padding: 2px;"><input style="width: 75px;" name="' + inputPrefix + '[max_amount]" type="text" value="' + record['max_amount'] + '" /></td>';
            optionLine += '<td style="padding: 2px;"><input style="width: 65px;" name="' + inputPrefix + '[contract]" type="text" value="' + record['contract'] + '" /></td>';
            optionLine += '<td style="padding: 2px;"><input style="width: 65px;" name="' + inputPrefix + '[count]" type="text" value="' + record['count'] + '" /></td>';
            optionLine += '<td style="padding: 2px;"><input style="width: 65px;" name="' + inputPrefix + '[period]" type="text" value="' + record['period'] + '" /></td>';
            optionLine += '<td style="padding: 2px;"><input style="width: 75px;" name="' + inputPrefix + '[first]" type="text" value="' + record['first'] + '" /></td>';
            optionLine += '<td style="padding: 2px;"><input type="button" value="$deleteTxt" onclick="javascript: payzenDeleteOption(\'' + name + '\', \'' + key + '\');" /></td>';
            optionLine += '</tr>';

            jQuery(optionLine).insertBefore('#' + name + '_add');
        }

        function payzenDeleteOption(name, key) {
            jQuery('#' + name + '_line_' + key).remove();

            if (jQuery('#' + name + '_table tbody tr').length == 1) {
                jQuery('#' + name + '_btn').css('display', '');
                jQuery('#' + name + '_table').css('display', 'none');
            }
        }
    </script>
JSCODE;

    $field .= '<input type="hidden" name="' . $fieldName . '" value="' . $value . '">';

    return $field;
}

function payzen_js_serialize($name)
{
    $fieldName = 'configuration[' . $name . ']';

    $js_code = <<<JSCODE
    var JSON = JSON || {};

    // Implement JSON.stringify serialization.
    JSON.stringify || function(obj) {
        var t = typeof (obj);
        if (t != "object" || obj === null) {
            // Simple data type.
            if (t == "string") obj = '"' + obj + '"';
            return String(obj);
        } else {
            // Recurse array or object.
            var n, v, json = [], arr = (obj && obj.constructor == Array);

            for (n in obj) {
                v = obj[n]; t = typeof(v);

                if (t == "string") v = '"'+v+'"';
                else if (t == "object" && v !== null) v = JSON.stringify(v);

                json.push((arr ? "" : '"' + n + '":') + String(v));
            }

            return (arr ? "[" : "{") + String(json) + (arr ? "]" : "}");
        }
    };

    jQuery(document.forms['modules']).submit(function(event) {
        var options = {};

        jQuery('#$name' + '_table tbody tr td input[type=text]').each(function() {
            var name = jQuery(this).attr('name');
            name = name.replace(/\]/g, '');

            var keys = name.split('[');
            keys.shift();

            options = payzenFillArray(options, keys, jQuery(this).val());
        });

            document.forms['modules'].elements['$fieldName'].value = JSON.stringify(options);
            return true;
    });

    function payzenFillArray(arr, keys, val) {
        if (keys.length > 0) {
            var key = keys[0];

            if (keys.length == 1) {
                // It's a leaf, let's set the value.
                arr[key] = val;
            } else {
                keys.shift();

                if (! arr[key]) {
                    arr[key] = {};
                }

                arr[key] = payzenFillArray(arr[key], keys, val);
            }
        }

        return arr;
    }
JSCODE;

    return $js_code;
}
