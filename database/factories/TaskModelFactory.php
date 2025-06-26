<?php

namespace Database\Factories;

use App\Models\TaskModel;
use Illuminate\Database\Eloquent\Factories\Factory;


class TaskModelFactory extends Factory
{
    protected $model = TaskModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => ProjectModelFactory::new(),
            'title' => fake()->title(),
            'status' => fake()->randomElement (
                ['todo',
                'done'
                ]
            ),
        ];
    }
}
