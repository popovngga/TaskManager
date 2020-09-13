<?php


namespace App\Traits;


use App\Http\Requests\TaskRequest;
use App\Models\Task;

trait TaskManagerTrait
{
    protected function createTask(TaskRequest $request)
    {
        $request->validated();
        $task = Task::create($request->all());
        $task->user()->associate(auth()->user())->save();
        return $task;
    }

    protected function authorTasks()
    {
        return response()->json(Task::where('user_id', auth()->user()->id)
                                    ->get(), 200);
    }

    protected function executorTasks()
    {
        return response()->json(Task::where('to_user_id', auth()->user()->id)
                                    ->get(), 200);
    }
}
