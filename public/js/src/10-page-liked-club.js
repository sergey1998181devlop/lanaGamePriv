jQuery(function() {
    const guest = jQuery('meta[name="user-role"]').attr('content') === 'guest';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    jQuery('.sc_item.liked_list').closest('.club_list_item').append(
        `<form action="" method="post">
            <button type="submit" data-role-remove-liked-club></button>
         </form>`
    );

    if (jQuery('[data-like-club-form]').hasClass('liked')) {
        jQuery('[data-like-club-form]').hide();
        jQuery('[data-unlike-club-form]').show();
    }

    jQuery('[data-like-club]').on('click', function(e) {
        if(guest){
            jQuery('[data-remodal-id="success_modal"]')
                .find('.title')
                .text('Если не хотите потерять понравившийся клуб, зарегистрируйтесь или авторизуйтесь на сайте.')
            jQuery('[data-remodal-id="success_modal"]').remodal().open();
        }
        let $form = jQuery(this).closest('form'),
            club_id = jQuery('meta[name="club_id"]').attr('content');

        e.preventDefault();

        jQuery.ajax({
            type: 'POST',
            data: $form.serialize(),
            url: `/like-club/?club_id=${club_id}`,
            success: function() {
                jQuery('[data-like-club-form]').hide();
                jQuery('[data-unlike-club-form]').show();
            }
        });
    });

    jQuery('[data-unlike-club]').on('click', function(e) {
        let $form = jQuery(this).closest('form'),
            club_id = jQuery('meta[name="club_id"]').attr('content');

        e.preventDefault();

        jQuery.ajax({
            type: 'POST',
            data: $form.serialize(),
            url: `/unlike-club/?club_id=${club_id}`,
            success: function() {
                jQuery('[data-like-club-form]').show();
                jQuery('[data-unlike-club-form]').hide();
            }
        });
    });

    jQuery('[data-role-remove-liked-club]').on('click', function(e) {
        let $form = jQuery(this).closest('form'),
            club_id = jQuery(this).closest('.club_list_item').find('.sc_item.liked_list').data('id');

        e.preventDefault();

        jQuery.ajax({
            type: 'POST',
            data: $form.serialize(),
            url: `/unlike-club/?club_id=${club_id}`,
            success: function() {
                location.href = '/personal/liked';
            }
        });
    });
});