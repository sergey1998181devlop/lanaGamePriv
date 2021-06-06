@extends('layouts.app')
@section('page')
<title>{{$post->name}} - LanGame</title>
@endsection
@section('content')
<!--SECTION ARTICLE PAGE MAIN BANNER START-->
<section class="article_page_main_banner_wrapper">
    <div class="container-fluid">
    @if(Auth::check())
            <a class="btn btn-primary" href="{{url('post/edit/')}}/{{$post->id}}">Отредактировать</a>
            @if($post->type!=3)
            <a class="btn btn-danger " href="#" data-toggle="modal" data-target="#deleteitem" >Удалить</a>
         @endif  
         @endif  
        <div class="article_page_main_banner_img_wrapper">
            <div class="article_page_main_banner_img">
                <img src="{{url('../storage/app/public/posts/'.$post->image)}}" alt="image">
            </div>
            <div class="article_page_main_banner_title">
                <h2>{{$post->name}}</h2>
            </div>
            <a href="{{url('posts')}}" class="go_back">Назад</a>
        </div>
    </div>
</section>
<!--SECTION ARTICLE PAGE MAIN BANNER END-->

<!--SECTION ARTICLE PAGE MAIN CONTENT START-->
<section class="article_page_main_content_wrapper">
    <div class="container-fluid">
        <div class="article_page_main_content">
        {!!$post->about!!}
        </div>
    </div>
</section>
<!--SECTION ARTICLE PAGE MAIN CONTENT END-->

@endsection