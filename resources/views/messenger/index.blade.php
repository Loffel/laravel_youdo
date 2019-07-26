@extends('layouts.app')

@section('content')
{{--  <div class="container" id="app">
    <div class="row justify-content-center">
        <messenger></messenger>
    </div>
</div>  --}}


<div class="dashboard-container">

	@include('includes/dashboard_sidebar')


	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Сообщения</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Главная</a></li>
						<li><a href="#">Панель управления</a></li>
						<li>Сообщения</li>
					</ul>
				</nav>
			</div>
    
            <messenger></messenger>
			
			<!-- Messages Container / End -->
            @include('includes/dashboard_footer')
		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>
@endsection

@push('scripts')

@endpush