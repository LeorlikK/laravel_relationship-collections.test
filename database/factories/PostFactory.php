<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    private static int $id = 1;

    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
//            'id' => fake()->unique()->numberBetween(1, 5),
//            'id' => self::$id++,
            'title' => fake()->unique()->name,
            'slug' => $this->faker->name,
            'body' => $this->faker->text(50),
            'category_id' => 1
        ];
    }
}
