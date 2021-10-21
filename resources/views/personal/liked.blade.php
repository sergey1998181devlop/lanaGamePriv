@extends('layouts.app')
@section('page')
    <title>Избранное</title>
@endsection
@section('content')
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
                        <a href="{{url('personal/liked')}}">
                            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-file"></use>
                            </svg>
                            <span>Избранное</span>
                        </a>
                        <a href="{{ route('logout') }}"
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
                        <div class="club_list_navigation_tabs_wrapper">
                            <ul class="club_list_navigation_tabs">
                                <li>
                                    <a href="#tab1" @if(!$edit || $clubAr->published_at != null)class="active" @endif>
                                        <span>Опубликованные </span>
                                        @if(count($published) > 0)
                                            <span class="qty"> {{count($published)}}</span>
                                        @endif
                                    </a>
                                </li>
                                <li><a href="#tab2" @if($edit && $clubAr->draft != '1' && $clubAr->published_at == null)class="active" @endif>
                                        <span>На модерации </span>
                                        @if(count($underModify) > 0)
                                            <span class="qty"> {{count($underModify)}}</span>
                                        @endif
                                    </a>
                                </li>
                                <li><a href="#tab3" @if($edit && $clubAr->draft == '1')class="active" @endif>
                                        <span>Черновики</span>
                                        @if(count($draft) > 0)
                                            <span class="qty"> {{count($draft)}}</span>
                                        @endif
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="btn_wrapper">
                            <div class="club_list_title">Список клубов</div>
                            <button type="button" class="add_club" data-remodal-target="add_club_modal">Добавить</button>
                        </div>
                    </div>

                    <div class="club_list_content_tabs">
                        <div class="tab" id="tab1" @if($edit && $clubAr->published_at == null)style="display: none" @endif>
                            @if(notVerifed())
                                <div class="user_verified">
                                    Мы не сможем приступить к проверке вашего клуба, пока вы не подтвердите адрес электронной почты. Письмо с инструкциями направлено на указанный
                                    ящик.
                                    Для повторной отправки <a href="{{url('profile/verify/resend')}}">нажмите сюда.</a>
                                </div>
                            @endif
                            <div class="club_list_content">
                                @foreach($published as $club)
                                    <div class="club_list_item">
                                        {!!echoCard($club)!!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab" id="tab2" @if(!$edit || $clubAr->draft == '1' || $clubAr->published_at != null)style="display: none"@endif>
                            <div class="club_list_content moderation1">
                                @foreach($underModify as $club)
                                    <div class="club_list_item">
                                        {!!echoCard($club,'under_edit')!!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab" id="tab3" @if(!$edit || $clubAr->draft != '1')style="display: none"@endif>
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

