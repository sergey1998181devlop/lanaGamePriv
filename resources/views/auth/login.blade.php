@extends('layouts.app')

@section('content')
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
                <form action="" method="post" id="add-club-start-form">
                    <div class="forma">
                        <div class="form-group">
                            <label for="add-club-start-input">Номер телефона</label>
                            <input id="add-club-start-input" name="phone" type="tel" placeholder="+7 (___) ___-__-__" required>
                        </div>
                        <div class="checkbox_wrapper">
                            <div class="checkbox_item">
                                <label>
                                    <input type="checkbox" name="add_club_request_user_agree" required>
                                    <span class="activator"><span></span></span>
                                    <span>Согласен с условиями использования сервиса</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="btn_wrapper">
                        <a href="/log_in.php" class="log_in">Уже есть аккаунт?</a>
                        <button type="submit">Продолжить</button>
                    </div>
                </form>

                <form action="" method="post" id="add-club-code-confirm-form">
                    <div class="forma">
                        <p>Введите код, отправленный на номер <span class="user_phone"></span></p>
                        <div class="code_wrapper">
                            <input type="text" name="code" data-code-input>
                            <span class="error"></span>
                        </div>
                        <a href="#" class="code_resend disabled" id="reSendCode">Отправить повторно <span class="hide">через</span> <span id="countdown">3:00</span></a>
                    </div>
                    <div class="btn_wrapper">
                        <a href="#" class="step_back">Назад</a>
                        <button type="submit">Продолжить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--SECTION ADD CLUB PAGE END-->
@endsection