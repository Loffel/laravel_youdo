@extends('layouts.app')

@section('content')
<div class="margin-top-70"></div>

<div class="container">
    <div class="row">
        <div class="col-xl-5 offset-xl-3">

            <div class="login-register-page">
                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3 style="font-size: 26px;">Давайте создадим аккаунт!</h3>
                    <span>Уже есть аккаунт? <a href="{{ route('login') }}">Войдите!</a></span>
                </div>

                @foreach ($errors->all() as $error)
                <div class="notification error closeable">
                    <p>{{ $error }}</p>
                    <a class="close"></a>
                </div>
                @endforeach

                <!-- Account Type -->
                <div class="account-type">
                    <div>
                        <input type="radio" name="account-type-radio" id="freelancer-radio" class="account-type-radio" checked/>
                        <label for="freelancer-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Исполнитель</label>
                    </div>

                    <div>
                        <input type="radio" name="account-type-radio" id="employer-radio" class="account-type-radio"/>
                        <label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Заказчик</label>
                    </div>
                </div>
                    
                <!-- Form -->
                <form action="{{ route('register') }}" method="post" id="register-account-form">
                    @csrf
                    <input type="hidden" name="type" value="-1">
                    <div class="input-with-icon-left">
                        <i class="icon-feather-user"></i>
                        <input type="text" class="input-text with-border" name="name" id="name-register" value="{{old('name')}}" placeholder="Имя" required/>
                    </div>

                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input type="text" class="input-text with-border" name="email" id="email-register" placeholder="Email" value="{{old('email')}}" required/>
                    </div>

                    <div class="input-with-icon-left" style="display: none;">
                        <i class="icon-material-outline-assignment"></i>
                        <input type="text" class="input-text with-border" name="ogrn" id="ogrn-register" value="{{old('ogrn')}}" placeholder="ОГРН"/>
                    </div>
                    
                    <div class="input-with-icon-left" style="display: none;">
                        <i class="icon-material-outline-location-city"></i>
                        <input type="text" class="input-text with-border" name="legal_address" id="legal_address-register" value="{{old('legal_address')}}" placeholder="Юр. адрес"/>
                    </div>
                    
                    <div class="input-with-icon-left" style="display: none;">
                        <i class="icon-material-outline-location-on"></i>
                        <input type="text" class="input-text with-border" name="address" id="address-register" value="{{old('address')}}" placeholder="Физ. адрес"/>
                    </div>
                    
                    <div class="input-with-icon-left" style="display: none;">
                        <i class="icon-feather-phone"></i>
                        <input type="text" class="input-text with-border" name="phone" id="phone-register" value="{{old('phone')}}" placeholder="Телефон"/>
                    </div>

                    <div class="input-with-icon-left" title="Минимум 8 символов" data-tippy-placement="right">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="password" id="password-register" placeholder="Пароль" required/>
                    </div>

                    <div class="input-with-icon-left" title="Минимум 8 символов" data-tippy-placement="right">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="password-confirm" id="password-repeat-register" placeholder="Повторите пароль" required/>
                    </div>
                </form>
                
                <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" form="register-account-form">Регистрация <i class="icon-material-outline-arrow-right-alt"></i></button>
                
                <!-- Social Login -->
                <!--
                <div class="social-login-separator"><span>or</span></div>
                <div class="social-login-buttons">
                    <button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> Register via Facebook</button>
                    <button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i> Register via Google+</button>
                </div>
                -->
            </div>

        </div>
    </div>
</div>

<div class="margin-top-70"></div>
@endsection