@extends('layouts.app')

@section('content')
<div class="margin-top-90"></div>
<div class="container">
	<div class="row">
		<div class="col-xl-3 col-lg-4">
			<div class="sidebar-container">
				<form method="GET" action="{{ route('tasks.index') }}">
					<input type="hidden" name="min_price" value="{{ $minPrice }}">
					<input type="hidden" name="max_price" value="{{ $maxPrice }}">
					<input type="hidden" name="sort" value="{{ (isset($filters['sort'])) ? $filters['sort']: 'desc' }}">
					<!-- Budget -->
					<div class="sidebar-widget">
						<h3>Бюджет</h3>
						<div class="margin-top-55"></div>

						<!-- Range Slider -->
						<input class="range-slider" id="priceFilter" type="text" value="" data-slider-currency="₽" data-slider-min="{{ $minPrice }}" data-slider-max="{{ $maxPrice }}" data-slider-step="100" data-slider-value="[{{ (isset($filters['min_price'])) ? $filters['min_price']:$minPrice }},{{ (isset($filters['max_price'])) ? $filters['max_price']:$maxPrice }}]"/>
						<div class="clearfix"></div>
					</div>

					<div class="sidebar-widget">
						<button style="width: 100%" class="button button-sliding-icon ripple-effect" type="submit">Искать <i class="icon-material-outline-arrow-right-alt"></i></button>
					</div>
				</form>
			</div>
		</div>
		<div class="col-xl-9 col-lg-8 content-left-offset">

			<h3 class="page-title">Результат поиска</h3>

			<div class="notify-box margin-top-15">
				<div class="sort-by">
					<span class="margin-right-5">Сортировать: </span>
					<a class="margin-right-5" href="{{ route('tasks.index', array('min_price' => request('min_price'), 'max_price' => request('max_price'), 'sort' => 'desc') ) }}">Новые </a>/ 
					<a class="margin-left-5" href="{{ route('tasks.index', array('min_price' => request('min_price'), 'max_price' => request('max_price'), 'sort' => 'asc') ) }}"> Старые</a>
					{{--  <select class="hide-tick">
						<option>Сначала новые</option>
						<option>Сначала старые</option>
						<option>Случайно</option>
					</select>  --}}
				</div>
			</div>
			
			<!-- Tasks Container -->
			<div class="tasks-list-container margin-top-35">
				
				@foreach($tasks as $task)
				<a href="{{ route('tasks.show', $task->id) }}" class="task-listing">

					<!-- Job Listing Details -->
					<div class="task-listing-details">

						<!-- Details -->
						<div class="task-listing-description">
							<h3 class="task-listing-title">{{ $task->title }}</h3>
							<ul class="task-icons">
								<li><i class="icon-material-outline-business-center"></i> {{ $task->user->name }}</li>
								<li><i class="icon-material-outline-access-time"></i> {{ $task->created_at->diffForHumans() }}</li>
							</ul>
							<p class="task-listing-text">{{ $task->description }}</p>
						</div>

					</div>

					<div class="task-listing-bid">
						<div class="task-listing-bid-inner">
							<div class="task-offers">
								<strong>@money($task->price) руб.</strong>
								<span>Завершить до: {{ $task->date_end->format('d.m.y') }}</span>
							</div>
							<span class="button button-sliding-icon ripple-effect">Подробнее <i class="icon-material-outline-arrow-right-alt"></i></span>
						</div>
					</div>
                </a>
                @endforeach
                
                
				<!-- Pagination -->
				{{ $tasks->appends($filters)->links('paginator') }}
			</div>
			<!-- Tasks Container / End -->

		</div>
	</div>
</div>

<tasks-filters></tasks-filters>
@endsection
