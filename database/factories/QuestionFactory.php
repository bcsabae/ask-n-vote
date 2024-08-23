<?php

namespace Database\Factories;

use App\Models\SessionCode;
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
        $sessionCode = SessionCode::first();

        return [
            'question_text' => fake()->sentence(),
            'upvotes' => fake()->numberBetween(0, 100),
            'is_answered' => false,
            'asked_by' => fake()->userName,
            'session_code_id' => $sessionCode->id,
        ];
    }

    public function forSession(SessionCode $sessionCode): Factory
    {
        return $this->state(function (array $attributes) use ($sessionCode) {
            return [
                'session_code_id' => $sessionCode->id,
            ];
        });
    }
}
