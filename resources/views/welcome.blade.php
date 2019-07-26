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
					<h3>Не думай, делай</h3>
					<span>Find the best jobs in the digital industry</span>
				</div>
			</div>
		</div>
		
		<!-- Search Bar -->
		<div class="row">
			<div class="col-md-12">
				<div class="intro-banner-search-form margin-top-95">

					<!-- Search Field -->
					<div class="intro-search-field with-autocomplete">
						<label for="autocomplete-input" class="field-title ripple-effect">Where?</label>
						<div class="input-with-icon">
							<input id="autocomplete-input" type="text" placeholder="Online Job">
							<i class="icon-material-outline-location-on"></i>
						</div>
					</div>

					<!-- Search Field -->
					<div class="intro-search-field">
						<label for ="intro-keywords" class="field-title ripple-effect">What job you want?</label>
						<input id="intro-keywords" type="text" placeholder="Job Title or Keywords">
					</div>

					<!-- Button -->
					<div class="intro-search-button">
						<button class="button ripple-effect" onclick="window.location.href='jobs-list-layout-1.html'">Search</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Stats -->
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
				</div>
				
				<!-- Jobs Container -->
				<div class="listings-container compact-list-layout margin-top-35">
					
					@foreach($tasks as $task)
					<a href="{{ route('tasks.show', $task->id) }}" class="job-listing with-apply-button">
						<!-- Job Listing Details -->
						<div class="job-listing-details">
							<!-- Logo -->
							<div class="job-listing-company-logo">
								<img src="images/company-logo-05.png" alt="">
							</div>

							<!-- Details -->
							<div class="job-listing-description">
								<h3 class="job-listing-title">{{ $task->title }}</h3>

								<!-- Job Listing Footer -->
								<div class="job-listing-footer">
									<ul>
										<li><i class="icon-material-outline-business"></i> {{ $task->user->name }} <div class="verified-badge" title="Verified Employer" data-tippy-placement="top"></div></li>
										<li><i class="icon-material-outline-location-on"></i> San Francissco</li>
										<li><i class="icon-material-outline-business-center"></i> Full Time</li>
										<li><i class="icon-material-outline-access-time"></i> {{ $task->created_at->diffForHumans() }}</li>
									</ul>
								</div>
							</div>

							<!-- Apply Button -->
							<span class="list-apply-button ripple-effect">Подробнее</span>
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
<div class="photo-section" data-background-image="images/section-background.jpg">

	<!-- Infobox -->
	<div class="text-content white-font">
		<div class="container">

			<div class="row">
				<div class="col-lg-6 col-md-8 col-sm-12">
					<h2>Hire experts or be hired. <br> For any job, any time.</h2>
					<p>Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation is on the runway towards.</p>
					<a href="pages-pricing-plans.html" class="button button-sliding-icon ripple-effect big margin-top-20">Get Started <i class="icon-material-outline-arrow-right-alt"></i></a>
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
								<img src="images/blog-03a.jpg" alt="">
								<span class="blog-item-tag">Marketing</span>
								<div class="blog-compact-item-content">
									<ul class="blog-post-tags">
										<li>{{ $post->created_at->isoFormat('d MMMM Y') }}</li>
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

<div class="section border-top padding-top-45 padding-bottom-45">
	<!-- Logo Carousel -->
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<!-- Carousel -->
				<div class="col-md-12">
					<div class="logo-carousel">
						
						<div class="carousel-item">
							<a href="http://acmelogos.com/" target="_blank" title="http://acmelogos.com/"><img src="images/logo-carousel-01.png" alt=""></a>
						</div>
						
						<div class="carousel-item">
							<a href="http://acmelogos.com/" target="_blank" title="http://acmelogos.com/"><img src="images/logo-carousel-02.png" alt=""></a>
						</div>
						
						<div class="carousel-item">
							<a href="http://acmelogos.com/" target="_blank" title="http://acmelogos.com/"><img src="images/logo-carousel-03.png" alt=""></a>
						</div>
						
						<div class="carousel-item">
							<a href="http://acmelogos.com/" target="_blank" title="http://acmelogos.com/"><img src="images/logo-carousel-04.png" alt=""></a>
						</div>
						
						<div class="carousel-item">
							<a href="http://acmelogos.com/" target="_blank" title="http://acmelogos.com/"><img src="images/logo-carousel-05.png" alt=""></a>
						</div>

						<div class="carousel-item">
							<a href="http://acmelogos.com/" target="_blank" title="http://acmelogos.com/"><img src="images/logo-carousel-06.png" alt=""></a>
						</div>

					</div>
				</div>
				<!-- Carousel / End -->
			</div>
		</div>
	</div>
</div>
@endsection
@section('content')

@endsection