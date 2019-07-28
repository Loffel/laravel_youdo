<div id="footer">
	
	<!-- Footer Top Section -->
	<div class="footer-top-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">

					<!-- Footer Rows Container -->
					<div class="footer-rows-container">
						
						<!-- Left Side -->
						<div class="footer-rows-left">
							<div class="footer-row">
								<div class="footer-row-inner footer-logo">
									<img src="{{asset('images/logo2.png')}}" alt="">
								</div>
							</div>
						</div>
						
						<!-- Right Side -->
						<div class="footer-rows-right">

							<!-- Social Icons -->
							<div class="footer-row">
								<div class="footer-row-inner">
									<ul class="footer-social-links">
										<li>
											<a href="#" title="ВКонтакте" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-vk"></i>
											</a>
										</li>
										<li>
											<a href="#" title="Одноклассники" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-odnoklassniki"></i>
											</a>
										</li>
										<li>
											<a href="#" title="Telegram" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-telegram-plane"></i>
											</a>
										</li>
										<li>
											<a href="#" title="WhatsApp" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-whatsapp"></i>
											</a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
							</div>

						</div>

					</div>
					<!-- Footer Rows Container / End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Footer Top Section / End -->

	<!-- Footer Middle Section -->
	<div class="footer-middle-section">
		<div class="container">
			<div class="row">

				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>Задания</h3>
						<ul>
							<li><a href="#"><span>Все задания</span></a></li>
							@auth
							<li><a href="#"><span>Создать задание</span></a></li>
							@endauth
						</ul>
					</div>
				</div>

				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>Блог</h3>
						<ul>
							<li><a href="#"><span>Все посты</span></a></li>
							@auth
								@if(Auth::user()->is_admin)
									<li><a href="#"><span>Создать пост</span></a></li>
								@endif
							@endauth
						</ul>
					</div>
				</div>

				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>О сайте</h3>
						<ul>
							<li><a href="#"><span>Контакты</span></a></li>
							<li><a href="#"><span>Соглашение об использовании сайта</span></a></li>
							<li><a href="#"><span>Правила обработки и защиты информации о пользователях</span></a></li>
						</ul>
					</div>
				</div>

				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>Аккаунт</h3>
						<ul>
							@guest
							<li><a href="{{ route('login') }}"><span>Вход</span></a></li>
							<li><a href="{{ route('register') }}"><span>Регистрация</span></a></li>
							@else
							<li><a href="{{ route('profile.show', Auth::user()->id) }}"><span>Мой профиль</span></a></li>
							@endguest
						</ul>
					</div>
				</div>

				<!-- Newsletter -->
				<div class="col-xl-4 col-lg-4 col-md-12">
					<h3><i class="icon-material-outline-access-time"></i> Контакты</h3>
					<p><i class="icon-feather-phone"></i> +7 (999) 999-99-99 <br>
						<i class="icon-feather-calendar"></i> 10:00 — 18:00 <br>
						<i class="icon-feather-mail"></i> info@site.ru
					</p>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer Middle Section / End -->
	
	<!-- Footer Copyrights -->
	<div class="footer-bottom-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					© 2019 <strong>Laravel_YouDo</strong>. Все права защищены.
				</div>
			</div>
		</div>
	</div>
	<!-- Footer Copyrights / End -->

</div>