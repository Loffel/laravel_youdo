@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card">
                <div class="card-header">
                    <span class="float-left">{{ $post->title }}</span>
                    @if($post->user->id == Auth::user()->id)
                    <div class="float-right">
                        <a class="btn btn-link py-0" href="{{ route('posts.edit', $post->id) }}">Изменить</a>
                        <form action="{{ route('posts.delete', $post->id) }}" method="POST" class="float-right">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-link py-0">Удалить</button>
                        </form>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    {{ $post->content }}
                </div>
                <div class="card-footer">
                    Дата публикации: {{ $post->created_at }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
