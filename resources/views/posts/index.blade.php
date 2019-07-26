@extends('layouts.app')

@section('content')
<div id="titlebar" class="white margin-bottom-30">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Блог</h2>
				<span>Популярные посты</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Главная</a></li>
						<li>Блог</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>

<!-- Recent Blog Posts -->
<div class="section white padding-top-0 padding-bottom-60 full-width-carousel-fix">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="blog-carousel">
                    @foreach($posts->take(5) as $post)
					<a href="{{ route('posts.show', $post->id) }}" class="blog-compact-item-container">
						<div class="blog-compact-item">
							<img src="{{ asset('images/blog-04a.jpg')}}" alt="">
							<span class="blog-item-tag">Тег</span>
							<div class="blog-compact-item-content">
								<ul class="blog-post-tags">
									<li>{{ $post->created_at->isoFormat('d MMMM YYYY') }}</li>
								</ul>
								<h3>{{ $post->title }}</h3>
								<p>{{Str::limit($post->content, 100)}}</p>
							</div>
						</div>
					</a>
                    @endforeach
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Recent Blog Posts / End -->


<!-- Section -->
<div class="section gray">
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-8">

				<!-- Section Headline -->
				<div class="section-headline margin-top-60 margin-bottom-35">
					<h4>Последние посты</h4>
				</div>

				@foreach($posts as $post)
				<a href="{{ route('posts.show', $post->id) }}" class="blog-post">
					<!-- Blog Post Thumbnail -->
					<div class="blog-post-thumbnail">
						<div class="blog-post-thumbnail-inner">
							<span class="blog-item-tag">Тег</span>
							<img src="{{ asset('images/blog-04a.jpg')}}" alt="">
						</div>
					</div>
					<!-- Blog Post Content -->
					<div class="blog-post-content">
						<span class="blog-post-date">{{ $post->created_at->isoFormat('d MMMM YYYY') }}</span>
						<h3>{{ $post->title }}</h3>
						<p>{{ Str::limit($post->content, 100) }}</p>
					</div>
					<!-- Icon -->
					<div class="entry-icon"></div>
				</a>
				@endforeach
				{{$posts->links('paginator')}}
			</div>


			<div class="col-xl-4 col-lg-4 content-left-offset">
				<div class="sidebar-container margin-top-65">
					
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
								<a href="pages-blog-post.html" class="widget-content active">
									<img src="images/blog-02a.jpg" alt="">
									<div class="widget-text">
										<h5>How to "Woo" a Recruiter and Land Your Dream Job</h5>
										<span>29 June 2018</span>
									</div>
								</a>
							</li>

							<!-- Post #2 -->
							<li>
								<a href="pages-blog-post.html" class="widget-content">
									<img src="images/blog-07a.jpg" alt="">
									<div class="widget-text">
										<h5>What It Really Takes to Make $100k Before You Turn 30</h5>
										<span>3 June 2018</span>
									</div>
								</a>
							</li>
							<!-- Post #3 -->
							<li>
								<a href="pages-blog-post.html" class="widget-content">
									<img src="images/blog-04a.jpg" alt="">
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

</div>
<!-- Section / End -->

@endsection
