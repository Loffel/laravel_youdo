<header id="header-container" class="fullwidth {{ Route::currentRouteName() == 'welcome' ? 'transparent-header' : ''}}">

	<!-- Header -->
	<div id="header">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo">
					<a href="{{url('/')}}"><img src="{{asset('images/logo2.png')}}" data-sticky-logo="{{asset('images/logo.png')}}" data-transparent-logo="{{asset('images/logo2.png')}}" alt=""></a>
				</div>

				<!-- Main Navigation -->
				<nav id="navigation">
					<ul id="responsive">

						<li><a href="{{ url('/') }}" style="padding-top:7px!important;">Главная</a></li>

						<li><a href="#">Задания</a>
							<ul class="dropdown-nav">
								<li><a href="{{ route('tasks.index') }}">Все задания</a></li>
								@auth
									@if(Auth::user()->type == 1)
									<li><a href="{{ route('tasks.create') }}">Создать задание</a></li>
									@endif
								@endauth
							</ul>
						</li>

						<li><a href="#">Блог</a>
							<ul class="dropdown-nav">
								<li><a href="{{ route('posts.index') }}">Все посты</a></li>
								@auth
									@if(Auth::user()->is_admin)
									<li><a href="{{ route('posts.create') }}">Создать пост</a></li>
									@endif
								@endauth
							</ul>
						</li>

						@auth
							@if(Auth::user()->is_admin)
							<li><a href="{{ route('admin.index') }}" style="padding-top:7px!important;">Админ-панель</a></li>
							@endif
						@endauth

					</ul>
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
				
			</div>
			<!-- Left Side Content / End -->


			<!-- Right Side Content / End -->
			<div class="right-side">

				@guest
				<div class="header-widget">
					<a href="#sign-in-dialog" class="popup-with-zoom-anim log-in-button"><i class="icon-feather-log-in"></i> <span>Вход / Регистрация</span></a>
				</div>
				@else
				<!--  User Notifications -->
				<div class="header-widget hide-on-mobile">
					
					<!-- Notifications -->
					<div class="header-notifications">

						<!-- Trigger -->
						<div class="header-notifications-trigger">
							<a href="#"><i class="icon-feather-bell"></i><span>{{ auth()->user()->unreadNotifications->count() }}</span></a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">

							<div class="header-notifications-headline">
								<h4>Уведомления</h4>
								<button class="mark-as-read ripple-effect-dark" title="Пометить как прочитанные" data-tippy-placement="left">
									<i class="icon-feather-check-square"></i>
								</button>
							</div>

							<div class="header-notifications-content">
								<div class="header-notifications-scroll" data-simplebar>
									<ul>
										@foreach(auth()->user()->unreadNotifications as $notification)
										<li class="notifications-not-read">
											<a href="#">
												<span class="notification-icon">
													@if($notification->type == "App\Notifications\UserSelected")
													<i class=" icon-material-outline-group"></i>
													@elseif($notification->type == "App\Notifications\NewProposal")
                                        			<i class="icon-material-outline-gavel"></i>
													@endif
												</span>
												<span class="notification-text">
													@if($notification->type == "App\Notifications\UserSelected")
													<strong>Вы</strong> были выбраны исполнителем задания <strong>{{ $notification->data["task_title"] }}</strong>
													@elseif($notification->type == "App\Notifications\NewProposal")
													<strong>{{ $notification->data["user_name"] }}</strong> оставил предложение к вашему заданию <strong>{{ $notification->data["task_title"] }}</strong>
													@endif
												</span>
											</a>
										</li>
										@endforeach
									</ul>
								</div>
							</div>

						</div>

					</div>
					
					<!-- Messages -->
					<div class="header-notifications">
						<div class="header-notifications-trigger">
							<a href="#"><i class="icon-feather-mail"></i><span>{{ auth()->user()->unreadMessages()->count() }}</span></a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">

							<div class="header-notifications-headline">
								<h4>Сообщения</h4>
								<button class="mark-as-read ripple-effect-dark" title="Пометить как прочитанные" data-tippy-placement="left">
									<i class="icon-feather-check-square"></i>
								</button>
							</div>

							<div class="header-notifications-content">
								<div class="header-notifications-scroll" data-simplebar>
									<ul>
										@foreach(auth()->user()->unreadMessages()->take(5) as $message)
										<li class="notifications-not-read">
											<a href="{{ route('messenger.index') }}">
												<span class="notification-avatar status-online"><img src="{{ $message->from->getAvatar() }}" alt=""></span>
												<div class="notification-text">
													<strong>{{ $message->from->name }}</strong>
													<p class="notification-msg-text">{{ Str::limit($message->text, 58) }}</p>
													<span class="color">{{ $message->created_at->diffForHumans() }}</span>
												</div>
											</a>
										</li>
										@endforeach
									</ul>
								</div>
							</div>

							<a href="{{ route('messenger.index') }}" class="header-notifications-button ripple-effect button-sliding-icon">Все сообщения<i class="icon-material-outline-arrow-right-alt"></i></a>
						</div>
					</div>

				</div>
				<!--  User Notifications / End -->

				<!-- User Menu -->
				<div class="header-widget">

					<!-- Messages -->
					<div class="header-notifications user-menu">
						<div class="header-notifications-trigger">
							<a href="#"><div class="user-avatar status-online"><img src="{{ Auth::user()->getAvatar() }}" alt=""></div></a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">

							<!-- User Status -->
							<div class="user-status">

								<!-- User Name / Avatar -->
								<div class="user-details">
									<div class="user-avatar status-online"><img src="{{ Auth::user()->getAvatar() }}" alt=""></div>
									<div class="user-name">
										{{ Auth::user()->name }} <span>{{ Auth::user()->getTypeName() }}</span>
									</div>
								</div>
						</div>
						
						<ul class="user-menu-small-nav">
							<li><a href="{{ route('profile.show', Auth::user()->id) }}"><i class="icon-material-outline-account-circle"></i> Мой профиль</a></li>
							<li><a href="{{ route('home') }}"><i class="icon-material-outline-dashboard"></i> Панель управления</a></li>
							<li><a href="#"><i class="icon-material-outline-settings"></i> Настройки</a></li>
							<li><a href="{{ route('logout') }}" href="index-logged-out.html" onclick="event.preventDefault();document.getElementById('logout-form-lara').submit();"><i class="icon-material-outline-power-settings-new"></i> Выйти</a></li>
						</ul>
						<form id="logout-form-lara" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>

						</div>
					</div>

				</div>
				@endguest
				<!-- User Menu / End -->

				<!-- Mobile Navigation Button -->
				<span class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</span>

			</div>
			<!-- Right Side Content / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>