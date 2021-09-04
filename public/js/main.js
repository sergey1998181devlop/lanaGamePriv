jQuery(function() {
    geo();

    window.lazyLoadInstance = new LazyLoad({
        // Your custom settings go here
    });
});

function geo() {
    var md = new MobileDetect(window.navigator.userAgent);

    if (md.mobile()) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                if (getCookie('lat') != position.coords.latitude && getCookie('lon') != position.coords.longitude) {
                    document.cookie = 'lat=' + position.coords.latitude;
                    document.cookie = 'lon=' + position.coords.longitude;
                    jQuery.ajax({
                        type: 'get',
                        url: '',
                        data: {'page': 1},
                        success: function(data) {
                            correntPage++;
                            jQuery('.sc_list').html(data.html);
                            if (data.last == correntPage) {
                                jQuery('#show_more_clubs').hide();
                            }
                            jQuery('.club_distance').css('display', 'flex');
                        }
                    });
                }
                jQuery('.club_distance').css('display', 'flex');
            },
            function(error) {
                //доступ закрыт к координатам браузера. оставляем координаты от яндекса в куках
                jQuery('.sort_by_options a').last().on('click', function() {
                    if (!getCookie('show_geo_alert')) {
                        document.cookie = 'show_geo_alert=1';
                        jQuery('a[data-remodal-target=get_geo]').click();
                        jQuery('.get_geo .remodal-close').on('click', function() {
                            window.location.href = jQuery('.sort_by_options a').last().attr('href');
                        });
                        return false;
                    } else {
                        return true;
                    }
                });
            }
        );
        jQuery('.sort_by_options a').last().show();
    }
}

function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        '(?:^|; )' + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + '=([^;]*)'
    ));

    return matches ? decodeURIComponent(matches[1]) : undefined;
}
