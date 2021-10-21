@extends('layouts.app')
@section('page')
    <title>Избранное</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <?$page="likedClubs";?>
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
                        <a href="{{url('personal/liked')}}" class="active">
                            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-like"></use>
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
                                    <a href="#tab1" class="active">
                                        <span>Клубы, которые вы отметили</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="club_list_content_tabs">
                        <div class="tab">
                            <div class="club_list_content">
                                @foreach($clubs as $club)
                                    <div class="club_list_item">
                                        @include('club')
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
@endsection

