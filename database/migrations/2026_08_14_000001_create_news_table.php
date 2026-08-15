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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->json('title');
            $table->json('body')->nullable();
            $table->json('excerpt')->nullable();
            $table->string('url')->nullable();
            $table->string('source')->nullable();
            $table->string('author')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->boolean('ai_generated_image')->default(false);
            $table->string('ai_generated_image_path')->nullable();
            $table->string('category')->nullable();
            $table->string('language', 2)->default('en');
            $table->datetime('published_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->unique('slug');
            $table->index('published_at');
            $table->index('category');
            $table->index('language');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
