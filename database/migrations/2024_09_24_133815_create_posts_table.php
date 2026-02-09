<?php

use App\Models\User;
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

        Schema::create('posts', function (Blueprint $table) use ($imageTypes) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title')->index();
            $table->string('featured_image_path')->nullable();
            $table->string('featured_image_external_url')->nullable();
            $table->enum('featured_image_type', $imageTypes)->nullable();
            $table->string('featured_image_alt')->nullable();
            $table->mediumText('content')->nullable();
            $table->unsignedBigInteger('last_updated_by')->nullable();
            $table->boolean('enable_comments')->default(true);
            $table->string('url');
            $table->foreign('last_updated_by')->on('users')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
