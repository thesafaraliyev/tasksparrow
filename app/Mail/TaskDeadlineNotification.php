<?php

namespace App\Mail;

use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskDeadlineNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $task;
    public $recipient;


    /**
     * Create a new message instance.
     *
     * @param Task $task
     * @param User $user
     */
    public function __construct(Task $task, User $user)
    {
        $this->task = $task;
        $this->recipient = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.task.deadline-notification');
    }
}
