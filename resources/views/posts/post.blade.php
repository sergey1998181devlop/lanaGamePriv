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
