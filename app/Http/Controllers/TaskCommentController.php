<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Events\TaskCommentAdded;
use App\Events\TaskCommentDeleted;
use App\Events\TaskCommentUpdated;

class TaskCommentController extends Controller
{
    public function index(Task $task)
    {
        Gate::authorize('view', $task);

        $comments = $task->comments()->orderBy('id', 'desc')->get();
        return response()->json(['status' => true, 'comments' => TaskComment::prepComments($comments)]);
    }


    public function store(Task $task, Request $request)
    {
        Gate::authorize('canComment', $task);

        $request->validate(['message' => 'required|min:1|max:700|string']);
        $comment = new TaskComment(['user_id' => Auth::id(), 'message' => $request->input('message')]);
        $task->comments()->save($comment);

        broadcast(new TaskCommentAdded($comment))->toOthers();

        return response()->json(['status' => true, 'comment' => TaskComment::prepComment($comment)]);
    }


    public function update(Task $task, TaskComment $taskComment, Request $request)
    {
        Gate::authorize('canComment', $task);
        Gate::authorize('myComment', $taskComment);

        $request->validate(['message' => 'required|min:1|max:700|string']);
        $taskComment->message = $request->input('message');
        $taskComment->save();

        broadcast(new TaskCommentUpdated($taskComment))->toOthers();

        return response()->json(['status' => true, 'comment' => TaskComment::prepComment($taskComment)]);
    }


    public function destroy(Task $task, TaskComment $taskComment)
    {
        Gate::authorize('view', $task);
        Gate::authorize('myCommentOrTaskAuthor', $taskComment);

        $taskComment->delete();

        broadcast(new TaskCommentDeleted($taskComment))->toOthers();

        return response()->json(['status' => true]);
    }
}
