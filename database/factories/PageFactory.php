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
        $name = ucwords(fake()->words(mt_rand(1,2), true));

        return [
            'name' => $name,
            'content' => fake()->realTextBetween(100, 1000),
            'featured_image_path' => 'https://picsum.photos/600/400',
            'featured_image_alt' => 'Picsum random image',
            'published' => fake()->boolean(75),
            'url' => Str::slug($name)
        ];
    }
}
