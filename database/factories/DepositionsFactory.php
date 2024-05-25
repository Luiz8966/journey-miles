<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Depositions>
 */
class DepositionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'persons_name' => fake()->name(),
            'deposition' => fake()->text(),
            'photo_path' => fake()->filePath(),
        ];
    }
}
