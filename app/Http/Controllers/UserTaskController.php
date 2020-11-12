<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserTask;
use App\Models\Task;
use App\Models\User;
use App\Models\UserTask;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserTaskController extends Controller
{
    public function index(Task $task)
    {
        Gate::authorize('myTask', $task);
        return view('task.attach-user', ['task' => $task, 'attachedUsers' => $task->attachedUsers()->get()]);
    }


    public function store(Task $task, StoreUserTask $request, User $userModel, UserTask $userTaskModel)
    {
        Gate::authorize('myTask', $task);

        if (!$user = $userModel->findUserByIdentifier($request->input('identifier'))) {
            return redirect()->back()->with('danger', 'User is not found.');
        }

        $userTaskModel->create($task, $user, $request->input('canComment') ? 1 : 0);

        return redirect()->back()->with('success', 'User successfully attached to the task.');
    }


    public function destroy(Task $task, UserTask $userTask)
    {
        try {
            Gate::authorize('myTask', $task);
            $userTask->delete();

            return response()->json(['status' => true, 'message' => 'User task successfully deleted.']);
        } catch (NotFoundHttpException $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
