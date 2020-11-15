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
                        <small class="text-muted">
                            Last updated
                            {{ date('d M Y', strtotime($task->updated_at)) }} &middot; {{ $task->author->name }}
                        </small>
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
            <!-- comment textarea -->
            <div class="mb-2 text-right">
                <textarea id="comment-textarea" cols="30" rows="3" class="form-control mb-2"
                          placeholder="Your comment.."></textarea>
                <button type="button" class="btn btn-sm btn-light" id="cancel-edit" disabled>Cancel edit</button>
                <button type="button" class="btn btn-sm btn-outline-dark" id="send-comment" disabled>Send</button>
            </div>
            <!-- comment textarea -->

            <!-- comments list -->
            <div class="list-group" id="comments"></div>
            <!-- comments list -->

        </div>
        <!-- comments -->
    </div>

    <script>
        const TASK_ID = parseInt('{{ $task->id }}');
        const TASK_AUTHOR_ID = parseInt('{{ $task->author_id }}');
        const USER_ID = parseInt('{{ \Illuminate\Support\Facades\Auth::id() }}');
        const URL = '{{ route('taskComment', ['task' => $task]) }}';
        const BODY = $('body');
        const COMMENT_TEXTAREA = $('#comment-textarea');
        const COMMENT_CONTAINER = $('#comments');
        const SEND_COMMENT_BTN = $('#send-comment');
        const CANCEL_EDIT = $('#cancel-edit');

        let selectedComment = null;


        $.get(URL, response => {
            let rows = '';
            if (response.comments) {
                for (let comment of response.comments) {
                    rows += commentHtml(comment);
                }
                COMMENT_CONTAINER.html(rows);
            }
        });


        BODY.on('click', '.js-c-delete', function (event) {
            event.preventDefault();

            if (confirm('are you sure to delete this comment?')) {
                const id = parseInt($(this).data('id'));
                $.post(`${URL}/destroy/${id}`).done(response => {
                    response.status ? deleteComment(id) : alert('Something went wrong.');

                }).fail((xhr, status, error) => {
                    alert(xhr.responseJSON.message);
                })
            }
        });


        BODY.on('click', '.js-c-edit', function (event) {
            event.preventDefault();
            selectedComment = parseInt($(this).data('id'));
            CANCEL_EDIT.prop('disabled', false);
            COMMENT_TEXTAREA.val(BODY.find(`.js-c-message-${selectedComment}`).text()).change().focus();
        });


        CANCEL_EDIT.click(() => {
            selectedComment = null;
            COMMENT_TEXTAREA.val('').change();
            CANCEL_EDIT.prop('disabled', true);
        });


        COMMENT_TEXTAREA.on('change keyup', function () {
            SEND_COMMENT_BTN.prop('disabled', !$(this).val());
        });


        SEND_COMMENT_BTN.click(() => {
            const message = COMMENT_TEXTAREA.val();
            if (!message) {
                alert('Please, define your comment.');
                return false;
            }

            COMMENT_TEXTAREA.val('').change();
            CANCEL_EDIT.prop('disabled', true);

            const urlSuffix = selectedComment ? `update/${selectedComment}` : 'store';
            $.post(`${URL}/${urlSuffix}`, {message}).done(response => {
                if (response.status) {
                    selectedComment ? updateComment(response.comment) : addComment(response.comment);
                } else {
                    alert('Something went wrong');
                }
                selectedComment = null;

            }).fail((xhr, status, error) => {
                alert(xhr.responseJSON.message);
            })
        });


        Echo.private(`task.${TASK_ID}`)
            .listen('TaskCommentAdded', comment => {
                addComment(comment);
            })
            .listen('TaskCommentUpdated', comment => {
                updateComment(comment)
            })
            .listen('TaskCommentDeleted', comment => {
                deleteComment(comment.id)
            });


        const addComment = comment => {
            COMMENT_CONTAINER.prepend(commentHtml(comment))
        };


        const updateComment = comment => {
            BODY.find(`.js-c-date-${comment.id}`).text(comment.date);
            BODY.find(`.js-c-message-${comment.id}`).text(comment.message);
        };


        const deleteComment = rowId => {
            BODY.find(`.js-c-item-${rowId}`).remove();
        };


        const commentHtml = comment => {
            let actions = '';
            const updateBtn = `<small><a href="#" data-id="${comment.id}" class="js-c-edit font-weight-bold">Edit</a></small>`;
            const deleteBtn = `<small><a href="#" data-id="${comment.id}" class="js-c-delete font-weight-bold">Delete</a></small>`;

            if (USER_ID === parseInt(comment.userId)) {
                actions = `${updateBtn} ${deleteBtn}`;
            } else if (TASK_AUTHOR_ID === USER_ID) {
                actions = deleteBtn;
            }

            return `
                <div class="list-group-item js-c-item-${comment.id}">
                    <div class="d-flex w-100 justify-content-between">
                        <small class="mb-1">${comment.username}</small>
                        <small class="js-c-date-${comment.id}">${comment.date}</small>
                    </div>
                    <p class="mb-1 js-c-message-${comment.id}">${comment.message}</p>
                    ${actions}
                </div>`
        };
    </script>
@endsection
