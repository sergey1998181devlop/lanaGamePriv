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
            if (Gate::check('like', $comment)) {
                if (!Gate::check('unlike', $comment)) {
                    $likeable = 'unlike';
                }
            } else {
                $likeable = 'like';
            }


            $likeable = 'none';

            if (!Auth::guest()) {
                if (Gate::check('like', $comment) && !Gate::check('unlike', $comment)) {
                    $likeable = 'unlike';
                } else if (!Gate::check('like', $comment) && Gate::check('unlike', $comment)) {
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
                                    <span>{{ $comment->user->name }}</span>
                                </div>
                                <div class="user_detail">
                                    <span>{{ $comment->user->type == 'player' ? 'Игрок' : 'Представитель клуба' }}</span>
                                    <span>{{timelabe($comment->created_at)}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="comment_rating">
                            <?php
                            $sumRating = count($comment->likes) - count($comment->unlikes);
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
                        <?php
                        if ( $comment->image != '') {?>
                            <div class="comment_img_wrapper">
                                <img src="{{$comment->image_thumbnail != '' ? $comment->image_thumbnail : $comment->image}}" full-image="{{$comment->image}}" alt="" class="comment_img">
                            </div>
                        <?}?>
                        {{ $comment->body }}
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
                            return ($comment->likes->count() - $comment->unLikes->count());
                        })->sortByDesc(function($comment) {
                            return $comment->replies->count();
                        })
                ])
            </li>
        @endforeach
        @if(!isset($fromController))
    </ul>
@endif
