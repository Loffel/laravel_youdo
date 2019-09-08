<div class="dashboard-sidebar">
    <div class="dashboard-sidebar-inner" data-simplebar>
        <div class="dashboard-nav-container">

            <!-- Responsive Navigation Trigger -->
            <a href="#" class="dashboard-responsive-nav-trigger">
                <span class="hamburger hamburger--collapse" >
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </span>
                <span class="trigger-title">Навигация</span>
            </a>
            
            <!-- Navigation -->
            <div class="dashboard-nav">
                <div class="dashboard-nav-inner">

                    <ul data-submenu-title="Основное">
                        <li class="{{ (Route::currentRouteName() == 'home') ? 'active':'' }}"><a href="{{ route('home') }}"><i class="icon-material-outline-dashboard"></i> Панель управления</a></li>
                        <li class="{{ (Route::currentRouteName() == 'messenger.index') ? 'active':'' }}"><a href="{{ route('messenger.index') }}"><i class="icon-material-outline-question-answer"></i> Сообщения <span class="nav-tag">0</span></a></li>
                        {{-- <li><a href="dashboard-bookmarks.html"><i class="icon-material-outline-star-border"></i> Bookmarks</a></li> --}}
                        <li class="{{ (Route::currentRouteName() == 'reviews.index') ? 'active':'' }}"><a href="{{ route('reviews.index') }}"><i class="icon-material-outline-rate-review"></i> Отзывы</a></li>
                    </ul>
                    
                    <ul data-submenu-title="Управление заданиями">
                        <li class="{{ (Route::currentRouteName() == 'tasks.create') ? 'active-submenu':'' }}"><a href="#"><i class="icon-material-outline-assignment"></i> Задания</a>
                            <ul>
                                <li><a href="#">Мои задания <span class="nav-tag">2</span></a></li>
                                @if(Auth::user()->type == 1)
                                <li><a href="#">Управление заявками</a></li>
                                <li><a href="#">Создать задание</a></li>
                                @else
                                <li><a href="#">Мои заявки <span class="nav-tag">4</span></a></li>
                                @endif
                            </ul>	
                        </li>
                    </ul>

                    <ul data-submenu-title="Аккаунт">
                        <li class="{{ (Route::currentRouteName() == 'profile.settings.show') ? 'active':'' }}"><a href="{{ route('profile.settings.show') }}"><i class="icon-material-outline-settings"></i> Настройки</a></li>
                        <li><a href="{{ route('logout') }}"><i class="icon-material-outline-power-settings-new"></i> Выйти</a></li>
                    </ul>
                    
                </div>
            </div>
            <!-- Navigation / End -->

        </div>
    </div>
</div>