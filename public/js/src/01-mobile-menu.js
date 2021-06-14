jQuery(function() {
    let $body = jQuery('body');

    jQuery('.mobile_menu_btn').on('click', function(e) {
        e.preventDefault();
        $body.toggleClass('mobile-menu-opened');
    });

    jQuery('.mobile_menu_bg').on('click', function() {
        $body.removeClass('mobile-menu-opened');
    });
});

