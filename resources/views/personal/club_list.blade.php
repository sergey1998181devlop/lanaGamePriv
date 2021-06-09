@extends('layouts.app')
@section('page')
<title>Список клубов - LanGame</title>
@endsection
@section('content')
@include('personal/club_card')

<!--SECTION PERSONAL PAGE START-->
<section class="personal_page_wrapper">
    <div class="container-fluid">
        <div class="personal_page">
            <div class="personal_menu_wrapper">
                <h2>Личный кабинет</h2>
                <div class="personal_menu">
                    <a href="{{url('personal/profile')}}">
                        <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-account"></use>
                        </svg>
                        <span>Профиль</span>
                    </a>
                    <a href="{{url('personal/clubs')}}" class="active">
                        <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-file"></use>
                        </svg>
                        <span>Список клубов</span>
                    </a>
                    <a  href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="exit">
                        <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-cancel"></use>
                        </svg>
                        <span>Выйти</span>
                        
                    </a>                    
                </div>
            </div>
            <div class="personal_main_content_wrapper">
                <div class="club_list_navigation_wrapper">
                    <ul class="club_list_navigation_tabs">
                        <li>
                            <a href="#tab1" class="active">
                                <span>Опубликованные</span>
                                @if(count($published) > 0)
                                <span class="qty">{{count($published)}}</span>
                                @endif
                            </a>
                        </li>
                        <li><a href="#tab2">
                                <span>На модерации</span>
                                @if(count($underModify) > 0)
                                <span class="qty">{{count($underModify)}}</span>
                                @endif
                            </a>
                        </li>
                        <li><a href="#tab3">
                                <span>Черновики</span>
                                @if(count($draft) > 0)
                                <span class="qty">{{count($draft)}}</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                    <div class="btn_wrapper">
                        <div class="club_list_title">Список клубов</div>
                        <button type="button" class="add_club" data-remodal-target="add_club_modal">Добавить</button>
                    </div>
                </div>

                <div class="club_list_content_tabs">
                    <div class="tab" id="tab1">
                        <div class="club_list_content">
                            @foreach($published as $club)
                                <div class="club_list_item">
                                {!!echoCard($club)!!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab" id="tab2" style="display: none">
                        <div class="club_list_content moderation">
                            @foreach($underModify as $club)
                                <div class="club_list_item">
                                {!!echoCard($club,'under_edit')!!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab" id="tab3" style="display: none">
                        <div class="club_list_content">
                            @foreach($draft as $club)
                                <div class="club_list_item">
                                {!!echoCard($club,'draft')!!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--SECTION PERSONAL PAGE END-->
@include("personal.modals")

@endsection

@section('scripts')
@if(isset($_GET['action']) && $_GET['action'] == 'add_club')
<script>
    $( document ).ready(function(){
        $('[data-remodal-target="add_club_modal"]').click();
    })

</script>
@endif
@endsection