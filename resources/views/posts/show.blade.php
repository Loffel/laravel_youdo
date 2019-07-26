@extends('layouts.app')

@section('content')
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Блог</h2>
				<span>{{ $post->title }}</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Главная</a></li>
						<li><a href="#">Блог</a></li>
						<li>{{ $post->title }}</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>

<!-- Post Content -->
<div class="container">
	<div class="row">
		
		<!-- Inner Content -->
		<div class="col-xl-8 col-lg-8">
			<!-- Blog Post -->
			<div class="blog-post single-post">

				<!-- Blog Post Thumbnail -->
				<div class="blog-post-thumbnail">
					<div class="blog-post-thumbnail-inner">
						<span class="blog-item-tag">Tips</span>
						<img src="{{ asset('images/blog-04.jpg')}}" alt="">
					</div>
				</div>

				<!-- Blog Post Content -->
				<div class="blog-post-content">
					<h3 class="margin-bottom-10">{{ $post->title }}</h3>

					<div class="blog-post-info-list margin-bottom-20">
						<a href="#" class="blog-post-info">{{ $post->created_at->isoFormat('d MMMM YYYY') }}</a>
					</div>

					<p>{{ $post->content }}</p>

					<!-- Share Buttons -->
					<div class="share-buttons margin-top-25">
						<div class="share-buttons-trigger"><i class="icon-feather-share-2"></i></div>
						<div class="share-buttons-content">
							<span>Интересно? <strong>Поделитесь!</strong></span>
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
			<!-- Blog Post Content / End -->
			
			<!-- Blog Nav -->
			<ul id="posts-nav" class="margin-top-0 margin-bottom-40">
				<li class="next-post">
					<a href="#">
						<span>Следующий пост</span>
						<strong>16 Ridiculously Easy Ways to Find & Keep a Remote Job</strong>
					</a>
				</li>
				<li class="prev-post">
					<a href="#">
						<span>Предыдущий пост</span>
						<strong>11 Tips to Help You Get New Clients Through Cold Calling</strong>
					</a>
				</li>
			</ul>
			
			<!-- Related Posts -->
			<div class="row">
				
				<!-- Headline -->
				<div class="col-xl-12">
					<h3 class="margin-top-40 margin-bottom-35">Похожие посты</h3>
				</div>

				<!-- Blog Post Item -->
				<div class="col-xl-6">
					<a href="pages-blog-post.html" class="blog-compact-item-container">
						<div class="blog-compact-item">
							<img src="{{ asset('images/blog-02a.jpg')}}" alt="">
							<span class="blog-item-tag">Recruiting</span>
							<div class="blog-compact-item-content">
								<ul class="blog-post-tags">
									<li>29 June 2018</li>
								</ul>
								<h3>How to "Woo" a Recruiter and Land Your Dream Job</h3>
								<p>Appropriately empower dynamic leadership skills after business portals. Globally myocardinate interactive.</p>
							</div>
						</div>
					</a>
				</div>
				<!-- Blog post Item / End -->

				<!-- Blog Post Item -->
				<div class="col-xl-6">
					<a href="pages-blog-post.html" class="blog-compact-item-container">
						<div class="blog-compact-item">
							<img src="{{ asset('images/blog-03a.jpg')}}" alt="">
							<span class="blog-item-tag">Marketing</span>
							<div class="blog-compact-item-content">
								<ul class="blog-post-tags">
									<li>10 June 2018</li>
								</ul>
								<h3>11 Tips to Help You Get New Clients Through Cold Calling</h3>
								<p>Compellingly embrace empowered e-business after user friendly intellectual capital. Interactively front-end.</p>
							</div>
						</div>
					</a>
				</div>
				<!-- Blog post Item / End -->
			</div>
			<!-- Related Posts / End -->

		</div>
		<!-- Inner Content / End -->


		<div class="col-xl-4 col-lg-4 content-left-offset">
			<div class="sidebar-container">
				
				<!-- Location -->
				<div class="sidebar-widget margin-bottom-40">
					<div class="input-with-icon">
						<input id="autocomplete-input" type="text" placeholder="Поиск">
						<i class="icon-material-outline-search"></i>
					</div>
				</div>

				<!-- Widget -->
				<div class="sidebar-widget">

					<h3>Trending Posts</h3>
					<ul class="widget-tabs">

						<!-- Post #1 -->
						<li>
							<a href="#" class="widget-content active">
								<img src="{{ asset('images/blog-02a.jpg')}}" alt="">
								<div class="widget-text">
									<h5>How to "Woo" a Recruiter and Land Your Dream Job</h5>
									<span>29 June 2018</span>
								</div>
							</a>
						</li>

						<!-- Post #2 -->
						<li>
							<a href="#" class="widget-content">
								<img src="{{ asset('images/blog-07a.jpg')}}" alt="">
								<div class="widget-text">
									<h5>What It Really Takes to Make $100k Before You Turn 30</h5>
									<span>3 June 2018</span>
								</div>
							</a>
						</li>
						<!-- Post #3 -->
						<li>
							<a href="#" class="widget-content">
								<img src="{{ asset('images/blog-04a.jpg')}}" alt="">
								<div class="widget-text">
									<h5>5 Myths That Prevent Job Seekers from Overcoming Failure</h5>
									<span>5 June 2018</span>
								</div>
							</a>
						</li>
					</ul>

				</div>
				<!-- Widget / End-->


				<!-- Widget -->
				<div class="sidebar-widget">
					<h3>Social Profiles</h3>
					<div class="freelancer-socials margin-top-25">
						<ul>
							<li><a href="#" title="Dribbble" data-tippy-placement="top"><i class="icon-brand-dribbble"></i></a></li>
							<li><a href="#" title="Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
							<li><a href="#" title="Behance" data-tippy-placement="top"><i class="icon-brand-behance"></i></a></li>
							<li><a href="#" title="GitHub" data-tippy-placement="top"><i class="icon-brand-github"></i></a></li>
						</ul>
					</div>
				</div>

				<!-- Widget -->
				<div class="sidebar-widget">
					<h3>Tags</h3>
					<div class="task-tags">
						<a href="#"><span>employer</span></a>
						<a href="#"><span>recruiting</span></a>
						<a href="#"><span>work</span></a>
						<a href="#"><span>salary</span></a>
						<a href="#"><span>tips</span></a>
						<a href="#"><span>income</span></a>
						<a href="#"><span>application</span></a>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>

<!-- Spacer -->
<div class="padding-top-40"></div>
<!-- Spacer -->
@endsection
