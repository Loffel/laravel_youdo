@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Админ-панель</div>

                <div class="card-body">
                    Админ-панель
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-4">
            <h4>Неактивированные</h4>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Email</th>
                        <th scope="col">Тип</th>
                        <th scope="col">ОГРН</th>
                        <th scope="col">Телефон</th>
                        <th scope="col">Юр. адрес</th>
                        <th scope="col">Физ. адрес</th>
                        <th scope="col">Действие</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($unactive as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getTypeName() }}</td>
                        <td>{{ $user->ogrn }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->legal_address }}</td>
                        <td>{{ $user->address }}</td>
                        <td><a href="{{route('admin.activate_user', $user->id)}}">Активировать</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
