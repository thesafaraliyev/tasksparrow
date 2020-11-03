@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <h5 class="mr-auto">Delete task <small>#{{ $task->id }}</small></h5>
    <hr>

    <div>
        <p>Are you sure to delete this task?</p>
        <form method="post" action="{{ route('taskDestroy', ['task' => $task]) }}">
            @csrf
            <button type="button" onclick="window.history.back()" class="btn btn btn-outline-dark" title="Return">
                No, return
            </button>
            <button type="submit" class="btn btn btn-outline-danger" title="Delete">Yes, delete</button>
        </form>
    </div>
@endsection
