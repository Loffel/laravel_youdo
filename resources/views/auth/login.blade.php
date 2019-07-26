@extends('layouts.app')

@section('content')
<div class="margin-top-70"></div>

<div class="container">
    <div class="row">
        <div class="col-xl-5 offset-xl-3">
            <div class="login-register-page">
                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Рады видеть вас снова!</h3>
                    <span>Нет аккаунта? <a href="{{ route('register') }}">Зарегистрируйтесь!</a></span>
                </div>
                    
                <!-- Form -->
                <form action="{{ route('login') }}" method="post" id="login-form">
                    @csrf
                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input type="text" class="input-text with-border" name="email" id="email" placeholder="Email" value="{{ old('email') }}" autocomplete="email" autofocus required/>
                    </div>

                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="password" id="password" placeholder="Пароль" autocomplete="current-password" required/>
                    </div>
                    <div class="checkbox col-12">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember"><span class="checkbox-icon"></span> Запомнить меня</label>
                    </div>
                    <a href="#" class="forgot-password">Забыли пароль?</a>
                </form>
                
                <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form">Войти <i class="icon-material-outline-arrow-right-alt"></i></button>
                
                <!-- Social Login -->
                <!--
                <div class="social-login-separator"><span>or</span></div>
                <div class="social-login-buttons">
                    <button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> Log In via Facebook</button>
                    <button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i> Log In via Google+</button>
                </div>
                -->
            </div>

        </div>
    </div>
</div>

<div class="margin-top-70"></div>
@endsection
