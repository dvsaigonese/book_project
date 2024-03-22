<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\BookPrice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
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
            'quantity' => fake()->numberBetween(1, 5),
            'price' => function (array $attributes) {
                return BookPrice::find($attributes['book_id'])->book_price;
            }
        ];
    }
}
