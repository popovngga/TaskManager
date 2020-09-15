<?php


namespace App\Traits;


use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;

trait TaskManagerTrait
{
    protected function createTask(TaskRequest $request)
    {
        $request->validated();
        $task = Task::create($request->all());
        $task->user()->associate(auth()->user())->save();
        $task->user_executor()
            ->associate(User::findOrFail((int)$request->input('user_executor_id'))
            )->save();
        return $task;
    }

    protected function authorTasks()
    {
        return response()->json(Task::where('user_id', auth()->user()->id)
            ->with('user_executor')->get(), 200);
    }

    protected function executorTasks()
    {
        return response()->json(Task::where('user_executor_id', auth()->user()
            ->id)->with('user')->get(), 200);
    }
}
