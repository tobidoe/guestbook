<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post' => $this->faker->text,
            // comment A factory should be auth-agnostic. Frequently you run factories from the console - there won't be a user
            'user_id' => auth()->user()->id,
        ];
    }
}
