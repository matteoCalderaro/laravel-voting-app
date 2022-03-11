<?php

namespace Database\Factories;

use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'=> User::factory(),
            'idea_id'=> Idea::factory(),
            'status_id'=> Status::factory(),
            'body'=> $this->faker->paragraph(3),
        ];
    }

    public function exsisting()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => $this->faker->numberBetween(1,20),
                'status_id' => 1,
            ];
        });
    }
}
