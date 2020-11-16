<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'title',
        'deadline',
        'description',
    ];


    public function author()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function attachedUsers()
    {
        return $this->hasMany('App\Models\UserTask');
    }


    public function comments()
    {
        return $this->setConnection('comment')->hasMany('App\Models\TaskComment');
    }
}
