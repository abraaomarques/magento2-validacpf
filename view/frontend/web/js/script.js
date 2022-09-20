require(
    [
        'jquery',
        'AbraaoMarques_TaxvatValidator/js/jquery.inputmask.bundle'
    ],
    function(jQuery) {
        jQuery("#taxvat").inputmask({
            mask: ['999.999.999-99', '99.999.999/9999-99'],
            keepStatic: true
        })
    }
)
