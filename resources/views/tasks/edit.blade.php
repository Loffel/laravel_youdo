@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    @include('includes/dashboard_sidebar')
    
    <div class="dashboard-content-container" data-simplebar>
        <div class="dashboard-content-inner" >
            
            <!-- Dashboard Headline -->
            <div class="dashboard-headline">
                <h3>Изменить задание</h3>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Главная</a></li>
                        <li><a href="#">Панель управления</a></li>
                        <li>Добавить задание</li>
                    </ul>
                </nav>
            </div>
    
            <!-- Row -->
            <div class="row">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    {{ method_field('PATCH') }}
                    <!-- Dashboard Box -->
                    <div class="col-xl-12">
                        <div class="dashboard-box margin-top-0">

                            <!-- Headline -->
                            <div class="headline">
                                <h3><i class="icon-feather-folder-plus"></i> Форма изменения задания</h3>
                            </div>

                            <div class="content with-padding padding-bottom-10">
                                <div class="row">

                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Название задания</h5>
                                            <input type="text" class="with-border" name="title" value="{{$task->title}}" placeholder="e.g. build me a website" required>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="submit-field">
                                            <h5>Бюджет</h5>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="input-with-icon">
                                                        <input class="with-border" type="number" name="price" value="{{ $task->price }}" placeholder="" required>
                                                        <i class="currency">RUB</i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="submit-field">
                                            <h5>Завершить до</h5>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="input-with-icon">
                                                        <input class="with-border" type="datetime-local" name="date_end" value="{{ $dateEndString }}" placeholder="" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Описание</h5>
                                            <textarea cols="30" rows="5" name="description" class="with-border">{{ $task->description }}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <button type="submit" class="button ripple-effect big margin-top-30"><i class="icon-material-outline-check"></i> Сохранить</button>
                    </div>
                </form>
            </div>
            <!-- Row / End -->

            @include('includes/dashboard_footer')

        </div>
    </div>
    <!-- Dashboard Content / End -->

</div>
@endsection
