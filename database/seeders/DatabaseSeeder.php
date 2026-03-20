<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run all seeders in the correct order.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProfileSeeder::class,
            ProjectSeeder::class,
            SkillSeeder::class,
            ExperienceSeeder::class,
        ]);
    }
}
