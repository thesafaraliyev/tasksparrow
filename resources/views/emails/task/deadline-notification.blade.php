@component('mail::message')
# Deadline for the task

Hey {{ $recipient->name }}!

We are informing you about the deadline for the task assigned to you by {{ $task->author->name }}.<br>

Task title: <i>{{ $task->title }}</i><br>
Task deadline: <i>{{ date('d M Y H:i', strtotime($task->deadline)) }}</i>

@component('mail::button', ['url' => route('taskShow', ['task'=>$task])])
View task
@endcomponent

Thanks,<br>
The {{ config('app.name') }} Team
@endcomponent
