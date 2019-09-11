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
                <h3>Управление заданиями</h3>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Главная</a></li>
                        <li><a href="#">Панель управления</a></li>
                        <li>Управление заданиями</li>
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
                            <h3><i class="icon-material-outline-assignment"></i> Мои задания</h3>
                        </div>

                        <div class="content">
                            <ul class="dashboard-box-list">
                                @foreach($tasks as $task)
                                <li>
                                    <!-- Job Listing -->
                                    <div class="job-listing width-adjustment">

                                        <!-- Job Listing Details -->
                                        <div class="job-listing-details">

                                            <!-- Details -->
                                            <div class="job-listing-description">
                                                @php
                                                    $daysDiff = Carbon\Carbon::now()->diffInDays($task->created_at, false);
                                                @endphp
                                                <h3 class="job-listing-title"><a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a>
                                                    @if($daysDiff >= 0 && $daysDiff <= 1)
                                                    <span class="dashboard-status-button yellow">Заканчивается</span>
                                                    @endif
                                                </h3>

                                                <!-- Job Listing Footer -->
                                                <div class="job-listing-footer">
                                                    <ul>
                                                        <li><i class="icon-material-outline-access-time"></i> {{$task->created_at->diffForHumans()}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Task Details -->
                                    
                                    <ul class="dashboard-task-info">
                                        @if(auth()->user()->type == 1)
                                        <li><strong>{{ $task->proposals->count() }}</strong><span>Предложений</span></li>
                                        <li><strong>@money($task->proposals()->avg('price')) руб.</strong><span>Средняя цена</span></li>
                                        <li><strong>@money($task->price) руб.</strong><span>Бюджет</span></li>
                                        @else
                                        <li><strong>@money($task->getSelectedProposal()->price) руб.</strong><span>Ваша цена</span></li>
                                        @endif
                                    </ul>
                                    
                                    @if(auth()->user()->type == 1)
                                    <!-- Buttons -->
                                    <div class="buttons-to-right always-visible">
                                        <a href="{{ route('tasks.proposals', $task->id) }}" class="button ripple-effect"><i class="icon-material-outline-supervisor-account"></i> Предложения <span class="button-info">{{ $task->proposals->count() }}</span></a>
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="button gray ripple-effect ico" title="Редактировать" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
                                        <form action="{{ route('tasks.delete', $task->id) }}" method="post" style="display: inline">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="button gray ripple-effect ico" style="vertical-align:top;" title="Удалить" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></button>
                                        </form>
                                    </div>
                                    @endif
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
@endsection