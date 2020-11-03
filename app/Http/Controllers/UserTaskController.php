<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class UserTaskController extends Controller
{
    public function index(Task $task)
    {
        return view('task.attach-user', ['task' => $task]);
    }
}
