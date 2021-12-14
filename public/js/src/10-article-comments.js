jQuery(function() {
    let $wrapper = jQuery('.article_comments_wrapper');

    $wrapper.on('click', '[data-article-comment-reply]', function(e) {
        jQuery(this).closest('.comment_item')
            .append(`
            <div class="add_comment_wrapper">
                <form action="">
                   <textarea placeholder="Написать комментарий..."></textarea>
                   <label>
                        <input type="file" id="add-image-article-comment" accept="image/*">
                   </label>
                   <button type="button" class="remove_form" data-remove-article-reply-form>Отмена</button>
                   <button type="submit">Отправить</button>
                </form>
            </div>
        `)
            .find('.comment_rating')
            .addClass('mob_position');
        jQuery(this).prop('disabled', true);
    });

    $wrapper.on('click', '[data-remove-article-reply-form]', function(e) {
        jQuery(this).closest('.comment_item').find('.comment_rating').removeClass('mob_position');
        jQuery(this).closest('.comment_item').find('[data-article-comment-reply]').prop('disabled', false);
        jQuery(this).closest('.comment_item').find('.add_comment_wrapper').remove();
    });

    $wrapper.on('click', '[data-btn-comment-rating-minus]', function(e) {
        let $rating = +jQuery(this).closest('.comment_rating').find('.rating').text();

        jQuery(this).closest('.comment_rating').find('button').prop('disabled', true);
        --$rating;
        if($rating > 0){
            jQuery(this).closest('.comment_rating').find('.rating').addClass('plus');
        } else if ($rating < 0){
            jQuery(this).closest('.comment_rating').find('.rating').addClass('minus');
        }
        jQuery(this).closest('.comment_rating').find('.rating').text($rating);
    });

    $wrapper.on('click', '[data-btn-comment-rating-plus]', function(e) {
        let $rating = +jQuery(this).closest('.comment_rating').find('.rating').text()

        jQuery(this).closest('.comment_rating').find('button').prop('disabled', true);
        ++$rating;
        if($rating > 0){
            jQuery(this).closest('.comment_rating').find('.rating').addClass('plus');
        } else if ($rating < 0){
            jQuery(this).closest('.comment_rating').find('.rating').addClass('minus');
        }
        jQuery(this).closest('.comment_rating').find('.rating').text($rating);
    });

    $wrapper.on('click', '[data-show-branch-comments]', function(e) {
        jQuery(this).closest('li').find('>ul').show();
        jQuery(this).hide();
    });

    $wrapper.on('click', '[data-hide-branch]', function(e) {
        jQuery(this).closest('ul')
            .hide()
            .closest('li')
            .find('[data-show-branch-comments]')
            .show();
    });
});
