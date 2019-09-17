@extends('layouts.app')

@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h2>Contact</h2>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Главная</a></li>
                        <li>Контакты</li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>


<!-- Content
================================================== -->


<!-- Container -->
<div class="container">
    <div class="row">

        <div class="col-xl-12">
            <div class="contact-location-info margin-bottom-50">
                <div class="contact-address">
                    <ul>
                        <li class="contact-address-headline">Наш офис</li>
                        <li>425 Berry Street, CA 93584</li>
                        <li>Телефон (123) 123-456</li>
                        <li><a href="#">mail@example.com</a></li>
                        <li>
                            <div class="freelancer-socials">
                                <ul>
                                    <li><a href="#" title="Dribbble" data-tippy-placement="top"><i class="icon-brand-dribbble"></i></a></li>
                                    <li><a href="#" title="Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
                                    <li><a href="#" title="Behance" data-tippy-placement="top"><i class="icon-brand-behance"></i></a></li>
                                    <li><a href="#" title="GitHub" data-tippy-placement="top"><i class="icon-brand-github"></i></a></li>
                                
                                </ul>
                            </div>
                        </li>
                    </ul>

                </div>
                <div id="single-job-map-container">
                    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A4c79e6db0f046f4629f2edd3d9ad7957dca35510255955b5f9e7e36fe35d1c2b&amp;source=constructor" width="100%" height="450" frameborder="0"></iframe>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-8 offset-xl-2 offset-lg-2">

            <section id="contact" class="margin-bottom-60">
                <h3 class="headline margin-top-15 margin-bottom-35">Есть вопросы? Не стесняйтесь связаться с нами!</h3>

                <form method="post" name="contactform" id="contactform" autocomplete="on">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-with-icon-left">
                                <input class="with-border" name="name" type="text" id="name" placeholder="Имя" required="required" />
                                <i class="icon-material-outline-account-circle"></i>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-with-icon-left">
                                <input class="with-border" name="email" type="email" id="email" placeholder="Email" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required="required" />
                                <i class="icon-material-outline-email"></i>
                            </div>
                        </div>
                    </div>

                    <div class="input-with-icon-left">
                        <input class="with-border" name="subject" type="text" id="subject" placeholder="Тема" required="required" />
                        <i class="icon-material-outline-assignment"></i>
                    </div>

                    <div>
                        <textarea class="with-border" name="comments" cols="40" rows="5" id="comments" placeholder="Сообщение" spellcheck="true" required="required"></textarea>
                    </div>

                    <input type="submit" class="submit button margin-top-15" id="submit" value="Отправить" />

                </form>
            </section>

        </div>

    </div>
</div>
<!-- Container / End -->
<contacts-maps></contacts-maps>
@endsection