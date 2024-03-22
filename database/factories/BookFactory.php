<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = $this->faker->randomElement([
           'images/1705990233.png',
           'images/1706081665.jpg',
           'images/1706329277.jpg',
           'images/1706499021.jpg',
           'images/1706511604.jpg',
           'images/1706511941.png',
           'images/1706512142.png',
        ]);

        return [
            'name' => fake()->words(3, true),
            'quantity' => fake()->numberBetween(1, 100),
            'description' => fake()->paragraph(3),
            'publisher' => fake()->company(),
            'image' => $images,
            'publish_year' => fake()->year(),
            'status' => 1,
        ];
    }
}
