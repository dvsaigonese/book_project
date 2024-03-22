<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BillDetail>
 */
class BillDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bill_id' => function () {
                return Bill::all()->random()->id;
            },
            'book_id' => function () {
                return Book::all()->random()->id;
            },
            'quantity' => fake()->numberBetween(1, 5),
            'price' => fake()->numberBetween(20000, 1000000),
        ];
    }
}
