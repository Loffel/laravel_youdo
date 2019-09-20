@extends('layouts.app')

@section('content')
<div class="margin-top-70"></div>

<div class="container">
    <div class="row">
        <div class="col-xl-5 offset-xl-3">
            <div class="login-register-page">
                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Сброс пароля</h3>
                </div>
                    
                <!-- Form -->
                <form action="{{ route('password.email') }}" method="post" id="reset-form">
                    @csrf
                    @if (session('status'))
                        <div class="notification success closeable">
                            <p>{{ session('status') }}</p>
                            <a class="close"></a>
                        </div>
                    @endif
                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input type="text" class="input-text with-border" name="email" id="email" placeholder="Email" value="{{ old('email') }}" autocomplete="email" autofocus required/>
                    </div>
                </form>
                
                <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" form="reset-form">Сбросить <i class="icon-material-outline-arrow-right-alt"></i></button>
            </div>

        </div>
    </div>
</div>

<div class="margin-top-70"></div>
@endsection
