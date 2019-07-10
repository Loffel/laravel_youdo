@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card">
                <div class="card-header">
                    {{ $task->title }}
                    <div class="float-right">
                        <a href="{{ route('tasks.edit', $task->id) }}">Изменить</a>
                        <a href="{{ route('tasks.delete', $task->id) }}">Удалить</a>
                    </div>
                </div>
                <div class="card-body">
                    {{ $task->description }}
                    <br><br>
                    Бюджет: {{ $task->price }}
                </div>
                <div class="card-footer">
                    Время завершения: {{ $task->date_end }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
