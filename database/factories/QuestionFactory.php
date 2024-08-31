<?php

namespace Database\Factories;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $guest = Guest::first();

        return [
            'question_text' => fake()->sentence(),
            'upvotes' => fake()->numberBetween(0, 100),
            'is_answered' => false,
            'guest_id' => fake()->userName,
        ];
    }

    public function forGuest(Guest $guest): Factory
    {
        return $this->state(function (array $attributes) use ($guest) {
            return [
                'guest_id' => $guest->id,
            ];
        });
    }

    public function withZeroUpvotes(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'upvotes' => 0,
            ];
        });
    }
}
