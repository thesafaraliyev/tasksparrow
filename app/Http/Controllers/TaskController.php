<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index()
    {
        return view('task/home', ['tasks' => Auth::user()->tasks]);
    }


    public function attachedTasks()
    {
        return view('task/attached-tasks', ['attachedTasks' => Auth::user()->attachedTasks]);
    }


    public function add()
    {
        return view('task/add');
    }


    public function store(StoreTask $request)
    {
        $task = new Task($request->only('title', 'deadline', 'description'));
        Auth::user()->tasks()->save($task);

        return redirect()->route('home')->with('success', 'New task successfully created.');
    }


    public function show(Task $task)
    {
        Gate::authorize('view', $task);

        return view('task.show', ['task' => $task]);
    }


    public function edit(Task $task)
    {
        Gate::authorize('myTask', $task);

        return view('task.edit', ['task' => $task]);
    }


    public function update(StoreTask $request, Task $task)
    {
        Gate::authorize('myTask', $task);

        $task->title = $request->input('title');
        $task->deadline = $request->input('deadline');
        $task->description = $request->input('description');
        $task->save();

        return redirect()->route('home')->with('success', 'Task successfully updated.');
    }


    public function delete(Task $task)
    {
        Gate::authorize('myTask', $task);

        return view('task.delete', ['task' => $task]);
    }


    public function destroy(Task $task)
    {
        Gate::authorize('myTask', $task);
        $task->delete();

        return redirect()->route('home')->with('success', 'Task successfully deleted.');
    }
}
