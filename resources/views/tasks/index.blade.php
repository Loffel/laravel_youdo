@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('tasks.create') }}" class="btn btn-outline-primary float-right">Создать задание</a>
        </div>
        @foreach($tasks as $task)
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('tasks.show', $task->id) }}">{{$task->title}}</a>
                </div>
                <div class="card-body">
                    {{ $task->description }}
                    <p class="card-text">Бюджет: {{ $task->price }} руб.</p>
                </div>
                <div class="card-footer text-muted">
                    Время завершения: {{ $task->date_end }}
                    <div class="float-right">
                        Создано: {{ $task->created_at }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        {{ $tasks->links() }}
    </div>
</div>
@endsection
