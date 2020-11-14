<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;


    public function myTask(User $user, Task $task)
    {
        return $user->id === $task->author_id;
    }


    public function canComment(User $user, Task $task)
    {
        $query = $user->attachedTasks()->where('task_id', $task->id);
        return $user->id === $task->author_id || ($query->exists() && !!$query->first()->can_comment);
    }


    public function view(User $user, Task $task)
    {
        return $user->id === $task->author_id || $user->attachedTasks()->where('task_id', $task->id)->exists();
    }
}
