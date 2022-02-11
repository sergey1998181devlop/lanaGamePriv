@extends('layouts.app')
@section('page')
<title>Контакты LANGAME.RU - телефон, адрес, электронная почта</title>
<meta name="keywords" content="контакты, телефон, email, электронная почта, langame" />
<meta name="description" content="Контакты LANGAME.RU - телефон, адрес, электронная почта, расположение офиса, форма обратной связи" />
@endsection
@section('content')
<!--SECTION CONTACTS PAGE START-->
<section class="contacts_page_content_wrapper">
    <div class="container">
        <div class="contacts_page_title">Контакты</div>
        <div class="contacts_page_info_wrapper">
            @if(false)
            <div class="info_item">
                <div class="club_contact">
                    <img src="{{ asset('/img/phone.svg')}}" alt="phone">
                    <a href="tel:+79999999999">+7(999)999-99-99</a>
                </div>
            </div>
            @endif
            <div class="info_item">
                <div class="club_contact">
                    <img src="{{ asset('/img/mail.svg')}}" alt="email">
                    <a href="mailto:pg@langame.ru" onclick="gtag('event', 'send', { 'event_category': 'email', 'event_action': 'click' });">pg@langame.ru</a>
                </div>
            </div>
            <div class="info_item">
                <div class="club_address_wrapper">
                    <div class="address_img_wrapper">
                        <img src="{{ asset('/img/point-red.svg')}}" alt="location">
                    </div>
                    <div class="club_address">
                        г. Москва, ул. Большая Семёновская, д. 15
                    </div>
                </div>
            </div>
        </div>
        <div class="contacts_page_title">Напишите нам</div>
        <div class="contact_us_wrapper">
            <form action="{{url('messages/send')}}" method="post" id="contact-us-form" data-recaptcha-form>
            {{ csrf_field() }}
                <div class="forma">
                    <div class="form-group required @error('name') error @enderror">
                        <label for="contact-us-name-input">Имя</label>
                        <input id="contact-us-name-input" name="name" value="{{ old('name') }}"  type="text" placeholder=""  required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group required @error('email') error @enderror">
                        <label for="contact-us-email-input">Email</label>
                        <input id="contact-us-email-input" name="email" value="{{ old('email') }}" type="email" placeholder=""  required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group @error('phone') error @enderror">
                        <label for="contact-us-phone-input">Контактный телефон</label>
                        <input id="contact-us-phone-input" name="phone" value="{{ old('phone') }}" type="tel" placeholder="+7 (___) ___-__-__">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group descr required @error('message') error @enderror">
                        <label for="contact-us-message-input">Текст сообщения</label>
                        <textarea name="message" id="contact-us-message-input" maxlength="1500" required>{{ old('message') }}</textarea>
                        @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="recaptcha-holder">
                    <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="{{env('RECAPCHA_PUB')}}"></div>
                </div>
                <div class="recaptcha-msg">
                    @error('g-recaptcha-response')
                    {{ $message }}
                    @enderror
                </div>
                <button type="submit">Отправить</button>
            </form>
        </div>
    </div>
</section>
<!--SECTION CONTACTS PAGE END-->

@endsection
@section('scripts')
@if(session('success'))
<script>
    $( document ).ready(function(){
        jQuery('[data-remodal-id="success_modal"]').remodal().open();
    });

</script>
@endif
@endsection
