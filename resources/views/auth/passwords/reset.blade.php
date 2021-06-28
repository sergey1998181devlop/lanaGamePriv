@extends('layouts.app')
@section('page')
<title>Восстановление пароля - LanGame</title>
@endsection
@section('content')
<!--SECTION PASSWORD RECOVERY PAGE START-->
<section class="password_recovery_page_wrapper">
    <div class="container">
        <div class="password_recovery_content">
            <div class="password_recovery_title">
            Восстановление пароля
            </div>
            <div class="password_recovery_wrapper">
                <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                    <div class="forma">
                        <div class="form-group @error('email') error @enderror">
                            <label for="password-recovery-email">Email</label>
                            <input id="password-recovery-email"  name="email" type="email" value="{{ $email ?? old('email') }}"  required>
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('password') error @enderror">
                            <label for="password-recovery-input">Новый пароль</label>
                            <input id="password-recovery-input" name="password" type="password" autofocus required>
                        </div>
                        <div class="form-group @error('password') error @enderror">
                            <label for="password-confirm">Подтверждение пароля</label>
                            <input id="password-confirm" type="password" name="password_confirmation" required>
                            @error('password')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="btn_wrapper">
                        <a href="{{url('/')}}" class="step_back">Отмена</a>
                        <button type="submit">Сменить пароль</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--SECTION PASSWORD RECOVERY PAGE END-->
@endsection
