@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="{{route('tasks.select_proposal.store')}}" method="POST">
                @csrf
                <input type="hidden" name="task_id" value="{{$task_id}}">
                <input type="hidden" name="prop_id" value="{{$prop_id}}">
                <button class="btn btn-success">Внести предоплату</button>
            </form>
        </div>
    </div>
</div>
@endsection
