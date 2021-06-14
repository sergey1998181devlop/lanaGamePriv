/**
 * show all club photo modal
 */
jQuery(function() {
    let $modal = jQuery('[data-remodal-id="club_photo_modal"]'),
        $slick = jQuery('.club_photo_modal_wrapper'),
        $counter = jQuery('#show_club_photo_counter_slide');

    if ($modal.length === 0) {
        return;
    }

    let total_count = $slick.find('.slide_item').length;
    setCounterText(0);

    $modal.on('opened', function() {
        $slick.slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: '<button type="button" class="slick-prev slick-arrow"><img src="/img/left.svg" alt="arrow"></button>',
            nextArrow: '<button type="button" class="slick-next slick-arrow"><img src="/img/right.svg" alt="arrow"></button>'
        });

        $slick.on('beforeChange', function(e, slick, currentSlide, nextSlide) {
            setCounterText(nextSlide);
        });
    });

    $modal.on('closed', function() {
        jQuery('.club_photo_modal_wrapper').slick('unslick');
    });

    function setCounterText(slide) {
        $counter.text(`${slide + 1} / ${total_count}`);
    }
});