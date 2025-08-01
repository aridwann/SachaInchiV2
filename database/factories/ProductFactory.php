<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        $stock = ['Tersedia', 'Kosong'];
        return [
            'name' => fake()->name(),
            "img" => fake()->text(100),
            'price' => fake()->randomNumber(6, true),
            'stock' => $stock[rand(0,1)],
            'ishide' => rand(0,1),
            'description' => fake()->sentence(30, true),
        ];
    }
}
