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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->string('featured_image_path')->nullable();
            $table->string('featured_image_alt')->nullable();
            $table->mediumText('content')->nullable();
            $table->unsignedBigInteger('last_updated_by')->nullable();
            $table->boolean('enable_comments')->default(true);
            $table->string('url');
            $table->timestamps();
            $table->foreign('last_updated_by')->on('users')->references('id');
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
