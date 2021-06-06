@extends('layouts.app')
@section('page')
<title>Контакты - LanGame</title>
@endsection
@section('content')
<!--SECTION CONTACTS PAGE START-->
<section class="contacts_page_content_wrapper">
    <div class="container">
        <div class="contacts_page_title">Контакты</div>
        <div class="contacts_page_info_wrapper">
            <div class="info_item">
                <div class="club_contact">
                    <img src="{{ asset('/img/phone.svg')}}" alt="phone">
                    <a href="tel:+79999999999">+7(999)999-99-99</a>
                </div>
            </div>
            <div class="info_item">
                <div class="club_contact">
                    <img src="{{ asset('/img/mail.svg')}}" alt="email">
                    <a href="mailto:admin@f5center.com">admin@f5center.com</a>
                </div>
            </div>
            <div class="info_item">
                <div class="club_address_wrapper">
                    <div class="address_img_wrapper">
                        <img src="{{ asset('/img/point-red.svg')}}" alt="location">
                    </div>
                    <div class="club_address">
                        г. Москва, ул. Большая Семёновская 11, стр. 11
                    </div>
                </div>
            </div>
        </div>
        <div class="contacts_page_title">Напишите нам</div>
        <div class="contact_us_wrapper">
            <form action="" method="post" id="contact-us-form">
                <div class="forma">
                    <div class="form-group required">
                        <label for="contact-us-name-input">Имя</label>
                        <input id="contact-us-name-input" name="contact_us_name" type="text" placeholder="" required>
                    </div>
                    <div class="form-group required">
                        <label for="contact-us-email-input">Email</label>
                        <input id="contact-us-email-input" name="contact_us_email" type="email" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-us-phone-input">Контактный телефон</label>
                        <input id="contact-us-phone-input" name="contact_us_phone" type="tel" placeholder="+7 (___) ___-__-__">
                    </div>
                    <div class="form-group descr required">
                        <label for="contact-us-message-input">Текст сообщения</label>
                        <textarea name="contact_us_message" id="contact-us-message-input" maxlength="1500" required></textarea>
                    </div>
                </div>
                <button type="submit">Отправить</button>
            </form>
        </div>
    </div>
</section>
<!--SECTION CONTACTS PAGE END-->

@endsection