@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(Auth::user()->is_admin)
        <div class="col-12 mb-3">
            <a href="{{ route('posts.create') }}" class="btn btn-outline-primary float-right">Создать пост</a>
        </div>
        @endif
        @foreach($posts as $post)
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('posts.show', $post->id) }}">{{$post->title}}</a>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ Str::limit($post->content) }}</p>
                </div>
                <div class="card-footer text-muted">
                    <div class="float-right">
                        Создано: {{ $post->created_at }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        {{ $posts->links() }}
    </div>
</div>
@endsection
