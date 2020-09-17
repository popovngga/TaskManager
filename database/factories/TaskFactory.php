<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();
        return [
            'header'=> 'Test header',
            'description'=> 'Test description',
            'user_executor_id'=> $user->id,
            'deadline'=> '2020-09-16 18:47:59',
            'status' => 'Declined'
        ];
    }
}
