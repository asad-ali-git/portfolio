<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            // ── Frontend ────────────────────────────────────────────────────
            ['name' => 'Vue 3',          'category' => 'Frontend', 'level' => 95, 'sort_order' => 1],
            ['name' => 'JavaScript',     'category' => 'Frontend', 'level' => 90, 'sort_order' => 2],
            ['name' => 'TypeScript',     'category' => 'Frontend', 'level' => 80, 'sort_order' => 3],
            ['name' => 'Tailwind CSS',   'category' => 'Frontend', 'level' => 92, 'sort_order' => 4],
            ['name' => 'HTML / CSS',     'category' => 'Frontend', 'level' => 95, 'sort_order' => 5],

            // ── Backend ─────────────────────────────────────────────────────
            ['name' => 'Laravel',        'category' => 'Backend',  'level' => 95, 'sort_order' => 1],
            ['name' => 'PHP',            'category' => 'Backend',  'level' => 92, 'sort_order' => 2],
            ['name' => 'REST APIs',      'category' => 'Backend',  'level' => 90, 'sort_order' => 3],
            ['name' => 'Node.js',        'category' => 'Backend',  'level' => 70, 'sort_order' => 4],

            // ── Database ─────────────────────────────────────────────────────
            ['name' => 'MySQL',          'category' => 'Database', 'level' => 90, 'sort_order' => 1],
            ['name' => 'PostgreSQL',     'category' => 'Database', 'level' => 75, 'sort_order' => 2],
            ['name' => 'Redis',          'category' => 'Database', 'level' => 80, 'sort_order' => 3],

            // ── Tools & DevOps ───────────────────────────────────────────────
            ['name' => 'Git & GitHub',   'category' => 'Tools',    'level' => 92, 'sort_order' => 1],
            ['name' => 'Docker',         'category' => 'Tools',    'level' => 75, 'sort_order' => 2],
            ['name' => 'Linux / Shell',  'category' => 'Tools',    'level' => 80, 'sort_order' => 3],
            ['name' => 'Filament',       'category' => 'Tools',    'level' => 90, 'sort_order' => 4],
        ];

        foreach ($skills as $skill) {
            Skill::firstOrCreate(
                ['name' => $skill['name']],
                $skill
            );
        }

        $this->command->info('✓  ' . count($skills) . ' skills seeded.');
    }
}
