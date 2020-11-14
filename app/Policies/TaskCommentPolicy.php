<?php

namespace App\Policies;

use App\Models\TaskComment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskCommentPolicy
{
    use HandlesAuthorization;

    public function myComment(User $user, TaskComment $taskComment)
    {
        return $user->id === $taskComment->user_id;
    }


    public function myCommentOrTaskAuthor(User $user, TaskComment $taskComment)
    {
        return $user->id === $taskComment->user_id || $user->id == $taskComment->task->author_id;
    }
}
