<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                return User::all()->random()->id;
            },
            'book_id' => function () {
                return Book::all()->random()->id;
            },
            'score' => fake()->numberBetween(0,5),
            'title' => fake()->title(),
            'description' => fake()->paragraph(2),
        ];
    }
}
