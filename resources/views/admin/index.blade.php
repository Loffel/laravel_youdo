@extends('layouts.app')

@section('content')
<div class="dashboard-container">
        <!-- Dashboard Content
        ================================================== -->
        <div class="dashboard-content-container" data-simplebar>
            <div class="dashboard-content-inner" >
                
                <!-- Dashboard Headline -->
                <div class="dashboard-headline">
                    <h3>Добро пожаловать в панель администратора!</h3>
                    <span>Администратор {{ Auth::user()->name }}</span>
    
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs" class="dark">
                        <ul>
                            <li><a href="#">Главная</a></li>
                            <li>Админ-панель</li>
                        </ul>
                    </nav>
                </div>
        
                <!-- Fun Facts Container -->
                <div class="fun-facts-container">
                    <div class="fun-fact" data-fun-fact-color="#36bd78">
                        <div class="fun-fact-text">
                            <span>Задания</span>
                            <h4>{{ $tasks }}</h4>
                        </div>
                        <div class="fun-fact-icon"><i class="icon-material-outline-business-center"></i></div>
                    </div>
                    <div class="fun-fact" data-fun-fact-color="#b81b7f">
                        <div class="fun-fact-text">
                            <span>Завершенные задания</span>
                            <h4>{{ $completedTasks }}</h4>
                        </div>
                        <div class="fun-fact-icon"><i class="icon-material-outline-gavel"></i></div>
                    </div>
                    <div class="fun-fact" data-fun-fact-color="#efa80f">
                        <div class="fun-fact-text">
                            <span>Тикеты</span>
                            <h4>0</h4>
                        </div>
                        <div class="fun-fact-icon"><i class="icon-material-outline-rate-review"></i></div>
                    </div>
    
                    <!-- Last one has to be hidden below 1600px, sorry :( -->
                    <div class="fun-fact" data-fun-fact-color="#2a41e6">
                        <div class="fun-fact-text">
                            <span>Пользователи</span>
                            <h4>{{ $users }}</h4>
                        </div>
                        <div class="fun-fact-icon"><i class="icon-feather-trending-up"></i></div>
                    </div>
                </div>
                
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="dashboard-box">
                            <div class="headline">
                                <h3><i class="icon-material-outline-assignment"></i> Неактивированные аккаунты</h3>
                            </div>
                            <div class="content">
                                <table class="basic-table">
                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Имя</th>
                                            <th>Email</th>
                                            <th>Тип</th>
                                            <th>ОГРН</th>
                                            <th>Телефон</th>
                                            <th>Юр. адрес</th>
                                            <th>Физ. адрес</th>
                                            <th>Действие</th>
                                        </tr>
                                        @foreach($unactive as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->getTypeName() }}</td>
                                            <td>{{ $user->ogrn }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->legal_address }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td><a href="{{route('admin.activateUser', $user->id)}}">Активировать</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{ $unactive->appends(array('unactive' => $unactive->currentPage(), 'props' => $proposals->currentPage()))->links('paginator') }}
                </div>
                <!-- Row / End -->
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="dashboard-box">
                            <div class="headline">
                                <h3><i class="icon-material-outline-assignment"></i> Предложения</h3>
                            </div>
                            <div class="content">
                                <table class="basic-table">
                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Задание</th>
                                            <th>Автор предложения</th>
                                            <th>Описание предложения</th>
                                            <th>Цена</th>
                                            <th>Статус</th>
                                            <th>Действие</th>
                                        </tr>
                                        @foreach($proposals as $proposal)
                                        <tr>
                                            <td>{{$proposal->id}}</td>
                                            <td><a href="{{ route('tasks.show', $proposal->task->id) }}">{{ $proposal->task->title }}</a></td>
                                            <td><a href="{{ route('profile.show', $proposal->user->id) }}">{{ $proposal->user->name }}</a></td>
                                            <td>{{ $proposal->description }}</td>
                                            <td>{{ $proposal->price }}</td>
                                            <td>{{ $proposal->getStatusText() }}</td>
                                            <td>
                                                @if($proposal->status == 3)
                                                <a href="{{ route('admin.payoutProposal', $proposal->id) }}">Произвести выплату</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{ $proposals->appends(array('unactive' => $unactive->currentPage(), 'props' => $proposals->currentPage()))->links('paginator') }}
                </div>
                <!-- Row / End -->
    
                @include('includes.dashboard_footer')
    
            </div>
        </div>
        <!-- Dashboard Content / End -->
    
    </div>
@endsection
