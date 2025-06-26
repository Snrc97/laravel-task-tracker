<?php

namespace Database\Factories;

use App\Models\ProjectModel;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProjectModelFactory extends Factory
{
    protected $model = ProjectModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'name' => fake()->jobTitle(),
        ];
    }
}
