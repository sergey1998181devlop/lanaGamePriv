jQuery(function() {
    let $form = jQuery('.hide-from-search-form'),
        $input = $form.find('input[type="checkbox"]');

    if ($form.length === 0) {
        return;
    }

    $input.on('change', function(e) {
        jQuery.ajax({
            type: 'POST',
            url: '',
            data: {
                status: $input.prop('checked') ? 'hidden' : 'active'
            },
            success: function() {

            }
        });
    });
});