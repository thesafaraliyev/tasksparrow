<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTask extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'task_id',
        'can_comment',
    ];

    public $timestamps = false;


    public function task()
    {
        return $this->belongsTo('App\Models\Task');
    }


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function create(Task $task, User $user, $canComment)
    {
        $userTask = $this::where('task_id', $task->id)->where('user_id', $user->id)->first();

        if ($userTask) {
            if ($userTask->can_comment != $canComment) {
                $userTask->can_comment = $canComment;
                $userTask->save();
            }
        } else {
            $task->attachedUsers()->save(new UserTask(['user_id' => $user->id, 'can_comment' => $canComment]));
        }
    }
}
