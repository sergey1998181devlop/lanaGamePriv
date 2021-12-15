<ul>
    @foreach($comments as $comment)


        @if($comment->parent_id != '')
            <li>
                <button type="button" class="hide_branch" data-hide-branch></button>
            </li>
        @endif
        <li>
            <div class="comment_item"
            {{-- class="comment_item vote-plus"  если пользователь голосовал +1 --}}
            {{-- class="comment_item vote-minus" если пользователь голосовал -1 --}}
                 data-post-id="{{$post->id}}"
                 data-comment-id="{{$comment->id}}"
                 data-rating-saved-vote=""
            {{-- data-rating-saved-vote=""      если пользователь еще не голосовал --}}
            {{-- data-rating-saved-vote="plus"  если пользователь голосовал +1 --}}
            {{-- data-rating-saved-vote="minus" если пользователь голосовал -1 --}}
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
                        <button type="button" class="minus" data-rating-vote="minus"></button>
                        <div class="rating"
                        {{-- class="rating plus"  если суммарный рейтинг > 0 --}}
                        {{-- class="rating minus" если суммарный рейтинг < 0 --}}
                        >
                            0
                        </div>
                        <button type="button" class="plus" data-rating-vote="plus"></button>
                    </div>
                </div>
                <div class="comment_content_wrapper">
                    {{ $comment->body }}
                </div>
                <div class="btn_wrapper">
                    <button type="button" class="comment_reply" data-article-comment-reply>Ответить</button>
                </div>
            </div>
            @if(count($comment->replies) > 0)
            <button class="show_branch" data-show-branch-comments><?=($comment->parent_id == '')? 'Развернуть ветку' : $messageForComments->format(['count' => count($comment->replies)]) . PHP_EOL?></button>
            @endif
            @include('posts.posts_comment_replies', ['comments' => $comment->replies])
        </li>
    @endforeach
    </ul>
