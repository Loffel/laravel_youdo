@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    @include('includes/dashboard_sidebar')
	<!-- Dashboard Content
    ================================================== -->
    <div class="dashboard-content-container" data-simplebar>
        <div class="dashboard-content-inner" >
            
            <!-- Dashboard Headline -->
            <div class="dashboard-headline">
                <h3>Отзывы</h3>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Главная</a></li>
                        <li><a href="#">Панель управления</a></li>
                        <li>Отзывы</li>
                    </ul>
                </nav>
            </div>
    
            <!-- Row -->
            <div class="row">
                    
                <div class="col-xl-12">
                    @if(Session::has('success') || Session::has('error'))
                    <div class="notification {{ Session::has('success') ? 'success':'error' }} closeable">
                        <p>{{ Session::has('success') ? Session::get('success'):Session::get('error') }}</p>
                        <a class="close"></a>
                    </div>
                    @endif
                    <div class="dashboard-box margin-top-0">

                        <!-- Headline -->
                        <div class="headline">
                            @if(Auth::user()->type == 2)
                            <h3><i class="icon-material-outline-business"></i> Оцените заказчиков</h3>
                            @else
                            <h3><i class="icon-material-outline-face"></i> Оцените исполнителей</h3>
                            @endif
                        </div>

                        <div class="content">
                            <ul class="dashboard-box-list">
                                @foreach($items as $item)
                                <li>
                                    <div class="boxed-list-item">
                                        <!-- Content -->
                                        <div class="item-content">
                                            <h4 data-user-name="{{ $item->userName }}" data-user-url="{{ $item->userURL }}" data-task-id="{{ $item->taskID }}" data-task-url="{{ $item->taskURL }}">{{ $item->taskTitle }}</h4>
                                            
                                            
                                            @if(isset($item->review))
                                            <div class="item-details margin-top-10">
                                                <div class="star-rating" data-id="{{ $item->review->id }}" data-courtesy="{{ $item->review->courtesy }}" data-punctuality="{{ $item->review->punctuality }}" data-adequacy="{{ $item->review->adequacy }}" data-rating="{{ $item->review->getAVG() }}"></div>
                                                <div class="detail-item"><i class="icon-material-outline-date-range"></i> {{ $item->review->created_at->isoFormat('D MMMM Y') }}</div>
                                            </div>
                                            <div class="item-description">
                                                <p>{{ $item->review->comment }}</p>
                                            </div>
                                            @else
                                            <span class="company-not-rated margin-bottom-5">Не оценено</span>
                                            @endif
                                            
                                        </div>
                                    </div>

                                    @if(isset($item->review))
                                    <a href="#small-dialog-1" id="reviewOpen" class="popup-with-zoom-anim button gray ripple-effect margin-top-5 margin-bottom-10">
                                        <i class="icon-feather-edit"></i> Изменить отзыв
                                    </a>
                                    @else
                                    <a href="#small-dialog-2" id="reviewOpen" class="popup-with-zoom-anim button ripple-effect margin-top-5 margin-bottom-10">
                                        <i class="icon-material-outline-thumb-up"></i> Оставить отзыв
                                    </a>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Pagination -->
                    {{ $items->links('paginator') }}
                    <!-- Pagination / End -->

                </div>
            </div>
            <!-- Row / End -->

            <!-- Footer -->
            @include('includes/dashboard_footer')
            <!-- Footer / End -->

        </div>
    </div>
    <!-- Dashboard Content / End -->    

</div>

