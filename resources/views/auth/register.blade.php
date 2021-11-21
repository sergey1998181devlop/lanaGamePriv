@extends('layouts.app')
@section('page')
    <title>Регистрация на проекте LANGAME.RU для владельцев компьютерных клубов</title>
    <meta name="keywords" content="регистрация, Langame"/>
    <meta name="description" content="У Вас есть компьютерный клуб? Тогда обязательно зарегистрируйте его на сайте LANGAME.RU"/>
@endsection
@section('content')

    @if(!isset($showOptions))
        <!--SECTION ADD CLUB PAGE START-->
        <section class="add_club_page_start_wrapper">
            <div class="container">
                <div class="add_club_page_start_content">
                    <div class="add_club_page_title">
                        Добавить клуб
                    </div>
                    <div class="add_club_start_info">
                        <p>
                            Вы представитель компьютерного клуба, бара, или арены?
                        </p>
                        <p>
                            Добавьте информацию о нём на портал LanGame. Это абсолютно <span class="text_decor">бесплатно!</span>
                        </p>
                    </div>
                    <div class="add_club_start_wrapper">
                        @if(Auth::guest())
                            <form action="{{url('register/send_sms')}}" class="add_club_start" method="post" id="add-club-start-form">
                                @else
                                    <form action="" class="add_club_start" method="post" id="add-club-start-form_authed">
                                        @endif
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

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
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
        <!--SECTION ADD CLUB PAGE END-->
    @else
        <!--SECTION REGISTRATION START-->
        <section class="main_reg_wrapper add_club_page_start_wrapper">
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
                            узнавать об акциях и оставлять отзывы.
                        </div>
                    </div>
                </div>

                <div class="form_reg_wrapper" id="main-registration-form">
                    <div class="page_title">Регистрация представителя компьютерного клуба</div>
                    <div class="add_club_start_wrapper">
                        <form action="{{url('register/send_sms')}}" class="add_club_start" method="post" id="add-club-start-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
    @endif
    @if(Auth::guest())
        <!--SECTION PERSONAL PAGE START-->
        <section class="personal_page_wrapper" style="display:none" id="personal_info_register">
            <div class="container-fluid">
                <div class="personal_page">
                    <div class="personal_menu_wrapper">
                        <h2>Личный кабинет</h2>
                        <div class="personal_menu">
                            <a class="active">
                                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-account"></use>
                                </svg>
                                <span>Профиль</span>
                            </a>
                            <a class="club_list_link">
                                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-file"></use>
                                </svg>
                                <span>Список клубов</span>
                            </a>
                            <a class="exit">
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
                            <form method="post" action="{{ url('register/create') }}" class="user_profile">
                                @csrf
                                <input type="hidden" name="conf_code">
                                <input type="hidden" name="user_type" value="owner">

                                <div class="forma">
                                    <div class="form-group required">
                                        <label for="user-name-input">ФИО представителя</label>
                                        <input id="user-name-input" name="name" type="text" placeholder="" required>
                                    </div>
                                    <div class="user_phone_wrapper">
                                        <div class="form-group required">
                                            <label for="user-phone-input">Мобильный телефон</label>
                                            <input id="user-phone-input" type="tel" placeholder="+7 (___) ___-__-__" disabled>
                                            <input name="phone" type="hidden">
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <label for="user-email-input">Email</label>
                                        <input id="user-email-input" name="email" type="email" placeholder="" required>
                                    </div>
                                    @if(isset($showOptions))
                                        <div class="form-group required player">
                                            <label for="registration-select-сity">Город</label>
                                            <div class="select2_wrapper select_user_position_wrapper">
                                                <?php
                                                $selected_city = old('city');
                                                if ($selected_city == '') {
                                                    $selected_city = city(true)['id'];
                                                }
                                                ?>
                                                <select id="registration-select-сity" name="city" required data-placeholder="Выберите город">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group required owner">
                                        <label for="user-position-input">Должность представителя</label>
                                        <div class="select2_wrapper select_user_position_wrapper">
                                            <select id="user-position-input" name="user_position" class="select2_input" data-placeholder="Выбрать из списка" required>
                                                <option value=""></option>
                                                <option value="1">Владелец</option>
                                                <option value="2">Управляющий</option>
                                                <option value="3">Маркетинг-менеджер</option>
                                                <option value="4">Администратор</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group password">
                                        <label for="user-password-input">Придумайте пароль</label>
                                        <div class="user_password">
                                            <input id="user-password-input" name="password" type="password" placeholder="Введите пароль">
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
    @endif
    <!--SECTION PERSONAL PAGE END-->
@endsection
@section('scripts')

    @if(isset($showOptions))
        <script>
            $('#registration-select-сity').select2({
                ajax: {
                    url: $('meta[name="site"]').attr('content') + '/searchCities',
                    dataType: 'json'
                },
                cache: true
            });

        </script>
    @endif
@endsection

