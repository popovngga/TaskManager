<?php

namespace App\Jobs;

use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskStatusNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $task;
    protected $previous;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param Task $task
     * @param string $previous
     */
    public function __construct(User $user, Task $task, string $previous)
    {
        $this->task = $task;
        $this->user = $user;
        $this->previous = $previous;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notify(new TaskStatusNotification($this->task,
                                                  $this->previous));
    }
}
