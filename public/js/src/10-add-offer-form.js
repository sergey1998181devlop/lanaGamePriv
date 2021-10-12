jQuery(function() {
    let $form = jQuery('#add-offer-form'),
        $upload_file_input = jQuery('#add-photo-offer-input'),
        $upload_hidden_input = jQuery('#offer_photos_input'),
        $offer_img_wrapper = jQuery('.offer_img_wrapper'),
        $add_offer_photo_text = jQuery('.add-offer-photo-text');

    $form.on('submit', function(e) {
        e.preventDefault();

        jQuery.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
            success: function() {
                $form.text("Объявление успешно отправлено. Ожидайте обратной связи.");
            }
        });
    });

    $upload_file_input.on('change', function(e) {
        if(this.files.length === 0){
            $add_offer_photo_text.text('Загрузить');
            changeOfferImage('');
            return;
        }

        let file = this.files[0];

        Layout.fileUpload(file).then((img_url) => {
            $add_offer_photo_text.text('Фото загружено');
            $offer_img_wrapper.append('<button type="button" data-role-remove-price-list-event></button>');
            changeOfferImage(img_url);
        });
    });

    $offer_img_wrapper.on('click', '[data-role-remove-price-list-event]', function(e) {
        $add_offer_photo_text.text('Загрузить');
        changeOfferImage('');
    });

    function changeOfferImage(img_url) {
        $offer_img_wrapper.toggle(!!img_url).find('img').attr('src', img_url);
        $upload_hidden_input.val(img_url);
    }
});