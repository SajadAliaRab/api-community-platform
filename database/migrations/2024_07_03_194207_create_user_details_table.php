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
            $table->string('image')->default('clubProfile.jpg');
            $table->string('cover_image')->default('sampleCoverImage.jpg');
            $table->string('tagline')->nullable();
            $table->enum('title',['mr','mrs','miss','ms','dr','professor','lord','lady','reverend','other'])->default(\App\Enums\TitleEnum::Other->value);
            $table->string('website')->nullable();
            $table->string('mobile')->nullable();
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
