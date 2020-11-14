<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_id',
        'message',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function task()
    {
        return $this->belongsTo('App\Models\Task');
    }


    public static function prepComment($comment)
    {
        return [
            'id' => $comment->id,
            'date' => date('d M Y H:i', strtotime($comment->updated_at)),
            'message' => $comment->message,
            'username' => $comment->user->name,
            'userId' => $comment->user->id,
        ];
    }


    public static function prepComments($comments)
    {
        $result = [];
        foreach ($comments as $comment) {
            $result[] = self::prepComment($comment);
        }

        return $result;
    }
}
