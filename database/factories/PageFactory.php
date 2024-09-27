<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(mt_rand(1,2), true);
        return [
            'name' => $name,
            'content' => fake()->randomHtml(),
            'published' => fake()->boolean(75),
            'url' => Str::slug($name)
        ];
    }
}
