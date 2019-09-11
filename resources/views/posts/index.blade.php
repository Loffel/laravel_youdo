@extends('layouts.app')

@section('content')
<div id="titlebar" class="white margin-bottom-30">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Блог</h2>
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
							<img src="{{ asset('storage/'.$post->cover) }}" alt="">
						</div>
					</div>
					<!-- Blog Post Content -->
					<div class="blog-post-content">
						<span class="blog-post-date">{{ $post->created_at->isoFormat('D MMMM YYYY') }}</span>
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
					<!-- Widget -->
					<div class="sidebar-widget">
						<h3>Поделиться</h3>
						<div class="freelancer-socials margin-top-25">
							<ul>
								<li><a href="#" title="Dribbble" data-tippy-placement="top"><i class="icon-brand-dribbble"></i></a></li>
								<li><a href="#" title="Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
								<li><a href="#" title="Behance" data-tippy-placement="top"><i class="icon-brand-behance"></i></a></li>
								<li><a href="#" title="GitHub" data-tippy-placement="top"><i class="icon-brand-github"></i></a></li>
							</ul>
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
