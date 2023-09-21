<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => Str::random(10),
            'slug' => Str::slug(Str::random(10), '-'),
            'price' => fake()->randomNumber(4, true),
            'image' => fake()->imageUrl(),
            'description' => fake()->paragraph(5),
            'type' => fake()->randomElements(['0', '1']),
        ];
    }
}
