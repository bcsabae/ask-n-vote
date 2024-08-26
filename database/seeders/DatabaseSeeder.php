<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\SessionCode;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->create();
        foreach (User::all() as $user) {
            SessionCode::factory()->forUser($user)->count(3)->create();
        }

        foreach (SessionCode::all() as $session)
        {
            Question::factory()->forSession($session)->count(10)->create();
        }

    }
}
