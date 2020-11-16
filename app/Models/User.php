<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function tasks()
    {
        return $this->hasMany('App\Models\Task', 'author_id', 'id');
    }


    public function attachedTasks()
    {
        return $this->hasMany('App\Models\UserTask');
    }


    public function comments()
    {
        return $this->setConnection('comment')->hasMany('App\Models\TaskComment');
    }


    public function create(array $data): User
    {
        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => Str::slug($data['name']),
            'password' => Hash::make($data['password']),
        ]);
        $user->save();

        return $user;
    }


    public function findUserByIdentifier($identifier)
    {
        return $this::where('email', $identifier)->orWhere('username', $identifier)->first();
    }
}
