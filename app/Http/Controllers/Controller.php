<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\PathItem (
 *     path="/api"
 * )
 *
 * @OA\Info(
 *      version="v1",
 *      title="Task Manager",
 *      description="Task Manager",
 *
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Task Manager"
 * )
 *
 * @OA\Tag(
 *     name="Users",
 *     description="API Endpoints of Users"
 * )
 *  * @OA\Tag(
 *     name="Tasks",
 *     description="API Endpoints of Tasks"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
