@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    @include('includes/dashboard_sidebar')
    <!-- Dashboard Content
    ================================================== -->
    <div class="dashboard-content-container" data-simplebar>
        <div class="dashboard-content-inner" >
            
            <!-- Dashboard Headline -->
            <div class="dashboard-headline">
                <h3>Настройки</h3>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Главная</a></li>
                        <li><a href="#">Панель управления</a></li>
                        <li>Настройки</li>
                    </ul>
                </nav>
            </div>
    
            <!-- Row -->
            <form action="{{ route('profile.settings.update') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        @if(Session::has('updated'))
                        <div class="notification success closeable">
                            <p>{{ Session::get('updated') }}</p>
                            <a class="close"></a>
                        </div>
                        @endif
                        @foreach ($errors->all() as $error)
                        <div class="notification error closeable">
                            <p>{{ $error }}</p>
                            <a class="close"></a>
                        </div>
                        @endforeach
                        <div class="dashboard-box margin-top-0">

                            <!-- Headline -->
                            <div class="headline">
                                <h3><i class="icon-material-outline-account-circle"></i> Мой аккаунт</h3>
                            </div>

                            <div class="content with-padding padding-bottom-0">

                                <div class="row">

                                    <div class="col-auto">
                                        <div class="avatar-wrapper" data-tippy-placement="bottom" title="Сменить фото">
                                            <img class="profile-pic" src="{{ Auth::user()->getAvatar() }}" alt="" />
                                            <div class="upload-button"></div>
                                            <input class="file-upload" type="file" name="avatar" accept="image/*"/>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="row">

                                            <div class="col-xl-12">
                                                <div class="submit-field">
                                                    <h5>Имя</h5>
                                                    <input type="text" name="name" class="with-border" value="{{ Auth::user()->name }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <!-- Account Type -->
                                                <div class="submit-field">
                                                    <h5>Тип аккаунта</h5>
                                                    <div class="account-type">
                                                        <div>
                                                            @if(Auth::user()->type == 2)
                                                            <input type="radio" name="account-type-radio" id="freelancer-radio" class="account-type-radio" checked/>
                                                            <label for="freelancer-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Исполнитель</label>
                                                            @else
                                                            <input type="radio" name="account-type-radio" id="employer-radio" class="account-type-radio" checked/>
                                                            <label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Заказчик</label>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="submit-field">
                                                    <h5>Email</h5>
                                                    <input type="text" name="email" class="with-border" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Dashboard Box -->
                    <div class="col-xl-12">
                        <div class="dashboard-box">

                            <!-- Headline -->
                            <div class="headline">
                                <h3><i class="icon-material-outline-face"></i> Мой профиль</h3>
                            </div>

                            <div class="content">
                                <ul class="fields-ul">
                                @if(Auth::user()->type == 2)
                                <li>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="submit-field">
                                                <h5>ОГРН</h5>
                                                <input type="text" name="ogrn" class="with-border" value="{{ Auth::user()->ogrn }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="submit-field">
                                                <h5>Контактный телефон</h5>
                                                <input type="text" name="phone" class="with-border" value="{{ Auth::user()->phone }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="submit-field">
                                                <h5>Юридический адрес</h5>
                                                <input type="text" name="legal_address" class="with-border" value="{{ Auth::user()->legal_address }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="submit-field">
                                                <h5>Физический адрес</h5>
                                                <input type="text" name="address" class="with-border" value="{{ Auth::user()->address }}">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endif
                                <li>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="submit-field">
                                                <h5>Обо мне</h5>
                                                <textarea cols="30" rows="5" name="about" placeholder="Напишите что-нибудь о себе..." class="with-border">{{ Auth::user()->about }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Dashboard Box -->
                    <div class="col-xl-12">
                        <div id="test1" class="dashboard-box">

                            <!-- Headline -->
                            <div class="headline">
                                <h3><i class="icon-material-outline-lock"></i> Смена пароля</h3>
                            </div>

                            <div class="content with-padding">
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="submit-field">
                                            <h5>Текущий пароль</h5>
                                            <input type="password" name="currentPassword" class="with-border">
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="submit-field">
                                            <h5>Новый пароль</h5>
                                            <input type="password" name="newPassword" class="with-border">
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="submit-field">
                                            <h5>Повторите новый пароль</h5>
                                            <input type="password" name="newPassword_confirmation" class="with-border">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Button -->
                    <div class="col-xl-12">
                        <button type="submit" class="button ripple-effect big margin-top-30">Сохранить</a>
                    </div>
                </div>
            </form>
            <!-- Row / End -->

            <!-- Footer -->
            <div class="dashboard-footer-spacer"></div>
            <div class="small-footer margin-top-15">
                <div class="small-footer-copyrights">
                    © 2018 <strong>Hireo</strong>. All Rights Reserved.
                </div>
                <ul class="footer-social-links">
                    <li>
                        <a href="#" title="Facebook" data-tippy-placement="top">
                            <i class="icon-brand-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Twitter" data-tippy-placement="top">
                            <i class="icon-brand-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Google Plus" data-tippy-placement="top">
                            <i class="icon-brand-google-plus-g"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="LinkedIn" data-tippy-placement="top">
                            <i class="icon-brand-linkedin-in"></i>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- Footer / End -->

        </div>
    </div>
    <!-- Dashboard Content / End -->

</div>
@endsection
