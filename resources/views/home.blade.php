@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    @include('includes/dashboard_sidebar')

    <div class="dashboard-content-container" data-simplebar>
        <div class="dashboard-content-inner" >
            
            <!-- Dashboard Headline -->
            <div class="dashboard-headline">
                <h3>Привет, {{ Auth::user()->name }}!</h3>
                <span>Рады снова тебя видеть!</span>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Главная</a></li>
                        <li>Панель управления</li>
                    </ul>
                </nav>
            </div>
    
            <!-- Fun Facts Container -->
            <div class="fun-facts-container">
                <div class="fun-fact" data-fun-fact-color="#b81b7f">
                    <div class="fun-fact-text">
                        <span>{{ auth()->user()->type == 1 ? 'Заданий создано':'Заданий выполнено' }}</span>
                        <h4>{{ $tasksCount }}</h4>
                    </div>
                    <div class="fun-fact-icon"><i class="icon-material-outline-business-center"></i></div>
                    @if(auth()->user()->type == 1)
                    <a href="{{ route('tasks.create') }}"><div class="fun-fact-link"><i class="icon-material-outline-add"></i></div></a>
                    @endif
                </div>
                <div class="fun-fact" data-fun-fact-color="#efa80f">
                    <div class="fun-fact-text">
                        <span>Отзывов</span>
                        <h4>{{ $reviewsCount }}</h4>
                    </div>
                    <div class="fun-fact-icon"><i class="icon-material-outline-rate-review"></i></div>
                </div>
            </div>

            <!-- Row -->
            <div class="row">
                <!-- Dashboard Box -->
                <div class="col-xl-6">
                    <div class="dashboard-box">
                        <div class="headline">
                            <h3><i class="icon-material-baseline-notifications-none"></i> Уведомления</h3>
                            <button id="notify-all" class="mark-as-read ripple-effect-dark" data-tippy-placement="left" title="Отметить все как прочитанные">
                                    <i class="icon-feather-check-square"></i>
                            </button>
                        </div>
                        <div class="content">
                            <ul id="list-notifications" class="dashboard-box-list">
                                @foreach(auth()->user()->unreadNotifications as $notification)
                                <li>
                                    <span class="notification-icon">
                                        @if($notification->type == "App\Notifications\UserSelected")
                                        <i class="icon-material-outline-group"></i>
                                        @elseif($notification->type == "App\Notifications\NewProposal" || $notification->type == "App\Notifications\ProposalStatusChanged")
                                        <i class="icon-material-outline-gavel"></i>
                                        @endif
                                    </span>
                                    <span class="notification-text">
                                        @if($notification->type == "App\Notifications\UserSelected")
                                        <strong>Вы</strong> были выбраны исполнителем задания <a href="{{ route('tasks.show', $notification->data['task_id']) }}">{{ $notification->data["task_title"] }}</a>
                                        @elseif($notification->type == "App\Notifications\NewProposal")
                                        <a href="{{ route('profile.show', $notification->data['user_id']) }}">{{ $notification->data["user_name"] }}</a> оставил предложение к вашему заданию <a href="{{ route('tasks.show', $notification->data['task_id']) }}">{{ $notification->data["task_title"] }}</a>
                                        @elseif($notification->type == "App\Notifications\ProposalStatusChanged")
                                        {{ $notification->data["message"] }}
                                        @endif
                                    </span>
                                    <!-- Buttons -->
                                    <div class="buttons-to-right">
                                        <a href="#" id="notify-read" data-id="{{$notification->id}}" class="button ripple-effect ico" title="Отметить как прочитанное" data-tippy-placement="left"><i class="icon-feather-check-square"></i></a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Box -->
                <div class="col-xl-6">
                    <div class="dashboard-box">
                        <div class="headline">
                            <h3><i class="icon-material-outline-assignment"></i> {{ auth()->user()->type == 1 ? 'Платежи':'Выплаты' }}</h3>
                        </div>
                        <div class="content">
                            <ul class="dashboard-box-list">
                                @foreach($tasks as $task)
                                <li>
                                    <div class="invoice-list-item">
                                    <strong>{{$task->title}}</strong>
                                        <ul>
                                            @if($task->pay)
                                            <li><span class="paid">Оплачено</span></li>
                                            <li>Номер: {{ $task->pay->id }}</li>
                                            <li>Дата: {{ $task->pay->created_at->format('d-m-Y') }}</li>
                                            @else
                                            <li><span class="unpaid">Неоплачено</span></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <!-- Buttons -->
                                    {{--  <div class="buttons-to-right">
                                        <a href="#" class="button">Запросить выплату</a>
                                        <a href="#" class="button gray">Посмотреть чек</a>
                                    </div>  --}}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Row / End -->

            @include('includes/dashboard_footer')
        </div>
    </div>
    <!-- Dashboard Content / End -->

</div>
@endsection