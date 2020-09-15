<?php


namespace App\Helpers;


use App\Jobs\SendMessage;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskStatusNotification;
use App\Traits\TaskManagerTrait;
use Illuminate\Http\Request;

class TaskService implements TaskServiceInterface
{
    use TaskManagerTrait;

    public function changeStatus(Request $request, int $id): Task
    {
        $task = Task::findOrFail($id);
        $previousStatus = $task->status;
        $task->update($request->all());
        $user = User::where('id', (int)$task->user_executor_id)->first();
        dispatch(new SendMessage($user, $task, $previousStatus));
        return $task;
    }
}
