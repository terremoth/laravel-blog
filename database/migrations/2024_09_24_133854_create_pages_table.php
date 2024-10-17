<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $imageTypes = array_map(fn($item) => $item->value, App\Models\FeaturedImageType::cases());

        Schema::create('pages', function (Blueprint $table) use ($imageTypes) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->boolean('published')->default(false);
            $table->mediumText('content')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('featured_image_path')->nullable();
            $table->string('featured_image_external_url')->nullable();
            $table->enum('featured_image_type', $imageTypes)->nullable();
            $table->string('featured_image_alt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
