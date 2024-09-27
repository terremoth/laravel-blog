<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Widget;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'is_admin' => true
        ]);

        $this->call([
            UserSeeder::class,
            PostSeeder::class,
            TagSeeder::class,
            CommentSeeder::class,
            PageSeeder::class,
            WidgetSeeder::class
        ]);
    }
}
