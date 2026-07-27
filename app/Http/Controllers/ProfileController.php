<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the main Personal Web Profile page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $profile = [
            'name' => 'Muhammad Irfan',
            'title' => 'Senior Full Stack & Software Engineer',
            'status' => 'Available for new opportunities & collaborations',
            'bio' => 'Crafting high-performance web applications, scalable backend microservices, and elegant automated testing ecosystems with modern design aesthetics.',
            'experience_years' => '6+',
            'projects_completed' => '45+',
            'satisfied_clients' => '30+',
            'contributions' => '1.2k+'
        ];

        $skills = [
            [
                'category' => 'Frontend Architecture',
                'icon' => '🎨',
                'items' => [
                    ['name' => 'Vue.js / Next.js / React', 'level' => 95],
                    ['name' => 'TypeScript / Modern JS (ESNext)', 'level' => 92],
                    ['name' => 'HTML5 / CSS3 / Glassmorphism UI', 'level' => 96],
                    ['name' => 'TailwindCSS / Vanilla CSS Tokens', 'level' => 94]
                ]
            ],
            [
                'category' => 'Backend & Databases',
                'icon' => '⚡',
                'items' => [
                    ['name' => 'Laravel (PHP 7.4/8.x)', 'level' => 94],
                    ['name' => 'Node.js / Express / NestJS', 'level' => 90],
                    ['name' => 'PostgreSQL / MySQL / SQLite', 'level' => 88],
                    ['name' => 'RESTful API & GraphQL Design', 'level' => 92]
                ]
            ],
            [
                'category' => 'DevOps & Quality Assurance',
                'icon' => '🛡️',
                'items' => [
                    ['name' => 'Docker / Containerization', 'level' => 86],
                    ['name' => 'Playwright / Cypress E2E Testing', 'level' => 94],
                    ['name' => 'k6 Load & Performance Testing', 'level' => 88],
                    ['name' => 'CI/CD Pipelines (GitHub Actions)', 'level' => 85]
                ]
            ]
        ];

        $projects = [
            [
                'id' => 1,
                'title' => 'Enterprise Clinic Management System',
                'category' => 'fullstack',
                'description' => 'Real-time outpatient queue management system with Supabase backend, multi-doctor scheduling, and automated patient notifications.',
                'tags' => ['Next.js', 'Supabase', 'TypeScript', 'TailwindCSS'],
                'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80',
                'demo' => 'https://clinic-demo.example.com',
                'github' => 'https://github.com/iarisaldy/clinic-management-system'
            ],
            [
                'id' => 2,
                'title' => 'Senior QA Automation Framework',
                'category' => 'qa',
                'description' => 'Comprehensive multi-layer QA framework featuring Playwright TypeScript E2E testing, k6 load testing, and GitHub Actions reporting.',
                'tags' => ['Playwright', 'k6', 'TypeScript', 'GitHub Actions'],
                'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80',
                'demo' => 'https://qa-report.example.com',
                'github' => 'https://github.com/iarisaldy/senior-qa-test'
            ],
            [
                'id' => 3,
                'title' => 'Antigravity AI Code Assistant Suite',
                'category' => 'ai',
                'description' => 'Autonomous developer subagent engine for code refactoring, context-aware bug fixing, and dynamic UI component generation.',
                'tags' => ['TypeScript', 'Node.js', 'LLM Agents', 'Docker'],
                'image' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=800&q=80',
                'demo' => 'https://ai-suite.example.com',
                'github' => 'https://github.com/iarisaldy/ai-assistant-suite'
            ],
            [
                'id' => 4,
                'title' => 'Cloud Microservice API Gateway',
                'category' => 'cloud',
                'description' => 'High-throughput API gateway with rate limiting, JWT authentication, and distributed Redis cache cluster for microservices.',
                'tags' => ['Laravel 8', 'Redis', 'Docker', 'PostgreSQL'],
                'image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=800&q=80',
                'demo' => 'https://api-gateway.example.com',
                'github' => 'https://github.com/iarisaldy/cloud-api-gateway'
            ]
        ];

        $experiences = [
            [
                'role' => 'Senior Software & Full Stack Engineer',
                'company' => 'Tech Innovation Lab',
                'period' => '2023 - Present',
                'description' => 'Led web application development, microservice architecture, and automated test suite integration for client products.'
            ],
            [
                'role' => 'Full Stack & Automation Specialist',
                'company' => 'Digital Solutions Studio',
                'period' => '2021 - 2023',
                'description' => 'Built scalable web portals, database migrations, and CI/CD pipelines reducing deployment friction by 40%.'
            ],
            [
                'role' => 'Junior Web Developer',
                'company' => 'Creative Web Agency',
                'period' => '2019 - 2021',
                'description' => 'Developed custom PHP/Laravel web applications, responsive landing pages, and RESTful endpoints.'
            ]
        ];

        return view('home', compact('profile', 'skills', 'projects', 'experiences'));
    }

    /**
     * API endpoint to handle contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Thank you for reaching out! Your message has been received.',
            'data' => $validated
        ], 200);
    }
}
