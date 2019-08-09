@extends('layouts.app')

@section('content')
<div class="single-page-header freelancer-header" data-background-image="{{ asset('images/single-freelancer.jpg')}}">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="single-page-header-inner">
					<div class="left-side">
						<div class="header-image freelancer-avatar"><img src="{{ $user->getAvatar() }}" alt=""></div>
						<div class="header-details">
							<h3>{{ $user->name }} <span>{{ $user->getTypeName() }}</span></h3>
							<ul>
								<li><div class="star-rating" data-rating="5.0"></div></li>
                                @if($user->type == 2 && $user->is_verified)
                                <li><div class="verified-badge-with-title">Проверен</div></li>
                                @endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Page Content
================================================== -->
<div class="container">
	<div class="row">
		
		<!-- Content -->
		<div class="col-xl-8 col-lg-8 content-right-offset">
			
			<!-- Page Content -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25">Обо мне</h3>
				<p>{{$user->about}}</p>
			</div>

			<!-- Boxed List -->
			<div class="boxed-list margin-bottom-60">
				<div class="boxed-list-headline">
					<h3><i class="icon-material-outline-thumb-up"></i> Отзывы</h3>
				</div>
				<ul class="boxed-list-ul">
					<li>
						<div class="boxed-list-item">
							<!-- Content -->
							<div class="item-content">
								<h4>API разработчик <span>Фрилансер</span></h4>
								<div class="item-details margin-top-10">
									<div class="star-rating" data-rating="5.0"></div>
									<div class="detail-item"><i class="icon-material-outline-date-range"></i> Август 2019</div>
								</div>
								<div class="item-description">
									<p>Отличный программист - полностью выполнил задание, очень профессионально.</p>
								</div>
							</div>
						</div>
					</li>
				</ul>

				<!-- Pagination -->
				{{--  <div class="clearfix"></div>
				<div class="pagination-container margin-top-40 margin-bottom-10">
					<nav class="pagination">
						<ul>
							<li><a href="#" class="ripple-effect current-page">1</a></li>
							<li><a href="#" class="ripple-effect">2</a></li>
							<li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
						</ul>
					</nav>
				</div>
				<div class="clearfix"></div>  --}}
				<!-- Pagination / End -->

			</div>
			<!-- Boxed List / End -->

		</div>
		

		<!-- Sidebar -->
		<div class="col-xl-4 col-lg-4">
			<div class="sidebar-container">
				
				<!-- Profile Overview -->
				<div class="profile-overview">
					<div class="overview-item"><strong>0</strong><span>{{($user->type == 1) ? 'Заданий создано': 'Заданий выполнено'}}</span></div>
				</div>

				@if($user->type == 2)
				<a href="#small-dialog" class="apply-now-button popup-with-zoom-anim margin-bottom-50">Предложить задание <i class="icon-material-outline-arrow-right-alt"></i></a>
				@endif

				<!-- Widget -->
				<div class="sidebar-widget">
					<h3>Социальные сети</h3>
					<div class="freelancer-socials margin-top-25">
						<ul>
							<li><a href="#" title="Dribbble" data-tippy-placement="top"><i class="icon-brand-dribbble"></i></a></li>
							<li><a href="#" title="Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
							<li><a href="#" title="Behance" data-tippy-placement="top"><i class="icon-brand-behance"></i></a></li>
							<li><a href="#" title="GitHub" data-tippy-placement="top"><i class="icon-brand-github"></i></a></li>
						</ul>
					</div>
				</div>

				<!-- Sidebar Widget -->
				<div class="sidebar-widget">
					<h3>Поделиться</h3>

					<!-- Copy URL -->
					<div class="copy-url">
						<input id="copy-url" type="text" value="" class="with-border">
						<button class="copy-url-button ripple-effect" data-clipboard-target="#copy-url" title="Скопировать" data-tippy-placement="top"><i class="icon-material-outline-file-copy"></i></button>
					</div>

					<!-- Share Buttons -->
					<div class="share-buttons margin-top-25">
						<div class="share-buttons-trigger"><i class="icon-feather-share-2"></i></div>
						<div class="share-buttons-content">
							<span>Понравилось? <strong>Поделитесь!</strong></span>
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

<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab">Сделать предложение</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab">
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Обсудите свое задание с {{$user->name}}</h3>
				</div>
					
				<!-- Form -->
				<form method="post">

					<div class="input-with-icon-left">
						<i class="icon-material-outline-account-circle"></i>
						<input type="text" class="input-text with-border" name="name" id="name" placeholder="Имя"/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" name="emailaddress" id="emailaddress" placeholder="Email"/>
					</div>

					<textarea name="textarea" cols="10" placeholder="Сообщение..." class="with-border"></textarea>

					<div class="uploadButton margin-top-25">
						<input class="uploadButton-input" type="file" accept="image/*, application/pdf" id="upload" multiple/>
						<label class="uploadButton-button ripple-effect" for="upload">Add Attachments</label>
						<span class="uploadButton-file-name">Расширения: zip, pdf, png, jpg <br> Максимальный размер файла: 50 МБ.</span>
					</div>

				</form>
				
				<!-- Button -->
				<button class="button margin-top-35 full-width button-sliding-icon ripple-effect" type="submit">Отправить предложение <i class="icon-material-outline-arrow-right-alt"></i></button>

			</div>
			<!-- Login -->
			<div class="popup-tab-content" id="loginn">
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Discuss Your Project With Tom</h3>
				</div>
					
				<!-- Form -->
				<form method="post" id="make-an-offer-form">

					<div class="input-with-icon-left">
						<i class="icon-material-outline-account-circle"></i>
						<input type="text" class="input-text with-border" name="name2" id="name2" placeholder="First and Last Name" required/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" name="emailaddress2" id="emailaddress2" placeholder="Email Address" required/>
					</div>

					<textarea name="textarea" cols="10" placeholder="Message" class="with-border"></textarea>

					<div class="uploadButton margin-top-25">
						<input class="uploadButton-input" type="file" accept="image/*, application/pdf" id="upload-cv" multiple/>
						<label class="uploadButton-button" for="upload-cv">Add Attachments</label>
						<span class="uploadButton-file-name">Allowed file types: zip, pdf, png, jpg <br> Max. files size: 50 MB.</span>
					</div>

				</form>
				
				<!-- Button -->
				<button class="button full-width button-sliding-icon ripple-effect" type="submit" form="make-an-offer-form">Make an Offer <i class="icon-material-outline-arrow-right-alt"></i></button>

			</div>

		</div>
	</div>
</div>
@endsection
