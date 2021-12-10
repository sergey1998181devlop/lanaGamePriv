@extends('layouts.app')
@section('page')
<title>Полезные статьи о жизни компьютерных клубов на сайте LANGAME.RU</title>
<meta name="keywords" content="статьи, заметки, компьютерные клубы, киберспорт" />
<meta name="description" content="Полезные статьи и заметки о жизни компьютерных клубов в России и в мире. Новости из жизни индустрии компьютерных клубов и киберспорта на сайте LANGAME.RU" />
@endsection
@section('content')


<!--SECTION ARTICLES START-->
<section class="articles_wrapper">
    <div class="container">
        <h2>Наш блог</h2>
        <div class="articles">
            <div class="articles_list">
                @if(isset( $posts) && count($posts)>0)
                @foreach($posts as $post)
                    <div class="articles_item">
                        <a href="{{url($post->id.'_statia_'.Str::slug($post->url))}}">
                            <div class="article_img_wrapper">
                                <img src="{{($post->image != '') ? url('storage/posts/thumbnail/'.$post->image) : asset('img/default-club-preview-image.svg')}}" alt="club">
                            </div>
                            <div class="article_content_wrapper">
                                <div class="article_title">
                                {{$post->name}}
                                </div>
                                <div class="article_descr">
                                    {!! \Illuminate\Support\Str::limit(strip_tags($post->about),150, '...')!!}
                                </div>
                                <p>Читать дальше</p>
                            </div>
                        </a>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    {{$posts->links()}}
</section>
<!--SECTION ARTICLES END-->
@endsection
