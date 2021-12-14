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
                        <div class="comment_qty">308 комментариев</div>
                        <div class="comments_sort_wrapper">
                            <a href="#" class="active">Популярные</a>
                            <a href="#">По порядку</a>
                        </div>
                        <div class="add_comment_wrapper">
                            <form action="" id="add_article_comment">
                                <textarea placeholder="Написать комментарий..."></textarea>
                                <label>
                                    <input type="file" id="add-image-article-comment" accept="image/*">
                                </label>
                                <button type="submit">Отправить</button>
                            </form>
                        </div>
                        <div class="comments_list_wrapper">
                            <ul>
                                <li>
                                    <div class="comment_item">
                                        <div class="top_wrapper">
                                            <div class="user_info_wrapper">
                                                <div class="user_avatar">
                                                    <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                                </div>
                                                <div class="user_info">
                                                    <div class="user_name">
                                                        <span>Федор Лукин</span>
                                                    </div>
                                                    <div class="user_detail">
                                                        <span>Представитель клуба</span>
                                                        <span>5.12.2021</span>
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
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquam asperiores aspernatur at, autem consectetur deleniti dicta earum
                                            eligendi
                                            et eveniet expedita facilis fugit illum incidunt ipsam ipsum laborum minus modi mollitia officia possimus quaerat quas quasi
                                            repellat reprehenderit rerum sapiente sed sequi sint, soluta totam veniam, voluptatibus. Ex, nihil.
                                        </div>
                                        <div class="btn_wrapper">
                                            <button type="button" class="comment_reply" data-article-comment-reply>Ответить</button>
                                        </div>
                                    </div>
                                    <button class="show_branch" data-show-branch-comments>Развернуть ветку</button>
                                    <ul>
                                        <li>
                                            <button type="button" class="hide_branch" data-hide-branch></button>
                                        </li>
                                        <li>
                                            <div class="comment_item">
                                                <div class="top_wrapper">
                                                    <div class="user_info_wrapper">
                                                        <div class="user_avatar">
                                                            <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                                        </div>
                                                        <div class="user_info">
                                                            <div class="user_name">
                                                                <span>Федор Лукин</span>
                                                            </div>
                                                            <div class="user_detail">
                                                                <span>Представитель клуба</span>
                                                                <span>5.12.2021</span>
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
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquam asperiores aspernatur at, autem consectetur deleniti dicta
                                                    earum eligendi
                                                    et eveniet expedita facilis fugit illum incidunt ipsam ipsum laborum minus modi mollitia officia possimus quaerat quas quasi
                                                    repellat reprehenderit rerum sapiente sed sequi sint, soluta totam veniam, voluptatibus. Ex, nihil.
                                                </div>
                                                <div class="btn_wrapper">
                                                    <button type="button" class="comment_reply" data-article-comment-reply>Ответить</button>
                                                </div>
                                            </div>
                                            <button class="show_branch" data-show-branch-comments>16 комментариев</button>
                                            <ul>
                                                <li>
                                                    <button type="button" class="hide_branch" data-hide-branch></button>
                                                </li>
                                                <li>
                                                    <div class="comment_item">
                                                        <div class="top_wrapper">
                                                            <div class="user_info_wrapper">
                                                                <div class="user_avatar">
                                                                    <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                                                </div>
                                                                <div class="user_info">
                                                                    <div class="user_name">
                                                                        <span>Федор Лукин</span>
                                                                    </div>
                                                                    <div class="user_detail">
                                                                        <span>Представитель клуба</span>
                                                                        <span>5.12.2021</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="comment_rating" data-comment-rating-wrapper>
                                                                <button type="button" class="minus" data-btn-comment-rating-minus></button>
                                                                <div class="rating plus">150</div>
                                                                <button type="button" class="plus" data-btn-comment-rating-plus></button>
                                                            </div>
                                                        </div>
                                                        <div class="comment_content_wrapper">
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquam asperiores aspernatur at, autem consectetur
                                                            deleniti dicta earum eligendi
                                                            et eveniet expedita facilis fugit illum incidunt ipsam ipsum laborum minus modi mollitia officia possimus quaerat quas
                                                            quasi
                                                            repellat reprehenderit rerum sapiente sed sequi sint, soluta totam veniam, voluptatibus. Ex, nihil.
                                                        </div>
                                                        <div class="btn_wrapper">
                                                            <button type="button" class="comment_reply" data-article-comment-reply>Ответить</button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="comment_item">
                                                        <div class="top_wrapper">
                                                            <div class="user_info_wrapper">
                                                                <div class="user_avatar">
                                                                    <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                                                </div>
                                                                <div class="user_info">
                                                                    <div class="user_name">
                                                                        <span>Федор Лукин</span>
                                                                    </div>
                                                                    <div class="user_detail">
                                                                        <span>Представитель клуба</span>
                                                                        <span>5.12.2021</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="comment_rating" data-comment-rating-wrapper>
                                                                <button type="button" class="minus" data-btn-comment-rating-minus></button>
                                                                <div class="rating plus">150</div>
                                                                <button type="button" class="plus" data-btn-comment-rating-plus></button>
                                                            </div>
                                                        </div>
                                                        <div class="comment_content_wrapper">
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquam asperiores aspernatur at, autem consectetur
                                                            deleniti dicta earum eligendi
                                                            et eveniet expedita facilis fugit illum incidunt ipsam ipsum laborum minus modi mollitia officia possimus quaerat quas
                                                            quasi
                                                            repellat reprehenderit rerum sapiente sed sequi sint, soluta totam veniam, voluptatibus. Ex, nihil.
                                                        </div>
                                                        <div class="btn_wrapper">
                                                            <button type="button" class="comment_reply" data-article-comment-reply>Ответить</button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="comment_item">
                                                        <div class="top_wrapper">
                                                            <div class="user_info_wrapper">
                                                                <div class="user_avatar">
                                                                    <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                                                </div>
                                                                <div class="user_info">
                                                                    <div class="user_name">
                                                                        <span>Федор Лукин</span>
                                                                    </div>
                                                                    <div class="user_detail">
                                                                        <span>Представитель клуба</span>
                                                                        <span>5.12.2021</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="comment_rating" data-comment-rating-wrapper>
                                                                <button type="button" class="minus" data-btn-comment-rating-minus></button>
                                                                <div class="rating plus">150</div>
                                                                <button type="button" class="plus" data-btn-comment-rating-plus></button>
                                                            </div>
                                                        </div>
                                                        <div class="comment_content_wrapper">
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquam asperiores aspernatur at, autem consectetur
                                                            deleniti dicta earum eligendi
                                                            et eveniet expedita facilis fugit illum incidunt ipsam ipsum laborum minus modi mollitia officia possimus quaerat quas
                                                            quasi
                                                            repellat reprehenderit rerum sapiente sed sequi sint, soluta totam veniam, voluptatibus. Ex, nihil.
                                                        </div>
                                                        <div class="btn_wrapper">
                                                            <button type="button" class="comment_reply" data-article-comment-reply>Ответить</button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
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
