<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"header", "description", "status", "deadline", "user_executor_id"},
 * @OA\Xml(name="Task"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="user_executor_id", type="integer", readOnly="true", example="2"),
 * @OA\Property(property="user_id", type="bigInteger", readOnly="true", example="1"),
 * @OA\Property(property="header", type="string", example="Example header"),
 * @OA\Property(property="description", type="longText", example="Example description"),
 * @OA\Property(property="status", type="string", example="Declined"),
 * @OA\Property(property="deadline", type="dateTime", example="2020-09-16 18:47:59"),
 * @OA\Property(property="comment", type="longText", example="Example comment"),
 * @OA\Property(property="created_at", type="dateTime", example="2020-09-16 18:47:59"),
 * @OA\Property(property="updated_at", type="dateTime", example="2020-09-16 18:47:59"),
 * @OA\Property(property="user", ref="#/components/schemas/User"),
 * @OA\Property(property="user_executor", ref="#/components/schemas/User"),
 * )
 **/
class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_executor()
    {
        return $this->belongsTo(User::class);
    }
}
