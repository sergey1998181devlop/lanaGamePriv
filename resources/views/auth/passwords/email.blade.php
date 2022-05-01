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
                        </div>
                        @if (session('status'))
                            <div class="form-group">
                                <div class="success" >
                                    {{ session('status') }}
                                </div>
                            </div>
                        @endif
                        @if($errors)
                            <div class="form-group">
                                <div class="alert alert-danger" role="alert">
                                    @foreach($errors->all() as $errorTxt)
                                        <p class="text_decor">{{ $errorTxt }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif
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