<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code_no' => fake()->unique()->numerify('ITEM###'),
            'name' => fake()->words(2, true),
            'image' => fake()->imageUrl(),
            'price' => fake()->numberBetween(1000, 50000),
            'discount' => fake()->numberBetween(0, 30),
            'in_stock' => fake()->numberBetween(1, 100),
            'description' => fake()->paragraph(),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
