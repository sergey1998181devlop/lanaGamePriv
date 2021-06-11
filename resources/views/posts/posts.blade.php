@extends('layouts.app')
@section('page')
<title>Статьи - LanGame</title>
@endsection
@section('content')


<!--SECTION ARTICLES START-->
<section class="articles_wrapper">
    <div class="container">
        <h2>Статьи</h2>
        <div class="articles">
            <div class="articles_list">
                @if(isset( $posts) && count($posts)>0)
                @foreach($posts as $post)
                    <div class="articles_item">
                        <a href="{{url('post/read/'.$post->id.'/'.$post->url)}}">
                            <div class="article_img_wrapper">
                                <img src="{{($post->image != '') ? url('storage/posts/'.$post->image) : asset('img/default-club-preview-image.svg')}}" alt="club">
                            </div>
                            <div class="article_content_wrapper">
                                <div class="article_title">
                                {{$post->name}}
                                </div>
                                <div class="article_descr">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($post->about),150, '...')}}
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