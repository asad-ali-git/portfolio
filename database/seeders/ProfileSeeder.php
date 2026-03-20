<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::updateOrCreate(
            ['id' => 1],
            [
                'name'     => 'Asad Ali',
                'title'    => 'Senior Full-Stack Engineer',
                'subtitle' => 'Laravel & Vue 3',
                'tagline'  => 'Building systems that scale, interfaces that feel intentional.',

                'bio' => implode("\n\n", [
                    "I'm a senior full-stack engineer based in Pakistan with 8+ years of experience shipping production-grade applications. My stack centers on Laravel and Vue 3, but the craft matters more than the tools.",
                    "I believe in clear boundaries between concerns, APIs that are a pleasure to consume, and UIs that feel fast even when they're doing heavy lifting behind the scenes. Clean code isn't an aesthetic preference — it's how you build things you can still be proud of years later.",
                    "When I'm not building, I'm contributing to open-source, writing internal documentation that people actually read, or mentoring junior devs through their first production incident.",
                ]),

                'tags' => ['API Designer', 'Performance Fanatic', 'Clean Code Advocate', 'Problem Solver', 'Team Player'],

                'location'            => 'Pakistan',
                'availability'        => 'Available for work · Remote / Pakistan',
                'email'               => 'asadali@example.com',
                'github_url'          => 'https://github.com/asad-ali',
                'linkedin_url'        => 'https://linkedin.com/in/asad-ali',
                'resume_url'          => null,
                'years_of_experience' => 8,
                'open_source_commits' => 200,
            ]
        );

        $this->command->info('✓  Profile seeded.');
    }
}
