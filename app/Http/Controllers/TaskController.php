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

    public function changeStatus(Request $request, int $id)
    {
        $task = $this->service->changeStatus($request, $id);
        return response()->json([
            'message' => 'Successfully updated.',
            'data' => $task
        ], 200);
    }
}
