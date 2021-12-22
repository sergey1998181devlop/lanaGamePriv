@if(!isset($fromController))

    <ul>
        @endif
        @foreach($comments as $comment)
            <?php
            //чтобы знать количество комментраии отображаемых на самом деле, если удалить коммент который имееть детей то его детей не отображаются но отчитываются в общое количество комментраии
            if(!isset($fromController)){
                global $totalComments;
                $totalComments++ ;
            }
            $likeable = 'none';
            if (!Auth::guest()) {
                if (Auth::user()->hasUnLiked($comment)) {
                    $likeable = 'unlike';
                } else if (Auth::user()->hasLiked($comment)) {
                    $likeable = 'like';
                }
            }
            ?>
            @if($comment->parent_id != '')
                <li>
                    <button type="button" class="hide_branch" data-hide-branch></button>
                </li>
            @endif
            <li>
                <div class="comment_item<? if ($likeable == 'like') {
                    echo ' vote-plus';
                } elseif ($likeable == 'unlike') {
                    echo ' vote-minus';
                }?>"
                     data-post-id="{{$post->id}}"
                     data-comment-id="{{$comment->id}}"
                     data-rating-saved-vote="<? if ($likeable == 'like') {
                         echo 'plus';
                     } elseif ($likeable == 'unlike') {
                         echo 'minus';
                     }?>"
                >
                    <div class="top_wrapper">
                        <div class="user_info_wrapper">
                            @if(false)
                                <div class="user_avatar">
                                    <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                </div>
                            @endif
                            <div class="user_info">
                                <div class="user_name">
                                    <? $user_name = $comment->user->name;
                                    if(substr_count($comment->user->name,' ') > 1){
                                        $user_name = explode(' ',$comment->user->name)[1];
                                    }?>
                                    <span>{{ $user_name }}</span>
                                </div>
                                <div class="user_detail">
                                    <span>{{ $comment->user->type == 'player' ? 'Игрок' : 'Представитель клуба' }}</span>
                                    <span>{{timelabe($comment->created_at)}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="comment_rating">
                            <?php
                            $sumRating = $comment->likes->count() - $comment->unLikes->count();
                            ?>
                            <button type="button" class="minus <?= Auth::guest() ? 'disabled' : ''; ?>" data-rating-vote="minus"></button>
                            <div class="rating<? if ($sumRating > 0) {
                                echo ' plus';
                            } elseif ($sumRating < 0) {
                                echo ' minus';
                            }?>"
                            >
                                {{ $sumRating }}
                            </div>
                            <button type="button" class="plus <?= Auth::guest() ? 'disabled' : ''; ?>" data-rating-vote="plus"></button>
                        </div>
                    </div>
                    <div class="comment_content_wrapper">
                        {{ $comment->body }}
                        <?php
                        if ( $comment->image != '') {?>
                        <div class="comment_img_wrapper">
                            <a href="{{$comment->image}}" data-fancybox>
                                <img src="{{$comment->image_thumbnail != '' ? $comment->image_thumbnail : $comment->image}}" onerror="this.src='/img/default-club-preview-image.svg'" alt="comment_img">
                            </a>
                        </div>
                        <?}?>
                    </div>
                    <div class="btn_wrapper">
                        <button type="button" class="comment_reply" data-article-comment-reply>Ответить</button>
                    </div>
                </div>
                @if(count($comment->replies) > 0)
                    <button class="show_branch"
                            data-show-branch-comments><?=($comment->parent_id == '') ? 'Развернуть ветку' : $messageForComments->format(['count' => count($comment->replies)]).PHP_EOL?></button>
                @endif
                @include('posts.posts_comment_replies', ['comments' =>
                    isset($commentsBy) && $commentsBy == 'in_order' ?
                        $comment->replies
                        :
                        $comment->replies->sortByDesc(function($comment) {
                            return ($comment->likes->count() - $comment->unLikes->count()) + $comment->replies->count();
                        })
                ])
            </li>
        @endforeach
        @if(!isset($fromController))
    </ul>
@endif
