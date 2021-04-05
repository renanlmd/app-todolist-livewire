<?php

namespace Database\Factories;

use App\Models\TodoList;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TodoList::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_task' => $this->faker->name,
            'status' => $this->faker->randomElement(['pending', 'completed']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
