<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tagList = [
            'car', 'game', 'programming', 'web', 'php', 'wheels', 'ecommerce', 'browser', 'race', 'cloth',
            'judo', 'cryptocurrency', 'artificial intelligence', 'css', 'ecology', 'book', 'magic', 'console',
            'tea', 'drink', 'bed', 'iron', 'basketball', 'soccer', 'chatbot', 'music', 'king kong', 'wireless',
            'graphics programming', 'art', 'real time', 'rain forest', 'martial art', 'Linux Mint', 'object oriented',
            'glass', 'fork', 'electronics', 'toy', 'product', 'hardware', 'motorcycle', 'bug bounty', 'kick flip'
        ];

        $name = collect($tagList)->random();

        return [
            'name' => $name,
            'post_id' => Post::select('id')->inRandomOrder()->limit(1)->first()->id
        ];
    }
}
