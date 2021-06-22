<?php
/**
 * Copyright © Lyra Network.
 * This file is part of PayZen plugin for ZenCart. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */
?>

<script type="text/javascript">
    function payzenMultiDisplayOptions() {
        var payzenMultiDivOptions = $('#pmt-payzen_multi').nextAll( ".ccinfo" ).first();
        if(jQuery('#pmt-payzen_multi').is(':checked')) {
            payzenMultiDivOptions.show();
        } else {
            payzenMultiDivOptions.hide();
        }
    }

    jQuery( document ).ready(function() {
        payzenMultiDisplayOptions()

        jQuery('fieldset.payment input').click(function() {
            payzenMultiDisplayOptions()
        });
    });
</script>
