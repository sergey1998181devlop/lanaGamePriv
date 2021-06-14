$(document).on('change','.hide-from-search-form input[type="checkbox"]',function(){
    jQuery.ajax({
        type: 'get',
        url:$(this).closest('form').attr('action') ,
        success: function() {
        },
        error: function() {
        }
    });
})