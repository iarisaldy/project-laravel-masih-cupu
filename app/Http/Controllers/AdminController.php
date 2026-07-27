<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the Admin Dashboard Control Panel.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $stats = [
            'total_projects' => 4,
            'total_messages' => 12,
            'unread_messages' => 3,
            'total_views' => '2,480',
            'skills_tracked' => 12
        ];

        $projects = [
            [
                'id' => 1,
                'title' => 'Enterprise Clinic Management System',
                'category' => 'fullstack',
                'tech_stack' => 'Next.js, Supabase, TypeScript',
                'demo_url' => 'https://clinic-demo.example.com'
            ],
            [
                'id' => 2,
                'title' => 'Senior QA Automation Framework',
                'category' => 'qa',
                'tech_stack' => 'Playwright, k6, TypeScript',
                'demo_url' => 'https://qa-report.example.com'
            ],
            [
                'id' => 3,
                'title' => 'Antigravity AI Code Assistant Suite',
                'category' => 'ai',
                'tech_stack' => 'TypeScript, Node.js, LLM',
                'demo_url' => 'https://ai-suite.example.com'
            ]
        ];

        return view('admin', compact('stats', 'projects'));
    }

    /**
     * API endpoint to create a new project.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeProject(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'category' => 'required|string',
            'tech_stack' => 'required|string',
            'description' => 'required|string',
            'demo_url' => 'nullable|url',
            'github_url' => 'nullable|url'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Project added successfully!',
            'data' => array_merge(['id' => time()], $validated)
        ], 201);
    }
}
