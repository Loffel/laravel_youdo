@extends('layouts.app')
@section('intro')
<div class="intro-banner dark-overlay" data-background-image="{{ asset('images/home-background-02.jpg') }}">
	
	<!-- Transparent Header Spacer -->
	<div class="transparent-header-spacer"></div>

	<div class="container">
		
		<!-- Intro Headline -->
		<div class="row">
			<div class="col-md-12">
				<div class="banner-headline-alt">
					<h3>Удобный сервис заказа заявки для ЭА</h3>
					<span>Найди исполнителя для составления первой части заявки прямо сейчас!</span>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<ul class="intro-stats margin-top-45 hide-under-992px">
					<li>
						<strong class="counter">{{ $tasksCount }}</strong>
						<span>Заданий</span>
					</li>
					<li>
						<strong class="counter">{{ $clientsCount }}</strong>
						<span>Заказчиков</span>
					</li>
					<li>
						<strong class="counter">{{ $executorsCount }}</strong>
						<span>Исполнителей</span>
					</li>
				</ul>
			</div>
		</div>

	</div>
</div>

<!-- Features Jobs -->
<div class="section padding-top-65 padding-bottom-75">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				
				<!-- Section Headline -->
				<div class="section-headline margin-top-0 margin-bottom-35">
					<h3>Последние задания</h3>
					<a href="{{ route('tasks.index') }}" class="headline-link">Все задания</a>
					@auth
						@if(auth()->user()->type == 1)
						<a href="{{ route('tasks.create') }}" class="headline-new-task">Новое задание</a>
						@endif
					@endauth
				</div>
				
				<!-- Jobs Container -->
				<div class="listings-container compact-list-layout margin-top-35">
					
					@foreach($tasks as $task)
					<a href="{{ route('tasks.show', $task->id) }}" class="job-listing with-apply-button">
						<!-- Job Listing Details -->
						<div class="job-listing-details">
							<!-- Logo -->
							<div class="job-listing-company-logo">
								<img src="{{ $task->getLogo() }}" alt="{{ $task->title }}">
							</div>

							<!-- Details -->
							<div class="job-listing-description">
								<h3 class="job-listing-title">{{ $task->title }}</h3>

								<!-- Job Listing Footer -->
								<div class="job-listing-footer">
									<ul>
										<li><i class="icon-material-outline-business"></i> {{ $task->user->name }} <!-- <div class="verified-badge" title="Проверенный" data-tippy-placement="top"></div> --></li>
										<li><i class="icon-material-outline-access-time"></i> {{ $task->date_end->diffForHumans() }}</li>
									</ul>
								</div>
							</div>

							<!-- Apply Button -->
							<span class="list-apply-button ripple-effect"><span>₽@money($task->price)</span></span>
						</div>
					</a>	
                    @endforeach
				</div>
				<!-- Jobs Container / End -->

			</div>
		</div>
	</div>
</div>
<!-- Featured Jobs / End -->


<!-- Photo Section -->
<div class="photo-section" data-background-image="{{ asset('images/section-background.jpg')}}">

	<!-- Infobox -->
	<div class="text-content white-font">
		<div class="container">

			<div class="row">
				<div class="col-lg-6 col-md-8 col-sm-12">
					<h2>Только надежные исполнители.<br> Проверены администрацией сайта.</h2>
					<p>С помощью данного сервиса вы можете стать заказчиком или исполнителем услуги составления первой части заявки для электронного аукциона.</p>
					<a href="{{ route('register') }}" class="button button-sliding-icon ripple-effect big margin-top-20">Регистрация <i class="icon-material-outline-arrow-right-alt"></i></a>
				</div>
			</div>

		</div>
	</div>

	<!-- Infobox / End -->

</div>
<!-- Photo Section / End -->


<!-- Recent Blog Posts -->
<div class="section padding-top-65 padding-bottom-50">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				
				<!-- Section Headline -->
				<div class="section-headline margin-top-0 margin-bottom-45">
					<h3>Блог</h3>
					<a href="{{ route('posts.index') }}" class="headline-link">Все посты</a>
				</div>

				<div class="row">
                    @foreach($posts as $post)
					<div class="col-xl-4">
						<a href="{{ route('posts.show', $post->id) }}" class="blog-compact-item-container">
							<div class="blog-compact-item">
								<img src="{{ asset('storage/'.$post->cover) }}" alt="">
								<div class="blog-compact-item-content">
									<ul class="blog-post-tags">
										<li>{{ $post->created_at->isoFormat('D MMMM Y') }}</li>
									</ul>
									<h3>{{ $post->title }}</h3>
									<p>{{ Str::limit($post->content, 100, '...') }}</p>
								</div>
							</div>
						</a>
					</div>
                    @endforeach
				</div>


			</div>
		</div>
	</div>
</div>
<!-- Recent Blog Posts / End -->

@endsection