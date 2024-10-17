<?php

namespace Database\Factories;

use App\Models\FeaturedImageType;
use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

/**
 * @extends Factory<Page>
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
        $definition = [
            'name' => $name,
            'content' => fake()->realTextBetween(100, 1000),
            'featured_image_alt' => 'Picsum random image',
            'published' => fake()->boolean(75),
            'url' => Str::slug($name)
        ];

        if (fake()->boolean()) {

            $response = Http::get('https://picsum.photos/400/200');
            $imageFakeName = 'fake_picsum_image_' . fake()->uuid() . '.jpg';
            Storage::disk('public')->put(Page::PAGES_IMAGES_PATH . $imageFakeName, $response->body());

            $definition['featured_image_type'] = FeaturedImageType::File->value;
            $definition['featured_image_path'] = $imageFakeName;
        } else {
            $definition['featured_image_type'] = FeaturedImageType::URL->value;
            $definition['featured_image_external_url'] = 'https://picsum.photos/600/400';
        }

        return $definition;
    }
}
