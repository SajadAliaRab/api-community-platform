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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('image')->default('sampleProfile.jpg');
            $table->string('cover_image')->nullable('sampleCoverImage.jpg');
            $table->string('tagline')->nullable();
            $table->string('title')->default(\App\Enums\TitleEnum::Other->value);
            $table->string('website')->nullable();
            $table->string('mobile');
            $table->integer('point')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
