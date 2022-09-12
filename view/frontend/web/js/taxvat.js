require(
    [
        'jquery',
    ], function(jQuery){
        jQuery("#taxvat").blur(function (e) {
            let taxvat = jQuery('#taxvat').val();
            jQuery.ajax({
                url:  '/abraaomarques_taxvatvalidator/validate/taxvat/',
                type: 'POST',
                data: {'taxvat': taxvat},
                success: function(response) {
                    if (response['message']) {
                        jQuery("input#taxvat").val("");
                        jQuery("#taxvat-error").remove();
                        jQuery("input#taxvat").addClass("mage-error");
                        jQuery("input#taxvat").after("<div for='taxvat' generated='true' class='mage-error' id='taxvat-error'>"+response['message']+"</div>")
                    } else {
                        if (jQuery("#taxvat-error").length) {
                            jQuery("#taxvat-error").remove();
                            jQuery("input#taxvat").removeClass("mage-error");
                        }
                    }
                },
            });
        });
    }
);
