@extends('layouts.app')
@section('page')
<title>Профиль - LanGame</title>
@endsection
@section('content')
<?php
function customOldVal($name,$item){
    if(!empty(old($name))){return old($name);}
    if($item=='new'){return;}
    if(isset($item->$name)){return $item->$name;}
    return '';
}

?>
<!--SECTION PERSONAL PAGE START-->
<section class="personal_page_wrapper">
    <div class="container-fluid">
        <div class="personal_page">
            <div class="personal_menu_wrapper">
                <h2>Личный кабинет</h2>
                <div class="personal_menu">
                    <a href="{{url('personal/profile')}}" class="active">
                        <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-account"></use>
                        </svg>
                        <span>Профиль</span>
                    </a>
                    <a href="{{url('personal/clubs')}}">
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
                <div class="user_profile_form_wrapper">
                    <div class="user_profile_title">Профиль</div>
                    <form action="{{url('profile/update')}}" method="post" id="user-profile-form" class="user_profile" phone-action="{{url('profile/sendSMS')}}" verify-action="{{url('profile/verify')}}">
                    {{ csrf_field() }}
                        <div class="forma">
                            <div class="form-group required">
                                <label for="user-name-input">ФИО представителя</label>
                                <input id="user-name-input" name="name" type="text" value="{{customOldVal('name',$user)}}" placeholder="" required>
                            </div>
                            <div class="user_phone_wrapper">
                                <div class="form-group required">
                                    <label for="user-phone-input">Мобильный телефон</label>
                                    <input id="user-phone-input" name="phone" type="tel" value="{{customOldVal('phone',$user)}}" placeholder="+7 (___) ___-__-__" required>
                                    <input type="hidden" id="oldPhone" value="{{$user->phone}}">
                                    <div class="confirm_mobile_wrapper">
                                        <p class="confirm_mobile_descr"></p>
                                        <div class="code_wrapper">
                                            <input type="text" name="code">
                                        </div>
                                        <a  class="code_resend disabled pointer" id="reSendCodeProfile">Отправить повторно <span class="hide">через</span>
                                            <span id="countdown">3:00</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label for="user-email-input">Email</label>
                                <input id="user-email-input" name="email" type="email" value="{{customOldVal('email',$user)}}" placeholder="" required>
                            </div>

                            <div class="form-group required">
                                <label for="user-position-input">Должность представителя</label>
                                <div class="select2_wrapper select_user_position_wrapper">
                                    <select id="user-position-input" name="user_position" class="select2_input" data-placeholder="Выбрать из списка" required>
                                        <option  <?=customOldVal('user_position',$user) == 1 ? 'selected' : ''?> value="1">Директор</option>
                                        <option <?=customOldVal('user_position',$user) == 2 ? 'selected' : ''?> value="2">Администратор</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group password">
                                <label for="user-password-input">Сменить пароль</label>

                                <div class="user_password">
                                    <input id="user-password-input" name="password" type="password" placeholder="Новый пароль">
                                    <input id="user-password-again-input" name="password_confirmation" type="password" placeholder="Повторите">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="user_profile_submit">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--SECTION PERSONAL PAGE END-->

@endsection
