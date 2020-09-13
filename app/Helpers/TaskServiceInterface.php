<?php


namespace App\Helpers;

use App\Models\Task;
use Illuminate\Http\Request;

interface TaskServiceInterface
{
    public function changeStatus(Request $request, int $id): Task;
}
