<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title'       => 'E-Commerce Platform',
                'description' => 'A full-stack e-commerce platform with product management, cart, checkout, and payment gateway integration. Built with Laravel, Vue 3, and Stripe API.',
                'tech_stack'  => ['Laravel', 'Vue 3', 'MySQL', 'Redis', 'Stripe'],
                'github_url'  => 'https://github.com/asadali',
                'live_url'    => 'https://example.com',
                'image'       => null,
                'is_featured' => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Task Management App',
                'description' => 'A collaborative task management application with real-time updates, team workspaces, deadlines, and Kanban board interface. Powered by Laravel Echo + Pusher.',
                'tech_stack'  => ['Laravel', 'Vue 3', 'Pusher', 'Tailwind CSS'],
                'github_url'  => 'https://github.com/asadali',
                'live_url'    => null,
                'image'       => null,
                'is_featured' => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Portfolio CMS',
                'description' => 'This very portfolio — a headless CMS-driven portfolio built with Laravel (Filament admin) as the backend API and Vue 3 SPA as the frontend, featuring dark mode and smooth animations.',
                'tech_stack'  => ['Laravel', 'Filament', 'Vue 3', 'Tailwind CSS', 'Vite'],
                'github_url'  => 'https://github.com/asadali',
                'live_url'    => null,
                'image'       => null,
                'is_featured' => true,
                'sort_order'  => 3,
            ],
            [
                'title'       => 'REST API Boilerplate',
                'description' => 'A production-ready Laravel REST API boilerplate with Sanctum authentication, role-based access control, rate limiting, API versioning, and comprehensive test coverage.',
                'tech_stack'  => ['Laravel', 'Sanctum', 'PHPUnit', 'MySQL'],
                'github_url'  => 'https://github.com/asadali',
                'live_url'    => null,
                'image'       => null,
                'is_featured' => false,
                'sort_order'  => 4,
            ],
            [
                'title'       => 'Real-Time Chat App',
                'description' => 'A real-time messaging application supporting private channels, group rooms, file sharing, and read receipts, using WebSockets and Laravel Echo.',
                'tech_stack'  => ['Laravel', 'Vue 3', 'WebSockets', 'Redis', 'Pusher'],
                'github_url'  => 'https://github.com/asadali',
                'live_url'    => null,
                'image'       => null,
                'is_featured' => false,
                'sort_order'  => 5,
            ],
        ];

        foreach ($projects as $project) {
            Project::firstOrCreate(
                ['title' => $project['title']],
                $project
            );
        }

        $this->command->info('✓  ' . count($projects) . ' projects seeded.');
    }
}
