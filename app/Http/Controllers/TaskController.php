<?php

namespace App\Http\Controllers;

use App\Helpers\TaskServiceInterface;
use App\Traits\TaskManagerTrait;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use TaskManagerTrait;

    protected $service;

    public function __construct(TaskServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Patch(
     *      path="/tasks/change/{id}",
     *      operationId="changeStatusOfTaskById",
     *      tags={"Tasks"},
     *      security={"Bearer"},
     *      summary="Change task status by id",
     *      description="Returns changed task",
     *      @OA\Parameter(
     *          name="id",
     *          description="Task id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="status",
     *          description="New task status",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="comment",
     *          description="Task comment",
     *          required=false,
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
     *          response=404,
     *          description="Not found"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request, int $id)
    {
        $task = $this->service->changeStatus($request, $id);
        return response()->json([
            'message' => 'Successfully updated.',
            'data' => $task
        ], 200);
    }
}
