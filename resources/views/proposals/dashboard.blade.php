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
                    <h3>Мои активные предложения</h3>
    
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs" class="dark">
                        <ul>
                            <li><a href="#">Главная</a></li>
                            <li><a href="#">Панель управления</a></li>
                            <li>Мои активные предложения</li>
                        </ul>
                    </nav>
                </div>
        
                <!-- Row -->
                <div class="row">
    
                    <!-- Dashboard Box -->
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
                                <h3><i class="icon-material-outline-gavel"></i> Список предложений</h3>
                            </div>
    
                            <div class="content">
                                <ul class="dashboard-box-list">
                                    @foreach($proposals as $proposal)
                                    <li>
                                        <!-- Job Listing -->
                                        <div class="job-listing width-adjustment">
    
                                            <!-- Job Listing Details -->
                                            <div class="job-listing-details">
    
                                                <!-- Details -->
                                                <div class="job-listing-description">
                                                    <h3 class="job-listing-title"><a href="{{ route('tasks.show', $proposal->task->id) }}">{{ $proposal->task->title }}</a></h3>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Task Details -->
                                        <ul class="dashboard-task-info">
                                            <li><strong>@money($proposal->price) руб.</strong><span>Бюджет</span></li>
                                            <li><strong>{{ $proposal->task->date_end->format('d.m.y') }}</strong><span>Завершить до</span></li>
                                        </ul>
    
                                        <!-- Buttons -->
                                        <div class="buttons-to-right always-visible">
                                            <a data-current-price="{{ $proposal->price }}" data-id="{{ $proposal->id }}" data-desc="{{ $proposal->description }}" data-price="{{ $proposal->task->price }}" id="proposalEdit" href="#small-dialog" class="popup-with-zoom-anim button dark ripple-effect ico" title="Редактировать" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
                                            <a href="{{ route('proposals.delete', $proposal->id) }}" class="button red ripple-effect ico" title="Отменить" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
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


<!-- Edit Bid Popup
================================================== -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

    <!--Tabs -->
    <div class="sign-in-form">

        <ul class="popup-tabs-nav">
            <li><a href="#tab">Изменить предложение</a></li>
        </ul>

        <div class="popup-tabs-container">

            <!-- Tab -->
            <div class="popup-tab-content" id="tab">
                <form action="{{ route('proposals.update') }}" method="POST">
                    @csrf
                    {{ method_field('PATCH') }}
                    <input type="hidden" id="proposal_id" name="proposal_id" value="">
                    <!-- Bidding -->
                    <div class="bidding-widget">
                        <!-- Headline -->
                        <span class="bidding-detail">Установите <strong>цену предложения</strong></span>

                        <!-- Price Slider -->
                        <div class="bidding-value">₽<span id="biddingVal"></span></div>
                        <input name="price" class="bidding-slider" type="text" value="" data-slider-handle="custom" data-slider-currency="₽" data-slider-min="0" data-slider-max="1000000" data-slider-value="0" data-slider-step="1000" data-slider-tooltip="hide" />
                        
                        <!-- Headline -->
                        <span class="bidding-detail margin-top-30">Оставьте <strong>комментарий</strong> к предложению</span>

                        <!-- Fields -->
                        <div class="bidding-fields">
                            <div class="bidding-field">
                                <textarea class="with-border" placeholder="Комментарий к предложению" name="description" id="description" cols="7" required></textarea>
                            </div>
                        </div>
                    </div>
                
                    <!-- Button -->
                    <button class="button full-width button-sliding-icon ripple-effect" type="submit">Сохранить изменения <i class="icon-material-outline-arrow-right-alt"></i></button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Edit Bid Popup / End -->

<proposals-modal></proposals-modal>
@endsection