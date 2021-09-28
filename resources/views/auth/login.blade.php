@extends('layouts.app')
@section('page')
<title>Вход в личный кабинет - LanGame</title>
@endsection
@section('content')
<!--SECTION LOG IN PAGE START-->
<section class="log_in_page_wrapper">
    <div class="container">
        <div class="log_in_page_content">
            <div class="log_in_page_title">
                Вход в личный кабинет
            </div>
            <div class="log_in_wrapper">
                <form action="{{ route('login') }}" method="post" id="log-in-form">
                @csrf
                    <div class="forma">
                        <div class="form-group @error('phone') error @enderror">
                            <label for="log-in-phone-input">Номер телефона</label>
                            <input id="log-in-phone-input" name="phone" type="tel" value="{{ old('phone') }}"  placeholder="+7 (___) ___-__-__" required>
                        </div>
                        <div class="form-group @error('phone') error @enderror">
                            <label for="log-in-password-input">Пароль</label>
                            <div class="input_wrapper">
                                <input id="log-in-password-input" name="password" type="password" placeholder="" required>
                                <a  href="{{ route('password.request') }}" class="forgot_password">Забыл пароль</a>
                            </div>
                            @error('phone')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="btn_wrapper">
                        <a href="{{url('register_club')}}" class="registration">Регистрация</a>
                        <button type="submit">Продолжить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $('#log-in-form').submit(function(){
        ym(82365286,'reachGoal','lk');gtag('event', 'send', { 'event_category': 'lk', 'event_action': 'send' });
    })
</script>
@endsection