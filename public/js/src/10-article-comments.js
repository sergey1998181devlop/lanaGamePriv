jQuery(function() {
    let $wrapper = jQuery('.article_comments_wrapper'),
        $main_comment_form = jQuery('#add_article_comment'),
        $add_comment_wrapper = jQuery('.article_comments_wrapper .add_comment_wrapper'),
        comment_count_label_formatter = new IntlMessageFormat.IntlMessageFormat('{count, plural, one{# комментарий} few{# комментария} many{# комментариев} other{# комментария}}', 'ru-RU'),
        comment_like_url = Layout.meta('url-comment-like'),
        comment_unlike_url = Layout.meta('url-comment-unlike');

    $wrapper.on('submit', 'form', function(e) {
        e.preventDefault();
        let $form = jQuery(this);

        if (Layout.isGuest()) {
            $form.trigger('reset');
            Layout.showInfoModal('Если хотите оставить комментарий или оценить ответ, <a href="/registration">зарегистрируйтесь</a> или <a href="/login">авторизуйтесь</a> на сайте.');
        } else {
            jQuery.ajax({
                type: 'POST',
                url: $form.attr('action'),
                data: $form.serialize(),
                success: function(data) {
                    if ($form.hasClass('main_comment_form')) {
                        let $main_ul = $form.closest('.article_comments_wrapper').find('.comments_list_wrapper >ul');

                        $form.trigger('reset');
                        $main_ul.append(`${data.html}`);

                    } else {
                        if ($form.closest('li').find('>ul').length === 0) {
                            $form.closest('li').append('<ul></ul>');
                        }

                        if ($form.closest('li').find('[data-show-branch-comments]').length === 0) {
                            $form.closest('li').append(`<button class="show_branch" style="display: none;" data-show-branch-comments>Развернуть ветку</button>`);
                        }

                        $form.closest('li').find('>ul').css('display', 'block').append(data.html);
                        $form.closest('li').find('[data-show-branch-comments]').hide();
                        $form.closest('.comment_item').find('[data-article-comment-reply]').prop('disabled', false);

                        if ($form.is('.comments_list_wrapper ul ul form')) {
                            let qty_comments = $form.closest('li').find('>ul >li >.comment_item').length,
                                button_text = comment_count_label_formatter.format({count: qty_comments});

                            $form.closest('li').find('>[data-show-branch-comments]').text(button_text);
                        }

                        $form.closest('.add_comment_wrapper').remove();
                    }
                }
            });
        }
    });

    $add_comment_wrapper.on('click focus', function() {
        jQuery(this).addClass('active');
    });

    $main_comment_form.on('submit', function() {
        $add_comment_wrapper.removeClass('active');
    });

    $wrapper.on('click', '[data-article-comment-reply]', function(e) {
        if (Layout.isGuest()) {
            Layout.showInfoModal('Если хотите оставить комментарий или оценить ответ, <a href="/registration">зарегистрируйтесь</a> или <a href="/login">авторизуйтесь</a> на сайте.');
        } else {
            let $this = jQuery(this),
                $comment = $this.closest('.comment_item');

            $this.closest('.comment_item')
                .append(`
            <div class="add_comment_wrapper active">
                <form method="post" action="${$main_comment_form.attr('action')}">
                   <input type="hidden" name="post_id" value="${$comment.data('post-id')}">
                   <input type="hidden" name="comment_id" value="${$comment.data('comment-id')}">
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
        }
    });

    $wrapper.on('click', '[data-remove-article-reply-form]', function(e) {
        let $comment_item = jQuery(this).closest('.comment_item');
        $comment_item.find('.comment_rating').removeClass('mob_position');
        $comment_item.find('[data-article-comment-reply]').prop('disabled', false);
        $comment_item.find('.add_comment_wrapper').remove();
    });

    $wrapper.on('click', '[data-rating-vote]', function(e) {
        if (Layout.isGuest()) {
            Layout.showInfoModal('Если хотите оставить комментарий или оценить ответ, <a href="/registration">зарегистрируйтесь</a> или <a href="/login">авторизуйтесь</a> на сайте.');
        } else {
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

            let url = vote === 'plus' ? comment_like_url : comment_unlike_url;

            jQuery.ajax({
                url,
                method: 'POST',
                data: {id: $comment.data('comment-id')},
                success: function() {
                    console.log(arguments);
                }
            });
        }
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
