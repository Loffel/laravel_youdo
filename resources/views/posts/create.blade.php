@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Новый пост
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">Заголовок</label>
                            <div class="col-md-10">
                                <input id="title" type="text" class="form-control" name="title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-md-2 col-form-label text-md-right">Контент</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="content" id="content" rows="6"></textarea>
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
