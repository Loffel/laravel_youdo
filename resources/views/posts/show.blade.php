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
						<img src="{{ asset('storage/'.$post->cover) }}" alt="">
					</div>
				</div>

				<!-- Blog Post Content -->
				<div class="blog-post-content">
					<h3 class="margin-bottom-10">{{ $post->title }}</h3>

					<div class="blog-post-info-list margin-bottom-20">
						<a href="#" class="blog-post-info">{{ $post->created_at->isoFormat('D MMMM YYYY') }}</a>
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
				@if(isset($nextPost))
				<li class="next-post">
					<a href="{{ route('posts.show', $nextPost->id) }}">
						<span>Следующий пост</span>
						<strong>{{ $nextPost->title }}</strong>
					</a>
				</li>
				@endif
				@if(isset($previousPost))
				<li class="prev-post">
					<a href="{{ route('posts.show', $previousPost->id) }}">
						<span>Предыдущий пост</span>
						<strong>{{ $previousPost->title }}</strong>
					</a>
				</li>
				@endif
			</ul>
		</div>
		<!-- Inner Content / End -->


		<div class="col-xl-4 col-lg-4 content-left-offset">
			<div class="sidebar-container">

				@auth
					@if(Auth::user()->is_admin)
					<div class="sidebar-widget">
						<div class="bidding-widget">
							<div class="bidding-headline"><h3>Управление постом</h3></div>
							<div class="bidding-inner">
								<span class="bidding-detail">Действия с <strong>постом</strong></span>

								<div class="bidding-fields">
									<div class="bidding-field">
										<a href="{{ route('posts.edit', $post->id) }}" class="button ripple-effect move-on-hover">Редактировать</a>
									</div>
									<div class="bidding-field">
										<form action="{{ route('posts.delete', $post->id) }}" method="POST" class="float-right">
											@csrf
											{{ method_field('DELETE') }}
											<button type="submit" class="button dark ripple-effect move-on-hover">Удалить</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endif
				@endauth
				<!-- Widget -->
				<div class="sidebar-widget">
					<h3>Поделиться в соц. сетях</h3>
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
@endsection
