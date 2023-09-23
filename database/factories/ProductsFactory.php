<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'harga' => 50000,
            'is_ready' => fake()->randomElement([0,1]),
            'jenis' => "jenis",
            'categories_id' =>  fake()->randomElement([1,3]),
            'description' => fake()->text(),
        ];
    }
}
