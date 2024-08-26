<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SessionCode>
 */
class SessionCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = User::first()->id;

        return [
            'session_code' => Str::upper(Str::random(6)),
            'is_active' => true,
            'title' => fake()->title(),
            'user_id' => $user_id,
        ];
    }

    public function forUser(User $user): Factory
    {
        return $this->state(function (array $attributes) use ($user ) {
            return [
                'user_id' => $user->id,
            ];
        });
    }
}