<!-- Edit Review Popup
================================================== -->
<div id="small-dialog-1" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

    <!--Tabs -->
    <div class="sign-in-form">

        <ul class="popup-tabs-nav">
        </ul>

        <div class="popup-tabs-container">

            <!-- Tab -->
            <div class="popup-tab-content" id="tab1">
                
                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Изменить отзыв</h3>
                    <span>Оцените {{ auth()->user()->type == 1 ? 'исполнителя':'заказчика' }} <a href="#" id="reviewName">Имя</a> по заданию <a href="#" id="reviewTask">Название задания</a> </span>
                </div>
                    
                <!-- Form -->
                <form method="post" action="{{ route('reviews.update') }}" id="change-review-form">
                    @csrf
                    {{ method_field('PATCH') }}
                    <input type="hidden" id="review_id" name="review_id" value="">
                    <div class="feedback-yes-no">
                        <strong>Вежливость</strong>
                        <div class="leave-rating">
                            <input type="radio" name="courtesy" id="courtesy-radio-5" value="5" required>
                            <label for="courtesy-radio-5" class="icon-material-outline-star"></label>
                            <input type="radio" name="courtesy" id="courtesy-radio-4" value="4" required>
                            <label for="courtesy-radio-4" class="icon-material-outline-star"></label>
                            <input type="radio" name="courtesy" id="courtesy-radio-3" value="3" required>
                            <label for="courtesy-radio-3" class="icon-material-outline-star"></label>
                            <input type="radio" name="courtesy" id="courtesy-radio-2" value="2" required>
                            <label for="courtesy-radio-2" class="icon-material-outline-star"></label>
                            <input type="radio" name="courtesy" id="courtesy-radio-1" value="1" required>
                            <label for="courtesy-radio-1" class="icon-material-outline-star"></label>
                        </div><div class="clearfix"></div>
                    </div>

                    <div class="feedback-yes-no">
                        <strong>Пунктуальность</strong>
                        <div class="leave-rating">
                            <input type="radio" name="punctuality" id="punctuality-radio-5" value="5" required>
                            <label for="punctuality-radio-5" class="icon-material-outline-star"></label>
                            <input type="radio" name="punctuality" id="punctuality-radio-4" value="4" required>
                            <label for="punctuality-radio-4" class="icon-material-outline-star"></label>
                            <input type="radio" name="punctuality" id="punctuality-radio-3" value="3" required>
                            <label for="punctuality-radio-3" class="icon-material-outline-star"></label>
                            <input type="radio" name="punctuality" id="punctuality-radio-2" value="2" required>
                            <label for="punctuality-radio-2" class="icon-material-outline-star"></label>
                            <input type="radio" name="punctuality" id="punctuality-radio-1" value="1" required>
                            <label for="punctuality-radio-1" class="icon-material-outline-star"></label>
                        </div><div class="clearfix"></div>
                    </div>

                    <div class="feedback-yes-no">
                        <strong>Адекватность</strong>
                        <div class="leave-rating">
                            <input type="radio" name="adequacy" id="adequacy-radio-5" value="5" required>
                            <label for="adequacy-radio-5" class="icon-material-outline-star"></label>
                            <input type="radio" name="adequacy" id="adequacy-radio-4" value="4" required>
                            <label for="adequacy-radio-4" class="icon-material-outline-star"></label>
                            <input type="radio" name="adequacy" id="adequacy-radio-3" value="3" required>
                            <label for="adequacy-radio-3" class="icon-material-outline-star"></label>
                            <input type="radio" name="adequacy" id="adequacy-radio-2" value="2" required>
                            <label for="adequacy-radio-2" class="icon-material-outline-star"></label>
                            <input type="radio" name="adequacy" id="adequacy-radio-1" value="1" required>
                            <label for="adequacy-radio-1" class="icon-material-outline-star"></label>
                        </div><div class="clearfix"></div>
                    </div>

                    <textarea class="with-border" placeholder="Комментарий" name="comment" id="comment" cols="7" required></textarea>

                </form>
                
                <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect" type="submit" form="change-review-form">Сохранить изменения <i class="icon-material-outline-arrow-right-alt"></i></button>

            </div>

        </div>
    </div>
</div>
<!-- Edit Review Popup / End -->

