<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OneToOneSecond>
 */
class OneToOneSecondFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Second ' . $this->faker->name(),
            'first_id' => $this->faker->unique()->numberBetween(1,10)
        ];
    }
}
