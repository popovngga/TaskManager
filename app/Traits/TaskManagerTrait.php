<?php


namespace App\Traits;


use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

trait TaskManagerTrait
{

    /**
     * @OA\Post(
     *      path="/task/create",
     *      operationId="createTask",
     *      tags={"Tasks"},
     *      security={"Bearer"},
     *      summary="Create task",
     *      description="Returns created task",
     *      @OA\Parameter(
     *          name="header",
     *          description="Task header",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *          name="description",
     *          description="Task desctiption",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="user_executor_id",
     *          description="User executor id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *          name="deadline",
     *          description="Task deadline",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="dateTime"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *          name="status",
     *          description="Task status",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *          name="status",
     *          description="New task status",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     * @param TaskRequest $request
     * @return Task
     */
    protected function createTask(TaskRequest $request): Task
    {
        $request->validated();
        $task = Task::create($request->all());
        $task->user()->associate(auth()->user())->save();
        $task->user_executor()
            ->associate(User::findOrFail((int)$request->input('user_executor_id'))
            )->save();
        return $task;
    }

    /**
     * @OA\Get(
     *      path="/author",
     *      operationId="getAuthorTasks",
     *      tags={"Tasks"},
     *     security={"Bearer"},
     *      summary="Get author tasks",
     *      description="Returns author tasks",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     */
    protected function authorTasks()
    {
        return response()->json(Task::where('user_id', auth()->user()->id)
            ->with('user_executor')->get(), 200);
    }

    /**
     * @OA\Get(
     *      path="/executor",
     *      operationId="getExecutorTasks",
     *      tags={"Tasks"},
     *     security={"Bearer"},
     *      summary="Get executor tasks",
     *      description="Returns executor tasks",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     */
    protected function executorTasks()
    {
        return response()->json(Task::where('user_executor_id', auth()->user()
            ->id)->with('user')->get(), 200);
    }
}
