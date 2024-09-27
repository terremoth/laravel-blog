<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = ucwords(implode(' ', fake()->words(mt_rand(3,10))));

        return [
            'title' => $title,
            'content' => fake()->realTextBetween(250, 1000),
            'user_id' => User::select('id')->inRandomOrder()->limit(1)->first()->id,
            'url' => Str::slug($title),
            'enable_comments' => fake()->boolean(75)
        ];
    }
}
