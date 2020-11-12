@extends('layouts.master')

@section('title', 'Attach user')

@section('content')
    <h5 class="mr-auto">Attach user to task <small>#{{ $task->id }}</small></h5>
    <hr>

    <div>
        @include('partials.alert-messages')

        <div class="row">

            <!-- form -->
            <div class="col-md-6">
                <form method="post" action="{{ route('userTaskStore', ['task' => $task]) }}">
                    @csrf
                    <div class="form-group row">
                        <label for="identifier" class="col-sm-3 col-form-label">Identifier</label>
                        <div class="col-sm-9">
                            <input
                                required
                                class="form-control @error('identifier') is-invalid @enderror"
                                type="text"
                                id="identifier"
                                name="identifier"
                                value="{{ old('identifier') }}"
                                aria-describedby="identifier-validation"
                                placeholder="Username or email">
                            @error('identifier')
                            <div id="identifier-validation" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">Access type</div>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="canComment"
                                       name="canComment">
                                <label class="form-check-label" for="canComment">
                                    Can add comment
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-outline-dark">Attach</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- form -->

            <!-- attached users -->
            <div class="col-md-6">

                <div class="card">
                    <ul class="list-group list-group-flush" id="users">
                        @foreach($attachedUsers as $attachedUser)
                            <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                            <span>{{ $attachedUser->user->name }}
                                @if($attachedUser->can_comment)
                                    <small class="justify"> &middot; Can add comment</small>
                                @endif
                            </span>
                                <button class="btn btn-outline-danger btn-sm js-detach-user"
                                        data-url="{{ route('userTaskDestroy', ['task' => $task, 'userTask' => $attachedUser->id]) }}">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path fill-rule="evenodd"
                                              d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </button>
                            </li>
                        @endforeach

                        @if(!count($attachedUsers))
                            <li class="list-group-item text-center p-2">No user attached.</li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- attached users -->

        </div>
    </div>

    <script>
        const USERS_CONTAINER = $('#users');


        $('.js-detach-user').click(function () {
            if (confirm('are you sure to detach user?')) {
                const $this = $(this);
                const url = $this.data('url');

                $.post($this.data('url'), response => {
                    console.log(response)
                })

                $this.parents('li').remove();

                if (!USERS_CONTAINER.find('li').length) {
                    USERS_CONTAINER.html(`<li class="list-group-item text-center p-2">No user attached.</li>`)
                }
            }
        });


    </script>
@endsection
