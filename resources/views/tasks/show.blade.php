@extends('layouts.app')

@section('content')
<div class="single-page-header" data-background-image="{{ asset('images/single-task.jpg') }}">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="single-page-header-inner">
					<div class="left-side">
						<div class="header-image"><a href="#"><img src="{{ asset('images/browse-companies-02.png') }}" alt=""></a></div>
						<div class="header-details">
							<h3>{{ $task->title }}</h3>
							<h5>О заказчике</h5>
							<ul>
								<li><a href="{{ route('profile.show', $task->user->id) }}"><i class="icon-material-outline-business"></i> {{ $task->user->name }}</a></li>
								<li><div class="star-rating" data-rating="5.0"></div></li>
								<li><img class="flag" src="{{asset('images/flags/de.svg')}}" alt=""> Germany</li>
								<li><div class="verified-badge-with-title">Verified</div></li>
							</ul>
						</div>
					</div>
					<div class="right-side">
						<div class="salary-box">
							<div class="salary-type">Бюджет</div>
							<div class="salary-amount">₽@money($task->price)</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		
		<!-- Content -->
		<div class="col-xl-8 col-lg-8 content-right-offset">
			
			<!-- Description -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25">Описание</h3>
				<p>{{ $task->description }}</p>
			</div>

			<div class="clearfix"></div>
			
			<!-- Freelancers Bidding -->
			<div class="boxed-list margin-bottom-60">
				<div class="boxed-list-headline">
					<h3><i class="icon-material-outline-group"></i> Предложения</h3>
				</div>
				<ul class="boxed-list-ul">
                    @if($userProposal === NULL)
                        @foreach($task->proposals as $proposal)
                        <li>
                            <div class="bid">
                                <!-- Avatar -->
                                <div class="bids-avatar">
                                    <div class="freelancer-avatar">
                                        <div class="verified-badge"></div>
                                        <a href="{{ route('profile.show', $proposal->user->id) }}"><img src="{{ asset('images/user-avatar-big-01.jpg')}}" alt=""></a>
                                    </div>
                                </div>
                                
                                <!-- Content -->
                                <div class="bids-content">
                                    <!-- Name -->
                                    <div class="freelancer-name">
                                        <h4><a href="{{ route('profile.show', $proposal->user->id) }}">{{ $proposal->user->name }} <img class="flag" src="{{asset('images/flags/gb.svg')}}" alt="" title="United Kingdom" data-tippy-placement="top"></a></h4>
                                        <span class="not-rated">{{ $proposal->description }}</span>
                                    </div>
                                </div>
                                
                                <!-- Bid -->
                                <div class="bids-bid">
                                    <div class="bid-rate">
                                        @if($task->proposal_id == $proposal->id)
                                        <div class="rate">₽{{ $proposal->price }}</div>
                                        <span>Выбран исполнителем!</span>
                                        @else
                                        <a href="{{ route('tasks.select_proposal.view', array($task->id, $proposal->id)) }}" class="move-on-hover">
                                            <div class="rate">₽{{ $proposal->price }}</div>
                                            <span>Выбрать исполнителем</span>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    @else
                    <li>
                        <div class="bid">
                            <!-- Avatar -->
                            <div class="bids-avatar">
                                <div class="freelancer-avatar">
                                    <div class="verified-badge"></div>
                                    <a href="#"><img src="{{ asset('images/user-avatar-big-01.jpg')}}" alt=""></a>
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="bids-content">
                                <!-- Name -->
                                <div class="freelancer-name">
                                    <h4><a href="#">Вы <img class="flag" src="{{asset('images/flags/gb.svg')}}" alt="" title="United Kingdom" data-tippy-placement="top"></a></h4>
                                    <span class="not-rated">{{ $userProposal->description }}</span>
                                </div>
                            </div>
                            
                            <!-- Bid -->
                            <div class="bids-bid">
                                <div class="bid-rate">
                                    <div class="rate">₽{{ $userProposal->price }}</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endif
				</ul>
			</div>

		</div>
		
		<!-- Sidebar -->
		<div class="col-xl-4 col-lg-4">
			<div class="sidebar-container">

				<div class="countdown green margin-bottom-35">Будет завершено {{ $task->date_end->diffForHumans() }}</div>

                @if($task->user->id != Auth::user()->id)
                    @if($userProposal === NULL)
                    <div class="sidebar-widget">
                        <div class="bidding-widget">
                            <div class="bidding-headline"><h3>Оставить предложение</h3></div>
                            <div class="bidding-inner">
                                <form action="{{ route('proposals.store') }}" method="POST">
                                        @csrf
                                    <!-- Headline -->
                                    <span class="bidding-detail">Установите вашу <strong>цену</strong></span>

                                    <!-- Price Slider -->
                                    <div class="bidding-value">₽<span id="biddingVal"></span></div>
                                    <input class="bidding-slider" name="price" type="text" value="" data-slider-handle="custom" data-slider-currency="₽" data-slider-min="0" data-slider-max="50000" data-slider-value="auto" data-slider-step="500" data-slider-tooltip="hide" />
                                    
                                    <!-- Headline -->
                                    <span class="bidding-detail margin-top-30">Укажите <strong>комментарий</strong></span>

                                    <!-- Fields -->
                                    <div class="bidding-field">
                                        <textarea class="with-border" name="description" id="description" rows="3"></textarea>
                                    </div>

                                    @if($task->proposal_id !== NULL)
                                    <button id="snackbar-place-bid" title="Исполнитель выбран" data-tippy-placement="top" class="button ripple-effect move-on-hover full-width margin-top-30" disabled><span>Отправить</span></button>
                                    @else
                                    <button type="submit" id="snackbar-place-bid" class="button ripple-effect move-on-hover full-width margin-top-30"><span>Отправить</span></button>
                                    @endif
                                </form>
                            </div>
                            <div class="bidding-signup">Нет аккаунта? <a href="#" class="register-tab sign-in popup-with-zoom-anim">Создайте!</a></div>
                        </div>
                    </div>
                    @else
                        @if($task->proposal_id == $userProposal->id)
                        <div class="sidebar-widget">
                            <div class="bidding-widget">
                                <div class="bidding-headline"><h3>Вы выбраны исполнителем!</h3></div>
                                <div class="bidding-inner">
                                    <span class="bidding-detail">Задание <strong>выполнено</strong>?</span>
                                    <div class="bidding-fields">
                                        <div class="bidding-field">
                                            <a href="#" class="button ripple-effect move-on-hover">Да</a>
                                        </div>
                                        <div class="bidding-field">
                                            <a href="#" class="button ripple-effect move-on-hover">Нет</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif
                @else
                    <div class="sidebar-widget">
                        <div class="bidding-widget">
                            <div class="bidding-headline"><h3>Управление заданием</h3></div>
                            <div class="bidding-inner">
                                <span class="bidding-detail">Действия с <strong>заданием</strong></span>

                                <div class="bidding-fields">
                                    <div class="bidding-field">
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="button ripple-effect move-on-hover">Редактировать</a>
                                    </div>
                                    <div class="bidding-field">
                                        <form action="{{ route('tasks.delete', $task->id) }}" method="POST" class="float-right">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="button dark ripple-effect move-on-hover">Удалить</button>
                                        </form>
                                    </div>
                                </div>

                                <span class="bidding-detail margin-top-30">Задание <strong>выполнено?</strong></span>
                                <div class="bidding-fields">
                                    <div class="bidding-field">
                                        <a href="#" class="button ripple-effect move-on-hover">Да</a>
                                    </div>
                                    <div class="bidding-field">
                                        <a href="#" class="button ripple-effect move-on-hover">Нет</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

				<!-- Sidebar Widget -->
				<div class="sidebar-widget">
					<h3>Добавить в закладки / Поделиться</h3>

					<!-- Bookmark Button -->
					<button class="bookmark-button margin-bottom-25">
						<span class="bookmark-icon"></span>
						<span class="bookmark-text">В закладки</span>
						<span class="bookmarked-text">В закладках</span>
					</button>

					<!-- Copy URL -->
					<div class="copy-url">
						<input id="copy-url" type="text" value="" class="with-border">
						<button class="copy-url-button ripple-effect" data-clipboard-target="#copy-url" title="Copy to Clipboard" data-tippy-placement="top"><i class="icon-material-outline-file-copy"></i></button>
					</div>

					<!-- Share Buttons -->
					<div class="share-buttons margin-top-25">
						<div class="share-buttons-trigger"><i class="icon-feather-share-2"></i></div>
						<div class="share-buttons-content">
							<span>Интересно? <strong>Поделись!</strong></span>
							<ul class="share-buttons-icons">
								<li><a href="#" data-button-color="#3b5998" title="Share on Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
								<li><a href="#" data-button-color="#1da1f2" title="Share on Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
								<li><a href="#" data-button-color="#dd4b39" title="Share on Google Plus" data-tippy-placement="top"><i class="icon-brand-google-plus-g"></i></a></li>
								<li><a href="#" data-button-color="#0077b5" title="Share on LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>


<!-- Spacer -->
<div class="margin-top-15"></div>
<!-- Spacer / End-->
@endsection
