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
        Question::factory(20)->create();
        SessionCode::factory(3)->create();
    }
}
