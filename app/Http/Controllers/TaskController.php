<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks;

        return view('task/home', ['tasks' => $tasks]);
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


    public function show($id)
    {
        //
    }


    public function change($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function delete($id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
