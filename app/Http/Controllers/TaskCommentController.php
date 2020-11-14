<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskCommentController extends Controller
{
    public function index(Task $task)
    {
        Gate::authorize('view', $task);

        $comments = $task->comments()->orderBy('updated_at', 'desc')->get();
        $comments = TaskComment::prepComments($comments);
        return response()->json(['status' => true, 'comments' => $comments]);
    }


    public function store(Task $task, Request $request)
    {
        Gate::authorize('canComment', $task);

        $request->validate(['message' => 'required|min:1|max:700|string']);
        $comment = new TaskComment(['user_id' => Auth::id(), 'message' => $request->input('message')]);
        $task->comments()->save($comment);

        return response()->json(['status' => true, 'comment' => TaskComment::prepComment($comment)]);
    }


    public function update(Task $task, TaskComment $taskComment, Request $request)
    {
        Gate::authorize('canComment', $task);
        Gate::authorize('myComment', $taskComment);

        $request->validate(['message' => 'required|min:1|max:700|string']);
        $taskComment->message = $request->input('message');
        $taskComment->save();

        return response()->json(['status' => true, 'comment' => TaskComment::prepComment($taskComment)]);
    }


    public function destroy(Task $task, TaskComment $taskComment)
    {
        Gate::authorize('view', $task);
        Gate::authorize('myCommentOrTaskAuthor', $taskComment);

        $taskComment->delete();
        return response()->json(['status' => true]);
    }
}