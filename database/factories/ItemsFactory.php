<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->unique()->safeEmail(),
            'quantity' => $this->faker->unique()->safeEmail(),
            'description' => $this->faker->description(),
        ];
    }
}
