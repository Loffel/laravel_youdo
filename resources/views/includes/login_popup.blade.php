<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#login">Вход</a></li>
			<li><a href="#register">Регистрация</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Login -->
			<div class="popup-tab-content" id="login">
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Рады видеть вас снова!</h3>
					<span>Нет аккаунта? <a href="{{ route('register') }}" class="register-tab">Зарегистрируйтесь!</a></span>
				</div>
					
				<!-- Form -->
                <form action="{{ route('login') }}" method="post" id="login-form-popup">
                    @csrf
					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" name="email" id="email-login-popup" placeholder="Email" value="{{ old('email') }}" autocomplete="email" autofocus required/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-outline-lock"></i>
						<input type="password" class="input-text with-border" name="password" id="password-login-popup" placeholder="Пароль" autocomplete="current-password" required/>
					</div>
					<div class="checkbox col-12">
						<input type="checkbox" id="remember-login-popup" name="remember" {{ old('remember') ? 'checked' : '' }}>
						<label for="remember"><span class="checkbox-icon"></span> Запомнить меня</label>
					</div>
					<a href="{{ route('password.request') }}" class="forgot-password">Забыли пароль?</a>
				</form>
				
				<!-- Button -->
				<button class="button full-width button-sliding-icon ripple-effect" type="submit" form="login-form-popup">Войти <i class="icon-material-outline-arrow-right-alt"></i></button>
				
				<!-- Social Login -->
				<!-- <div class="social-login-separator"><span>or</span></div>
				<div class="social-login-buttons">
					<button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> Log In via Facebook</button>
					<button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i> Log In via Google+</button>
				</div> -->

			</div>

			<!-- Register -->
			<div class="popup-tab-content" id="register">
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Давайте создадим аккаунт!</h3>
				</div>

				<!-- Account Type -->
				<div class="account-type">
					<div>
						<input type="radio" name="account-type-radio-popup" id="freelancer-radio" class="account-type-radio" checked/>
						<label for="freelancer-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Исполнитель</label>
					</div>

					<div>
						<input type="radio" name="account-type-radio-popup" id="employer-radio" class="account-type-radio"/>
						<label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Заказчик</label>
					</div>
				</div>
					
				<!-- Form -->
				<form action="{{ route('register') }}" method="post" id="register-account-form-popup">
					@csrf
					<input type="hidden" name="type" value="-1">
                    <div class="input-with-icon-left">
                        <i class="icon-feather-user"></i>
                        <input type="text" class="input-text with-border" name="name" id="name-register-popup" placeholder="Имя" required/>
                    </div>

					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" name="email" id="email-register-popup" placeholder="Email" required/>
					</div>

					<div class="input-with-icon-left" style="display: none;">
						<i class="icon-material-outline-assignment"></i>
						<input type="text" class="input-text with-border" name="ogrn" id="ogrn-register-popup" placeholder="ОГРН"/>
					</div>

					<div class="input-with-icon-left" style="display: none;">
						<i class="icon-material-outline-location-city"></i>
						<input type="text" class="input-text with-border" name="legal_address" id="legal_address-register-popup" placeholder="Юр. адрес"/>
					</div>
					
					<div class="input-with-icon-left" style="display: none;">
						<i class="icon-material-outline-location-on"></i>
						<input type="text" class="input-text with-border" name="address" id="address-register-popup" placeholder="Физ. адрес"/>
					</div>
					
					<div class="input-with-icon-left" style="display: none;">
						<i class="icon-feather-phone"></i>
						<input type="text" class="input-text with-border" name="phone" id="phone-register-popup" placeholder="Телефон"/>
					</div>

					<div class="input-with-icon-left" title="Минимум 8 символов" data-tippy-placement="bottom">
						<i class="icon-material-outline-lock"></i>
						<input type="password" class="input-text with-border" name="password" id="password-register-popup" placeholder="Пароль" required/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-outline-lock"></i>
						<input type="password" class="input-text with-border" name="password_confirmation" id="password-repeat-register-popup" placeholder="Повторите пароль" required/>
					</div>
				</form>
				
				<!-- Button -->
				<button class="margin-top-10 button full-width button-sliding-icon ripple-effect" type="submit" form="register-account-form-popup">Регистрация <i class="icon-material-outline-arrow-right-alt"></i></button>
				
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

<script type="application/javascript">

</script>