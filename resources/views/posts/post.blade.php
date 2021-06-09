@extends('layouts.app')
@section('page')
<title>{{$post->name}} - LanGame</title>
@endsection
@section('content')
<!--SECTION ARTICLE PAGE MAIN BANNER START-->

<section class="article_page_main_banner_wrapper">
    <div class="container-fluid">
        @if(admin())
            <a class="btn btn-primary" href="{{url('post/edit/')}}/{{$post->id}}">Отредактировать</a>
            <a class="btn btn-danger " data-remodal-target="deleteitem">Удалить</a>
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
@if(admin())
<div class="deleteitem_modal remodal" id="deleteitem" data-remodal-id="deleteitem">
    <button data-remodal-action="close" class="remodal-close">Закрыть</button>
    <div class="remodal-content">
        <form action="{{url('post/delete')}}/{{$post->id}}" method="post" style="dispaly:inline">   
        {{ csrf_field() }}
        <div class="modal-header">
            <h4 class="modal-title">Подтверждение удаления</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        <div class="modal-body">
            Вы уверени,что хотите удалить статью?
        </div>
        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm">Удалить</button>
    </div>
</div>

@endif
@endsection