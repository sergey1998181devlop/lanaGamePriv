jQuery(function() {

    Layout.initSelect2();

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

    jQuery('.tariffs_modal').remodal({
        appendTo: jQuery('.tariffs_modal_wrapper'),
        hashTracking: false
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

    // jQuery('.our_team_list').slick({
    //     infinite: true,
    //     slidesToShow: 5,
    //     slidesToScroll: 1,
    //     variableWidth: true,
    //     prevArrow: '<button type="button" class="slick-prev slick-arrow"><img src="../../img/left1.svg" alt="arrow"></button>',
    //     nextArrow: '<button type="button" class="slick-next slick-arrow"><img src="../../img/right1.svg" alt="arrow"></button>',
    //     responsive: [
    //         {
    //             breakpoint: 700,
    //             settings: {
    //                 slidesToShow: 1,
    //                 slidesToScroll: 1
    //             }
    //         }
    //     ]
    // });

    // club page (mobile) - counter photo in gallery
    let scrollLeft = 0,
        totalPhoto = jQuery('.club_page_photo_list .club_page_photo_item').length;

    jQuery('.club_page_photo_list').on('scroll', function(e) {
        let direction = this.scrollLeft >= scrollLeft ? 'right' : 'left';

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
        if (jQuery('.header_menu .log_in_block_wrapper').is(':visible')
            && jQuery(e.target).closest('.log_in_block_wrapper').length === 0
            && !jQuery(e.target).is('.log_in_form_toggle')) {
            jQuery('.header_menu .log_in_block_wrapper').hide();
            jQuery('.log_in_form_toggle').removeClass('active');
        }
    });

    jQuery('#open_search_form').on('click', function(e) {
        ym(82365286, 'reachGoal', 'search');
        gtag('event', 'send', {'event_category': 'search', 'event_action': 'click'});
        jQuery('.search .search_form').addClass('active');
        jQuery('.search .search_form #search-text').focus();

    });

    jQuery('#close_search_form').on('click', function(e) {
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

    jQuery('a[href^="#block-"]').on('click', function(e) {
        e.preventDefault();
        const _href = jQuery(this).attr('href');
        jQuery('html, body').animate({scrollTop: jQuery(_href).offset().top + 'px'});
    });

    jQuery('#gamer-mailing-form,#owner-mailing-form').on('submit', function(e) {
        e.preventDefault();
        let $form = jQuery(this);
        jQuery.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
            success: function() {
                jQuery('[data-remodal-id="mailing_success_modal"]').remodal().open();
            }
        });
    });

    jQuery('[data-fancybox]').fancybox({
        loop: true
    });

    jQuery('.remodal.mailing_modal').on('opening', function(e) {
        jQuery(this).find('form input[name="email"]').val('');
    });

    jQuery('.offer_content_wrapper').on('click', '.show_offer_contacts', function(e) {
        jQuery(this).closest(jQuery('.offer_content_wrapper')).find('.contacts_wrapper').show();
        jQuery(this).hide();
    });

    jQuery('.offer_instr_toggle_mobile').on('click', function(e) {
        jQuery(this).toggleClass('active');
        jQuery(this).closest('.attention_text_wrapper').find('.instr').toggle();
    });

    jQuery('[data-open-select-city]').on('click', function(e) {
        $('#city_selector').select2('open');
        e.preventDefault();
        const _href = jQuery(this).attr('href');
        jQuery('html, body').animate({scrollTop: jQuery(_href).offset().top + 'px'});
    });

    jQuery('[data-recaptcha-form]').on('submit', function(e) {
        let $form = jQuery(this),
            response = window.grecaptcha.getResponse();

        if (!response) {
            e.preventDefault();

            window.recaptchaForm = this;

            $form.find('.recaptcha-holder').addClass('active');
            $form.find('[type="submit"]').hide();
        }
    });

    jQuery('#search-form').on('submit', function(e) {
        e.preventDefault();
    });

    jQuery('#report-club-form').on('submit', function(e) {
        e.preventDefault();

        jQuery.ajax({
            type: 'POST',
            url: jQuery(this).attr('action'),
            data: jQuery(this).serialize(),
            success: function() {
                jQuery('[data-remodal-id="success_modal"]').remodal().open();
            }
        });
    });
});

function recaptchaCallback() {
    window.recaptchaForm?.submit();
}
