<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $experiences = [
            [
                'role'        => 'Senior Laravel Developer',
                'company'     => 'Tech Solutions Pvt. Ltd.',
                'start_date'  => '2022-01-01',
                'end_date'    => null,          // null = current position
                'description' => 'Lead backend development for multiple SaaS products. Architected RESTful APIs consumed by Vue 3 frontends. Mentored junior developers, set up CI/CD pipelines with GitHub Actions and Docker, and implemented Redis caching to cut average response times by 40%.',
                'sort_order'  => 1,
            ],
            [
                'role'        => 'Full-Stack PHP Developer',
                'company'     => 'Digital Agency XYZ',
                'start_date'  => '2019-06-01',
                'end_date'    => '2021-12-31',
                'description' => 'Built and maintained 15+ client web applications using Laravel and Vue.js. Worked directly with clients to translate requirements into features. Integrated third-party APIs (payment gateways, SMS, email) and maintained legacy PHP codebases.',
                'sort_order'  => 2,
            ],
            [
                'role'        => 'Junior Web Developer',
                'company'     => 'StartUp Hub',
                'start_date'  => '2018-01-01',
                'end_date'    => '2019-05-31',
                'description' => 'Started professional career building dynamic web applications with PHP and vanilla JavaScript. Gained hands-on experience with MySQL database design, server-side rendering, and deploying applications on shared hosting and VPS servers.',
                'sort_order'  => 3,
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::firstOrCreate(
                [
                    'company' => $experience['company'],
                    'role'    => $experience['role'],
                ],
                $experience
            );
        }

        $this->command->info('✓  ' . count($experiences) . ' experience entries seeded.');
    }
}
