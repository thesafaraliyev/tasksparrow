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


    /**
     * Determine whether the user can add comment the model.
     *
     * @param User $user
     * @param Task $task
     * @return mixed
     */
    public function canComment(User $user, Task $task)
    {
        $query = $user->attachedTasks()->where('task_id', $task->id);
        return $user->id === $task->author_id || ($query->exists() && !!$query->first()->can_comment);
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Task $task
     * @return mixed
     */
    public function view(User $user, Task $task)
    {
        return $user->id === $task->author_id || $user->attachedTasks()->where('task_id', $task->id)->exists();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Task $task
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Task $task
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Task $task
     * @return mixed
     */
    public function restore(User $user, Task $task)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Task $task
     * @return mixed
     */
    public function forceDelete(User $user, Task $task)
    {
        //
    }
}
