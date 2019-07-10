@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Новое задание
                </div>
                <div class="card-body">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">Название</label>
                            <div class="col-md-10">
                                <input id="title" type="text" class="form-control" name="title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">Описание</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-md-2 col-form-label text-md-right">Бюджет</label>
                            <div class="col-md-10">
                                <div class="input-group mb-3">
                                    <input type="number" name="price" class="form-control" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                      <span class="input-group-text" id="basic-addon2">руб.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_end" class="col-md-2 col-form-label text-md-right">Завершить</label>
                            <div class="col-md-10">
                                <input id="date_end" type="datetime-local" class="form-control" name="date_end" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0 justify-content-center">
                                <button type="submit" class="btn btn-primary">
                                    Опубликовать
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
