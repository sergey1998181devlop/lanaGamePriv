<ul>
    @foreach($comments as $comment)

   
        @if($comment->parent_id != '')
            <li>
                <button type="button" class="hide_branch" data-hide-branch></button>
            </li>
        @endif
        <li>
            <div class="comment_item">
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
                    <div class="comment_rating" data-comment-rating-wrapper>
                        <button type="button" class="minus" data-btn-comment-rating-minus></button>
                        <div class="rating">0</div>
                        <button type="button" class="plus" data-btn-comment-rating-plus></button>
                    </div>
                </div>
                <div class="comment_content_wrapper">
                    {{ $comment->body }}
                </div>
                <div class="btn_wrapper">
                    <button type="button" class="comment_reply" data-article-comment-reply data-post-id="{{$post->id}}" data-comment-id="{{$comment->id}}">Ответить</button>
                </div>
            </div>
            @if(count($comment->replies) > 0)
            <button class="show_branch" data-show-branch-comments><?=($comment->parent_id == '')? 'Развернуть ветку' : $messageForComments->format(['count' => count($comment->replies)]) . PHP_EOL?></button>
            @endif
            @include('posts.posts_comment_replies', ['comments' => $comment->replies])
        </li>
    

    @endforeach
    </ul>