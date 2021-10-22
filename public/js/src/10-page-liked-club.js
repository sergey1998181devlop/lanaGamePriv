jQuery(function() {

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
        if(!Layout.isPlayer()){
            Layout.showInfoModal('Если не хотите потерять понравившийся клуб, <a href="/registration">зарегистрируйтесь</a> или <a href="/login">авторизуйтесь</a> на сайте как ланнер.');
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
