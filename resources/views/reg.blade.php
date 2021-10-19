@extends('layouts.app')
@section('page')
    <title>Регистрация</title>
@endsection
@section('content')
    <!--SECTION REGISTRATION START-->
    <section class="main_reg_wrapper">
        <div class="container">
            <div class="page_title">Регистрация на портале LANGAME</div>
            <div class="descr">
                Вы представитель компьютерного клуба, лаунжа или арены? Или просто ищите площадки в своём городе?
                Не важно! Просто регистрируйтесь на langame.ru и развивайте культуру LAN-гейминга вместе с нами!
            </div>
            <div class="main_reg_list">
                <div class="reg_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/reg_owner.png')}}" alt="image">
                    </div>
                    <button type="button" class="btn" data-btn-club-owner-reg>Я - представитель клуба</button>
                    <div class="instr">
                        Хочу разместить информацию о своей площадке и
                        присоединиться к профессиональному сообществу
                    </div>
                </div>
                <div class="reg_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/reg_gamer.png')}}" alt="image">
                    </div>
                    <button type="button" class="btn" data-btn-club-gamer-reg>Я - ланнер</button>
                    <div class="instr">
                        Активно посещаю компьютерные клубы.
                        Хочу находить лучшие площадки,
                        узнавать об акциях и  оставлять отзывы.
                    </div>
                </div>
            </div>

            <div class="form_reg_wrapper">
                <div class="page_title">Регистрация представителя компьютерного клуба</div>
                <div class="add_club_start_wrapper">
                    @if(Auth::guest())
                        <form action="{{url('register/send_sms')}}" class="add_club_start" method="post" id="add-club-start-form">
                            @else
                                <form action="" class="add_club_start" method="post" id="add-club-start-form_authed">
                                    @endif
                                    <input type="hidden" name="_token"  value="{{ csrf_token() }}">

                                    <div class="forma">
                                        <div class="form-group">
                                            <label for="add-club-start-input">Номер телефона</label>
                                            <input id="add-club-start-input" name="phone" type="tel" placeholder="+7 (___) ___-__-__" required>
                                            <div class="error"></div>
                                        </div>
                                        <div class="checkbox_wrapper">
                                            <div class="checkbox_item">
                                                <label>
                                                    <input type="checkbox" name="add_club_request_user_agree" required>
                                                    <span class="activator"><span></span></span>
                                                    <span>Согласен с <a href="{{url('user-agreement')}}" style="text-decoration:none">условиями использования</a> сервиса</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn_wrapper">
                                        <a href="{{url('login')}}" class="log_in">Уже есть аккаунт?</a>
                                        <button type="submit">Продолжить</button>
                                    </div>
                                </form>
                                @if(Auth::guest())
                                    <form action="{{url('register/verify_sms')}}" method="post" class="add_class_confirm_code" id="add-club-code-confirm-form">
                                        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
                                        <div class="forma">
                                            <p>Введите код, отправленный на номер <span class="user_phone"></span></p>
                                            <div class="code_wrapper">
                                                <input type="text" name="code" data-code-input>
                                                <span class="error"></span>
                                            </div>
                                            <a class="code_resend disabled" id="reSendCode">Отправить повторно <span class="hide">через </span> <span id="countdown">3:00</span></a>
                                        </div>
                                        <div class="btn_wrapper">
                                            <a class="step_back">Назад</a>
                                            <button type="submit">Продолжить</button>
                                        </div>
                                    </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!--SECTION REGISTRATION END-->
@endsection
