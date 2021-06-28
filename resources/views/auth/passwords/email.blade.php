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
                Забыли пароль?
            </div>
            <div class="password_recovery_wrapper">
                <form action="{{ route('password.email') }}" method="post" id="password-recovery-form">
                @csrf
                    <div class="forma">
                        <div class="form-group">
                            <label for="password-recovery-input">Email</label>
                            <input id="password-recovery-input" name="email" type="email" value="{{ old('email') }}" placeholder="" required>
                            @if (session('status'))
                                <div class="success">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="btn_wrapper">
                        <a href="{{url('login')}}" class="step_back">Назад</a>
                        <button type="submit">Восстановление пароля</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--SECTION PASSWORD RECOVERY PAGE END-->
@endsection
