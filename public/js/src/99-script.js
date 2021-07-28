jQuery(function() {

    Layout.initSelect2();

    jQuery('.club_page_services_list .club_services_mobile_toggle').addClass('active');
    jQuery('.club_page_services_list .mob_hide').addClass('active');


    jQuery('.club_page_services_list .club_services_mobile_toggle').on('click', function(e) {
        jQuery(this).toggleClass('active')
            .closest('.club_page_services_list').toggleClass('mob_toggle')
            .find('.mob_hide').toggleClass('active');
    });

    jQuery('input[type="tel"]').inputmask({
        mask: '+7 (999) 999-99-99',
        removeMaskOnSubmit: true,
        onincomplete: function() {
            this.value = '';
        },
        'oncomplete': function() {
            if ($(this).attr('id') == 'log-in-phone-input') {
                $('#log-in-password-input').focus();
            }
        }
    });

    jQuery('input[type="number"]').on('input change', function(e) {
        let input_val = +jQuery(this).val();

        if (input_val <= 0 || isNaN(input_val)) {
            jQuery(this).val('');
        }
    });

    jQuery('ul.club_list_navigation_tabs li a').on('click', function(e) {
        e.preventDefault();

        let $this = jQuery(this),
            $tab = jQuery($this.attr('href'));

        if ($this.is('.active')) {
            return;
        }

        jQuery('ul.club_list_navigation_tabs li a.active').removeClass('active');

        $this.addClass('active');
        $tab.show();

        jQuery('.club_list_content_tabs .tab').not($tab).hide();
    });

    jQuery('.club_page_toggle_content').on('click', function(e) {
        jQuery(this).closest('.toggle_block_wrapper').find('.toggle_block').toggle();
        jQuery(this).toggleClass('active');
    });

    jQuery('.review_content_wrapper').scrollbar();

    jQuery('.person_add_club_modal').remodal({
        appendTo: jQuery('.person_add_club_modal_wrapper'),
        hashTracking: false,
        closeOnOutsideClick: false
    });

    jQuery('.show_club_price_list_modal').remodal({
        appendTo: jQuery('.club_page_modals_wrapper'),
        hashTracking: false,
        closeOnOutsideClick: false
    });

    jQuery('.show_club_photo_modal').remodal({
        appendTo: jQuery('.club_page_modals_wrapper'),
        hashTracking: false,
        closeOnOutsideClick: false
    });

    jQuery('.club_page_reviews_list').slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        variableWidth: true,
        prevArrow: '<button type="button" class="slick-prev slick-arrow"><img src="../../img/left1.svg" alt="arrow"></button>',
        nextArrow: '<button type="button" class="slick-next slick-arrow"><img src="../../img/right1.svg" alt="arrow"></button>',
        responsive: [
            {
                breakpoint: 700,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    jQuery('.our_team_list').slick({
        infinite: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        variableWidth: true,
        prevArrow: false,
        nextArrow: false,
        responsive: [
            {
                breakpoint: 700,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    // club page (mobile) - counter photo in gallery
    let scrollLeft = 0,
        totalPhoto = jQuery('.club_page_photo_list .club_page_photo_item').length;

    jQuery('.club_page_photo_list').on('scroll',function(e) {
        let direction = this.scrollLeft >= scrollLeft  ? 'right' : 'left';

        scrollLeft = this.scrollLeft;

        let activeIndex = getActiveSlide(this, '.club_page_photo_item', direction);

        jQuery(this).closest('.club_page_photo_wrapper').find('.counter').text(`${activeIndex + 1} / ${totalPhoto}`);
    });

    jQuery(window).on('resize', function(e) {
        jQuery('.club_page_photo_list').trigger('scroll');
    });

    jQuery('.club_page_photo_list').trigger('scroll');

    function getActiveSlide(list, item, direction) {
        let slides = [];

        jQuery(list).find(item).each(function(index, element) {
            slides.push({
                index: index,
                x: element.getBoundingClientRect().x
            });
        });

        let sortedSlides = slides
            .filter(({x}) => direction === 'right' ? x >= 0 : x <= 0)
            .sort((a, b) => Math.abs(a.x) - Math.abs(b.x));

        return sortedSlides?.[0]?.index || 0;
    }

    jQuery('.log_in_form_toggle').on('click', function(e) {
        e.preventDefault();
        jQuery('.header_menu .log_in_block_wrapper').toggle();
        jQuery(this).toggleClass('active');
    });

    jQuery(document).on('click', function(e) {
        if(jQuery('.header_menu .log_in_block_wrapper').is(':visible')
            && jQuery(e.target).closest('.log_in_block_wrapper').length === 0
            && !jQuery(e.target).is('.log_in_form_toggle')){
            jQuery('.header_menu .log_in_block_wrapper').hide();
            jQuery('.log_in_form_toggle').removeClass('active');
        }
    });

    jQuery('#open_search_form').on('click', function(e){
        jQuery('.search .search_form').addClass('active');
    });


    jQuery('#close_search_form').on('click', function(e){
        jQuery('.search .search_form').removeClass('active');
    });

    jQuery('.langame_software_options .option').on('click', function(e) {
        jQuery(this).closest('.option_item').toggleClass('active');
    });

    /**
     * Scroll page handlers
     */
    (() => {
        jQuery(window).on('scroll resize', function() {
            jQuery('[data-track-sticky]').each(function() {
                let $this = jQuery(this),
                    y = this.getBoundingClientRect().y;

                $this
                    .toggleClass('sticky', y === 0)
                    .toggleClass('not-sticky', y !== 0);
            });
        });
    })();
});
