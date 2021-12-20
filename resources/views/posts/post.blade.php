@extends('layouts.app')
@section('page')
    <title>{{$post->name}} LANGAME.RU</title>
    <meta name="description" content="{{$post->desc}} На сайте LANGAME.RU">
    <meta name="keywords" content="{{$post->key}}"/>
@endsection
@section('content')
    <!--SECTION ARTICLE PAGE MAIN BANNER START-->

    <section class="article_page_wrapper">
        <div class="container-fluid">
            <div class="columns">
                <main>
                    @if(admin())
                        <div style="margin-bottom: 20px;">
                            <a class="btn btn-primary" href="{{url('post/edit/')}}/{{$post->id}}">Отредактировать</a>
                            <a class="btn btn-danger " data-remodal-target="deleteitem" data-remodal-options="hashTracking: false">Удалить</a>
                        </div>
                    @endif

                    <div class="article_page_main_banner_img_wrapper">
                        <div class="article_page_main_banner_img">
                            <img src="{{($post->image != '') ? url('storage/posts/'.$post->image) : asset('img/default-club-preview-image.svg')}}" alt="image">
                            <div class="article_page_main_banner_title">
                                <h1>{{$post->name}}</h1>
                            </div>
                            <a href="{{url('posts')}}" class="go_back">Назад</a>
                        </div>
                    </div>

                    <div class="article_page_main_content">
                        {!!$post->about!!}
                    </div>

                    <div class="article_comments_wrapper">
                        <?
                        $messageForComments = msgfmt_create('ru_RU', '{count, plural, one{# комментарий} few{# комментария} many{# комментариев} other{# комментария}}');
                        ?>
                        @if($post->comments_total_count > 0)
                            <div class="comment_qty">{{$messageForComments->format(['count' => $post->comments_total_count]) . PHP_EOL}}</div>
                            <div class="comments_sort_wrapper">
                            <?php
                            $commentsBy = isset($_GET['sc_b']) && $_GET['sc_b'] == 'in_order' ? 'in_order' : 'popular';
                            ?>
                            <a <?=$commentsBy == 'popular' ? 'class="active"':'href="?sc_b=popular"'?>>Популярные</a>
                            <a <?=$commentsBy == 'in_order' ? 'class="active"':'href="?sc_b=in_order"'?>>По порядку</a>
                        </div>
                        @else
                            <div class="comment_qty">Нет комментарий</div>
                        @endif
                        
                        <div class="add_comment_wrapper">
                            <form action="{{ route('comment.add') }}" method="post" id="add_article_comment" class="main_comment_form">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}"/>
                                <input type="hidden" name="comment_photo" value="">
                                <textarea name="comment_body" placeholder="Написать комментарий..."></textarea>
                                <label class="comment_file">
                                    <input type="file" id="add-image-article-comment" accept="image/*">
                                </label>
                                <button type="submit">Отправить</button>
                            </form>
                        </div>
                        <div class="comments_list_wrapper">
                       <? global $totalComments; 
                        $totalComments = 0;?>
                            @include('posts.posts_comment_replies', ['comments' => 
                            isset($commentsBy) && $commentsBy == 'in_order' ? 
                                $post->comments
                                :
                                $post->comments->sortByDesc(function($comment) {
                                    return ($comment->likes->count() - $comment->unLikes->count());
                                })->sortByDesc(function($comment) {
                                    return $comment->replies->count();
                                })
                            ])
                        </div>
                    </div>
                </main>

                <aside>
                    @if(count($morePosts) > 0)
                        <div class="aside_articles_wrapper">
                            <div class="title">Читайте также</div>
                            <div class="another_articles_list">
                                @foreach($morePosts as $p)
                                    <div class="another_articles_item">
                                        <a href="{{url($p->id.'_statia_'.Str::slug($p->url))}}">
                                            <img src="{{($p->image != '') ? url('storage/posts/'.$p->image) : asset('img/default-club-preview-image.svg')}}" alt="article">
                                        </a>
                                        <div class="article_title" title="{{$p->name}}">{{$p->name}}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </section>
    <!--SECTION ARTICLE PAGE MAIN CONTENT END-->
    @if(admin())
        <div class="deleteitem_modal remodal admin_modal" id="deleteitem" data-remodal-id="deleteitem" data-remodal-options="hashTracking: false">
            <button data-remodal-action="close" class="remodal-close">Закрыть</button>
            <div class="remodal-content">
                <form action="{{url('post/delete')}}/{{$post->id}}" method="post" style="dispaly:inline">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h4 class="modal-title">Подтверждение удаления</h4>
                    </div>
                    <div class="modal-body">
                        Вы уверены, что хотите удалить статью?
                    </div>
                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm">Удалить</button>
                </form>
            </div>
        </div>

    @endif
@endsection
@section('scripts')
    @if($post->comments_total_count != $totalComments)
      <script>
          $( document ).ready(function() {
                $('.article_comments_wrapper .comment_qty').text('{{$messageForComments->format(['count' => $totalComments]) . PHP_EOL}}')
            });
      </script>
    @endif
@endsection
