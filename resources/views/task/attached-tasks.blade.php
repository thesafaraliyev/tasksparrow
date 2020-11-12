@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <h5 class="mr-auto">Attached task list</h5>
    <hr>

    <div>
        @include('partials.alert-messages')

        <table class="table table-borderless table-hover text-center table-responsive-md">
            <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Deadline</th>
                <th scope="col">Author</th>
            </tr>
            </thead>
            <tbody>
            @foreach($attachedTasks as $attachedTask)
                <tr>
                    <td>{{ $attachedTask->task->title }}</td>
                    <td>{{ date('d M Y H:i', strtotime($attachedTask->task->deadline)) }}</td>
                    <td>{{ $attachedTask->task->author->name }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="task operations">
                            <a href="{{ route('taskShow', ['task' => $attachedTask->task]) }}" type="button"
                               class="btn btn-outline-dark" title="Show">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eyeglasses"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M4 6a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm2.625.547a3 3 0 0 0-5.584.953H.5a.5.5 0 0 0 0 1h.541A3 3 0 0 0 7 8a1 1 0 0 1 2 0 3 3 0 0 0 5.959.5h.541a.5.5 0 0 0 0-1h-.541a3 3 0 0 0-5.584-.953A1.993 1.993 0 0 0 8 6c-.532 0-1.016.208-1.375.547zM14 8a2 2 0 1 0-4 0 2 2 0 0 0 4 0z"/>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            @if(!count($attachedTasks))
                <tr>
                    <td colspan="3">There is no task to display.</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
