jQuery(function() {
    let $wrapper = jQuery('.article_comments_wrapper'),
        $main_comment_form = jQuery('#add_article_comment');

    // $wrapper.on('submit', 'form',function(e) {
    //     e.preventDefault();
    //
    //     let $form = jQuery(this);
    //
    //     jQuery.ajax({
    //         type: 'POST',
    //         url: $form.attr('action'),
    //         data: $form.serialize(),
    //         success: function() {
    //
    //         }
    //     });
    // });

    $wrapper.on('click', '[data-article-comment-reply]', function(e) {
        let $this = jQuery(this),
            $comment = $this.closest('.comment_item');

        $this.closest('.comment_item')
            .append(`
            <div class="add_comment_wrapper">
                <form method="post" action="${$main_comment_form.attr('action')}">
                   <input type="hidden" name="post_id" value="${$comment.data('post-id')}">
                   <input type="hidden" name="comment_id" value="${$comment.data('comment-id')}">
                   <input type="hidden" name="_token" value="${$main_comment_form.find('[name="_token"]').val()}">
                   <textarea placeholder="Написать комментарий..." name="comment_body"></textarea>
                   <label>
                        <input type="file" id="add-image-article-comment" accept="image/*">
                   </label>
                   <button type="button" class="remove_form" data-remove-article-reply-form>Отмена</button>
                   <button type="submit">Отправить</button>
                </form>
            </div>`)
            .find('.comment_rating')
            .addClass('mob_position');
        $this.prop('disabled', true);
    });

    $wrapper.on('click', '[data-remove-article-reply-form]', function(e) {
        let $comment_item = jQuery(this).closest('.comment_item');
        $comment_item.find('.comment_rating').removeClass('mob_position');
        $comment_item.find('[data-article-comment-reply]').prop('disabled', false);
        $comment_item.find('.add_comment_wrapper').remove();
    });

    $wrapper.on('click', '[data-rating-vote]', function(e) {
        let $this = jQuery(this),
            $rating = $this.closest('.comment_rating').find('.rating'),
            $comment = $this.closest('.comment_item'),
            saved_vote = $comment.data('rating-saved-vote'),
            vote = $this.data('rating-vote'),
            rating = +$rating.text().trim();

        if (vote === saved_vote) {
            return;
        }

        rating += vote === 'plus' ? 1 : -1;

        $rating.text(rating);

        if (vote === 'plus' && saved_vote === 'minus') {
            saved_vote = '';
        } else if (vote === 'minus' && saved_vote === 'plus') {
            saved_vote = '';
        } else {
            saved_vote = vote;
        }

        $comment.data('rating-saved-vote', saved_vote);
        $comment.toggleClass('vote-plus', saved_vote === 'plus');
        $comment.toggleClass('vote-minus', saved_vote === 'minus');
        $rating.toggleClass('plus', rating > 0);
        $rating.toggleClass('minus', rating < 0);
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
