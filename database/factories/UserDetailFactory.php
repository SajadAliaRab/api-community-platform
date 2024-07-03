<?php

namespace Database\Factories;

use App\Enums\TitleEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetail>
 */
class UserDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = TitleEnum::cases(); // Get all the enum cases
        $randomTitle = $titles[array_rand($titles)]->value;
        $user =User::factory()->create();
        return [
            'user_id'=>$user->id,
            'image'=>fake()->imageUrl(),
            'cover_image'=>fake()->imageUrl(),
            'tagline'=>fake()->sentence(),
            'title'=>$randomTitle,
            'website'=> fake()->domainName(),
            'mobile'=>fake()->phoneNumber(),
            'point'=> fake()->numberBetween([1],[200])
        ];
    }
}
