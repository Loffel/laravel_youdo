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
                <h3>Управление предложениями</h3>
                <span class="margin-top-7">Предложения для <a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a></span>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Главная</a></li>
                        <li><a href="#">Панель управления</a></li>
                        <li>Управление предложениями</li>
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
                            <h3><i class="icon-material-outline-supervisor-account"></i> {{ $task->proposals->count() }} предложений</h3>
                            {{-- <div class="sort-by">
                                <select class="selectpicker hide-tick">
                                    <option>Highest First</option>
                                    <option>Lowest First</option>
                                    <option>Fastest First</option>
                                </select>
                            </div> --}}
                        </div>

                        <div class="content">
                            <ul class="dashboard-box-list">
                                @foreach($task->proposals as $proposal)
                                <li>
                                    <!-- Overview -->
                                    <div class="freelancer-overview manage-candidates">
                                        <div class="freelancer-overview-inner">

                                            <!-- Avatar -->
                                            <div class="freelancer-avatar">
                                                <div class="verified-badge"></div>
                                                <a href="{{ route('profile.show', $proposal->user->id) }}"><img src="{{ $proposal->user->getAvatar() }}" alt=""></a>
                                            </div>

                                            <!-- Name -->
                                            <div class="freelancer-name">
                                                <h4><a href="{{ route('profile.show', $proposal->user->id) }}">{{ $proposal->user->name }}</a></h4>

                                                <!-- Details -->
                                                <span class="freelancer-detail-item"><a href="mailto:{{ $proposal->user->email }}"><i class="icon-feather-mail"></i> {{ $proposal->user->email }}</a></span>
                                                <span class="freelancer-detail-item"><i class="icon-feather-phone"></i> {{ $proposal->user->phone }}</span>

                                                <!-- Rating -->
                                                <div class="freelancer-rating">
                                                    @if($proposal->user->getScoreAVG() != 0)
                                                    <div class="star-rating" data-rating="{{ $proposal->user->getScoreAVG() }}"></div>
                                                    @else
                                                    Нет рейтинга
                                                    @endif
                                                </div>

                                                <!-- Bid Details -->
                                                <ul class="dashboard-task-info bid-info">
                                                    <li><strong>{{ $proposal->description }}</strong><span>Комментарий</span></li>
                                                    <li><strong>@money($proposal->price) руб.</strong><span>Цена</span></li>
                                                </ul>

                                                <!-- Buttons -->
                                                <div class="buttons-to-right always-visible margin-top-25 margin-bottom-0">
                                                    @if($task->getSelectedProposal() == NULL)
                                                    <a href="#small-dialog-1" data-url="{{ route('tasks.select_proposal.view', array($proposal->task->id, $proposal->id)) }}" data-id="{{ $proposal->id }}" data-price="{{ $proposal->price }}" data-user-name="{{ $proposal->user->name }}" id="openAccept" class="popup-with-zoom-anim button ripple-effect"><i class="icon-material-outline-check"></i> Принять предложение</a>
                                                    <a href="#small-dialog-2" data-user-name="{{ $proposal->user->name }}" data-user-id="{{ $proposal->user->id }}" id="openDM" class="popup-with-zoom-anim button dark ripple-effect"><i class="icon-feather-mail"></i> Написать сообщение</a>
                                                    @else
                                                        @if($task->getSelectedProposal()->id == $proposal->id)
                                                        <a href="#" class="popup-with-zoom-anim button ripple-effect green" style="pointer-events:none;"><i class="icon-material-outline-check"></i> Выбран исполнителем</a>
                                                        @endif
                                                    @endif
                                                    {{-- <a href="#" class="button gray ripple-effect ico" title="Remove Bid" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a> --}}
                                                </div>
                                            </div>
                                        </div>
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

<!-- Bid Acceptance Popup
================================================== -->
<div id="small-dialog-1" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

    <!--Tabs -->
    <div class="sign-in-form">

        <ul class="popup-tabs-nav">
            <li><a href="#tab1">Принять предложение</a></li>
        </ul>

        <div class="popup-tabs-container">

            <!-- Tab -->
            <div class="popup-tab-content" id="tab">
                
                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3 id="username">Принять предложение от</h3>
                    <div id="price" class="bid-acceptance margin-top-15">
                        
                    </div>

                </div>

                <form method="GET" action="" id="terms">
                    <div class="radio">
                        <input id="radio-1" type="radio" required>
                        <label for="radio-1"><span class="radio-label"></span> Я ознакомлен и согласен с правилами сайта</label>
                    </div>
                </form>

                <!-- Button -->
                <button class="margin-top-15 button full-width button-sliding-icon ripple-effect" type="submit" form="terms">Выбрать исполнителем <i class="icon-material-outline-arrow-right-alt"></i></button>

            </div>

        </div>
    </div>
</div>
<!-- Bid Acceptance Popup / End -->


<!-- Send Direct Message Popup
================================================== -->
<div id="small-dialog-2" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

    <!--Tabs -->
    <div class="sign-in-form">

        <ul class="popup-tabs-nav">
            <li><a href="#tab2">Отправить сообщение</a></li>
        </ul>

        <div class="popup-tabs-container">

            <!-- Tab -->
            <div class="popup-tab-content" id="tab2">
                
                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3 id="username">Сообщение для</h3>
                </div>
                    
                <!-- Form -->
                <form action="{{ route('messenger.sendMessage') }}" method="post" id="send-pm">
                    @csrf
                    <input type="hidden" name="contact_id" id="contact_id">
                    <textarea name="text" cols="10" placeholder="Сообщение..." class="with-border" required></textarea>
                </form>
                
                <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect" type="submit" form="send-pm">Отправить <i class="icon-material-outline-arrow-right-alt"></i></button>

            </div>

        </div>
    </div>
</div>
<!-- Send Direct Message Popup / End -->

<tasks-proposals-modal></tasks-proposals-modal>
@endsection