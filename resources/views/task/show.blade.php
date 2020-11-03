@extends('layouts.master')

@section('title', 'Task details')

@section('content')
    <h5 class="mr-auto">Task details <small>#{{ $task->id }}</small></h5>
    <hr>

    <div class="row">
        <div class="col-md-4 mb-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $task->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ date('d M Y H:i', strtotime($task->deadline)) }}</h6>
                    <p class="card-text">{{ $task->description }}</p>
                    <p class="card-text">
                        <small class="text-muted">Last updated {{ date('d M Y', strtotime($task->updated_at)) }}</small>
                    </p>
                    @if($task->author_id === Auth::id())
                        <a href="{{ route('taskEdit', ['task' => $task]) }}" class="card-link">Edit</a>
                        <a href="{{ route('userTask', ['task' => $task]) }}" class="card-link">Attach user</a>
                        <a href="{{ route('taskDelete', ['task' => $task]) }}" class="card-link">Delete</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- comments -->
        <div class="col-md-8">
            <!-- comment input -->
            <div class="mb-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Add your comment.." id="comment-input">
                    <div class="input-group-append">
                        <button class="btn btn-outline-dark" type="button" title="Send" disabled id="add-comment">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-return-left"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                        </button>
                        <button class="btn btn-outline-dark" type="button" title="Cancel editing" disabled
                                id="cancel-edit">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-backspace"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M6.603 2h7.08a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-7.08a1 1 0 0 1-.76-.35L1 8l4.844-5.65A1 1 0 0 1 6.603 2zm7.08-1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zM5.829 5.146a.5.5 0 0 0 0 .708L7.976 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <!-- comment input -->

            <!-- comments list -->
            <div class="card">
                <ul class="list-group list-group-flush" id="comments">
                    <li class="list-group-item d-flex justify-content-between align-items-center p-2 js-comment-row-1">
                        <span class="js-comment-placeholder">Cras justo odio</span>
                        <div class="btn-group btn-group-sm m-0" role="group">
                            <button type="button" class="btn btn-outline-dark js-edit-comment" data-id="1">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </button>
                            <button type="button" class="btn btn-outline-danger js-delete-comment" data-id="1">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path fill-rule="evenodd"
                                          d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </button>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                        Cras justo odio
                        <div class="btn-group btn-group-sm m-0" role="group">
                            <button type="button" class="btn btn-outline-danger js-delete-comment">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path fill-rule="evenodd"
                                          d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </button>
                        </div>
                    </li>
                    <li class="list-group-item p-2">Vestibulum at eros</li>
                </ul>
            </div>
            <!-- comments list -->

        </div>
        <!-- comments -->
    </div>

    <script>
        const BODY = $('body');
        const COMMENT_INPUT = $('#comment-input');
        const COMMENT_CONTAINER = $('#comments');
        const ADD_COMMENT = $('#add-comment');
        const CANCEL_EDIT = $('#cancel-edit');
        const dd = vars => {
            console.log(vars)
        }

        let selectedComment = null;


        BODY.on('click', '.js-delete-comment', function () {
            if (confirm('are you sure to delete this comment?')) {
                const $this = $(this);
                $this.parents('li').remove();

                dd($(this))
            }
        });


        BODY.on('click', '.js-edit-comment', function () {
            const $this = $(this);
            selectedComment = $this.data('id');

            CANCEL_EDIT.prop('disabled', false);
            COMMENT_INPUT.val($this.parents('li').find('span.js-comment-placeholder').text()).change().focus();
        });


        CANCEL_EDIT.click(() => {
            selectedComment = null;
            COMMENT_INPUT.val('').change();
            CANCEL_EDIT.prop('disabled', true);
        });


        COMMENT_INPUT.on('change keyup', function (event) {
            ADD_COMMENT.prop('disabled', !$(this).val());
        });


        COMMENT_INPUT.keypress(event => {
            event.keyCode === 13 ? ADD_COMMENT.click() : null;
        });


        ADD_COMMENT.click(() => {
            const comment = COMMENT_INPUT.val();
            if (!comment) {
                alert('Please, define your comment.');
                return false;
            }

            COMMENT_INPUT.val('').change();
            CANCEL_EDIT.prop('disabled', true);
            selectedComment ? updateCommentRow(comment) : COMMENT_CONTAINER.prepend(commentRowHtml(2, comment));
            selectedComment = null;

        });


        const updateCommentRow = comment => {
            $(`.js-comment-row-${selectedComment}`).find('span.js-comment-placeholder').text(comment);
        };


        const commentRowHtml = (id, comment) => {
            return (`<li class="list-group-item d-flex justify-content-between align-items-center p-2 js-comment-row-${id}">
                    <span class="js-comment-placeholder">${comment}</span>
                    <div class="btn-group btn-group-sm m-0" role="group">
                        <button type="button" class="btn btn-outline-dark js-edit-comment" data-id="${id}">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </button>
                        <button type="button" class="btn btn-outline-danger js-delete-comment" data-id="${id}">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path fill-rule="evenodd"
                                      d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                    </div>
                </li>`);
        };
    </script>
@endsection
