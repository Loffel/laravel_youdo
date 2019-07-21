@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    {{$post->title}}
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">Заголовок</label>
                            <div class="col-md-10">
                                <input id="title" type="text" class="form-control" name="title" value="{{$post->title}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-md-2 col-form-label text-md-right">Контент</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="content" id="content" rows="4">{{$post->content}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0 justify-content-center">
                                <button type="submit" class="btn btn-primary mr-2">
                                    Сохранить
                                </button>
                                <a href="{{route('posts.show', $post->id)}}" class="btn btn-danger">
                                        Отмена
                                </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
