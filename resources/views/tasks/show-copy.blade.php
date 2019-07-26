@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card">
                <div class="card-header">
                    <span class="float-left">{{ $task->title }}</span>
                    @if($task->user->id == Auth::user()->id)
                    <div class="float-right">
                        <a class="btn btn-link py-0" href="{{ route('tasks.edit', $task->id) }}">Изменить</a>
                        <form action="{{ route('tasks.delete', $task->id) }}" method="POST" class="float-right">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-link py-0">Удалить</button>
                        </form>
                    </div>
                    @endif
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
    @if($task->user->id != Auth::user()->id)
        <div class="row">
        @if($userProposal === NULL)
        <div class="col-10 offset-1">
            <div class="card text-center my-4">
                <div class="card-header">
                    <h4 class="my-0">Добавить предложение</h4>
                </div>
                <form action="{{ route('proposals.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="task_id" value="{{$task->id}}">
                    <div class="card-body">
                        <textarea class="form-control" name="description" rows="4" placeholder="Введите описание предложения..." required></textarea>
                        <input class="form-control mt-3" type="number" name="price" placeholder="Введите цену предложения..." required>
                    </div>
                    <div class="card-footer">
                        @if($task->proposal_id !== NULL)
                        <button class="btn btn-danger" disabled="disabled">Исполнитель выбран</button>
                        @else
                        <button class="btn btn-success" type="submit">Отправить предложение</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        @else
        <div class="col-12 my-3">
            <div class="card col-10 offset-1">
                <div class="card-body">
                    <h5 class="card-title">{{$userProposal->user->name}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{$userProposal->price}}</h6>
                    <p class="card-text">{{ $userProposal->description }}</p>
                    @if($task->proposal_id == $userProposal->id)
                    <a class="text-muted">Вы выбраны исполнителем</a>
                    <div class="row mt-4">
                        <div class="btn-group col-10 offset-1">
                            <a href="" class="btn btn-success col-6">Задание выполнено</a>
                            <a href="" class="btn btn-danger col-6">Задание не выполнено</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
        </div>
    @else
    <div class="row">
        <div class="col-10 offset-1 my-3">
            Всего предложений - {{ $task->proposals->count() }}
        </div>
        <div class="col-12">
            @foreach($task->proposals as $proposal)
            <div class="card col-4">
                <div class="card-body">
                    <h5 class="card-title">{{$proposal->user->name}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{$proposal->price}}</h6>
                    <p class="card-text">{{ $proposal->description }}</p>
                    @if($task->proposal_id == $proposal->id)
                    <a class="text-muted">Это предложение выбрано</a>
                    @else
                    <a href="{{ route('tasks.select_proposal.view', array($task->id, $proposal->id)) }}" class="card-link">Выбрать исполнителя</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