<!-- Leave a Review for Freelancer Popup
================================================== -->
<div id="small-dialog-2" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

    <!--Tabs -->
    <div class="sign-in-form">

        <ul class="popup-tabs-nav">
        </ul>

        <div class="popup-tabs-container">

            <!-- Tab -->
            <div class="popup-tab-content" id="tab2">
                
                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Оставьте отзыв</h3>
                    <span>Оцените {{ auth()->user()->type == 1 ? 'исполнителя':'заказчика' }} <a href="#" id="reviewName">Имя</a> по заданию <a href="#" id="reviewTask">Название задания</a> </span>
                </div>
                    
                <!-- Form -->
                <form method="post" action="{{ route('reviews.store') }}" id="leave-review-form">
                    @csrf
                    <input type="hidden" id="task_id" name="task_id" value="">
                    <div class="feedback-yes-no">
                        <strong>Вежливость</strong>
                        <div class="leave-rating">
                            <input type="radio" name="courtesy" id="courtesy-radio-5" value="5" required>
                            <label for="courtesy-radio-5" class="icon-material-outline-star"></label>
                            <input type="radio" name="courtesy" id="courtesy-radio-4" value="4" required>
                            <label for="courtesy-radio-4" class="icon-material-outline-star"></label>
                            <input type="radio" name="courtesy" id="courtesy-radio-3" value="3" required>
                            <label for="courtesy-radio-3" class="icon-material-outline-star"></label>
                            <input type="radio" name="courtesy" id="courtesy-radio-2" value="2" required>
                            <label for="courtesy-radio-2" class="icon-material-outline-star"></label>
                            <input type="radio" name="courtesy" id="courtesy-radio-1" value="1" required>
                            <label for="courtesy-radio-1" class="icon-material-outline-star"></label>
                        </div><div class="clearfix"></div>
                    </div>

                    <div class="feedback-yes-no">
                        <strong>Пунктуальность</strong>
                        <div class="leave-rating">
                            <input type="radio" name="punctuality" id="punctuality-radio-5" value="5" required>
                            <label for="punctuality-radio-5" class="icon-material-outline-star"></label>
                            <input type="radio" name="punctuality" id="punctuality-radio-4" value="4" required>
                            <label for="punctuality-radio-4" class="icon-material-outline-star"></label>
                            <input type="radio" name="punctuality" id="punctuality-radio-3" value="3" required>
                            <label for="punctuality-radio-3" class="icon-material-outline-star"></label>
                            <input type="radio" name="punctuality" id="punctuality-radio-2" value="2" required>
                            <label for="punctuality-radio-2" class="icon-material-outline-star"></label>
                            <input type="radio" name="punctuality" id="punctuality-radio-1" value="1" required>
                            <label for="punctuality-radio-1" class="icon-material-outline-star"></label>
                        </div><div class="clearfix"></div>
                    </div>

                    <div class="feedback-yes-no">
                        <strong>Адекватность</strong>
                        <div class="leave-rating">
                            <input type="radio" name="adequacy" id="adequacy-radio-5" value="5" required>
                            <label for="adequacy-radio-5" class="icon-material-outline-star"></label>
                            <input type="radio" name="adequacy" id="adequacy-radio-4" value="4" required>
                            <label for="adequacy-radio-4" class="icon-material-outline-star"></label>
                            <input type="radio" name="adequacy" id="adequacy-radio-3" value="3" required>
                            <label for="adequacy-radio-3" class="icon-material-outline-star"></label>
                            <input type="radio" name="adequacy" id="adequacy-radio-2" value="2" required>
                            <label for="adequacy-radio-2" class="icon-material-outline-star"></label>
                            <input type="radio" name="adequacy" id="adequacy-radio-1" value="1" required>
                            <label for="adequacy-radio-1" class="icon-material-outline-star"></label>
                        </div><div class="clearfix"></div>
                    </div>

                    <textarea class="with-border" placeholder="Комментарий" name="comment" id="comment" cols="7" required></textarea>

                </form>
                
                <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect" type="submit" form="leave-review-form">Оставить отзыв <i class="icon-material-outline-arrow-right-alt"></i></button>

            </div>

        </div>
    </div>
</div>
<!-- Leave a Review Popup / End -->

<reviews-modal></reviews-modal>
@endsection