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
        return [
            "title" => fake()->sentence(3),
            "author_id" => \App\Models\Author::inRandomOrder()->first()?->id,
            "category_id" => \App\Models\Category::inRandomOrder()->first()?->id,
            "release_date" => fake()->date(),
            "price_huf" => fake()->numberBetween(1000, 20000),
        ];
    }
}
