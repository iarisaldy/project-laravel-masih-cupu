<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Portfolio CMS</title>
    
    <!-- Google Fonts & Stylesheets -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="admin-layout">
        <!-- Admin Sidebar -->
        <aside class="admin-sidebar">
            <div class="admin-brand">
                <span class="gradient-text">ADMIN</span> CMS
                <span class="logo-badge" style="background: var(--accent-emerald);">LIVE</span>
            </div>

            <ul class="admin-menu">
                <li>
                    <a href="#overview" class="admin-menu-item active" data-tab="overview">
                        <span>📊</span> Overview & Stats
                    </a>
                </li>
                <li>
                    <a href="#projects" class="admin-menu-item" data-tab="projects">
                        <span>📁</span> Projects Manager
                    </a>
                </li>
                <li>
                    <a href="#inbox" class="admin-menu-item" data-tab="inbox">
                        <span>📥</span> Inbox Messages
                        <span id="unread-msg-count" class="status-badge" style="margin-left: auto; padding: 0.15rem 0.5rem; font-size: 0.7rem;">0</span>
                    </a>
                </li>
                <li>
                    <a href="#skills" class="admin-menu-item" data-tab="skills">
                        <span>⚡</span> Skills & Stack
                    </a>
                </li>
            </ul>

            <div style="margin-top: auto; padding-top: 2rem; border-top: 1px solid var(--border-color);">
                <a href="/" class="btn btn-outline" style="width: 100%; justify-content: center; gap: 0.5rem;">
                    🏠 Back to Web Profile
                </a>
            </div>
        </aside>

        <!-- Admin Main Content Area -->
        <main class="admin-main">
            <!-- Header Bar -->
            <header class="admin-header">
                <div>
                    <h1 style="font-size: 1.8rem; font-weight: 800;">Portfolio Control Panel</h1>
                    <p style="color: var(--text-secondary); font-size: 0.95rem;">Manage your portfolio items, inbox submissions, and tech skills in real time.</p>
                </div>

                <div style="display: flex; align-items: center; gap: 1rem;">
                    <button id="theme-toggle-btn" class="theme-toggle" aria-label="Toggle Theme">☀️</button>
                    <div style="display: flex; align-items: center; gap: 0.75rem; background: var(--bg-card); padding: 0.5rem 1rem; border-radius: var(--radius-full); border: 1px solid var(--border-color);">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--accent-gradient); display: flex; align-items: center; justify-content: center; font-weight: 700; color: white;">MI</div>
                        <span style="font-weight: 600; font-size: 0.9rem;">Muhammad Irfan</span>
                    </div>
                </div>
            </header>

            <!-- TAB 1: Overview -->
            <section id="tab-overview" class="admin-tab-content active">
                <div class="stats-grid" style="margin-top: 0; margin-bottom: 2rem;">
                    <div class="stat-card">
                        <div class="stat-number">{{ $stats['total_projects'] }}</div>
                        <div class="stat-label">Active Projects</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ $stats['total_messages'] }}</div>
                        <div class="stat-label">Inbox Messages</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" style="color: var(--accent-emerald);">{{ $stats['total_views'] }}</div>
                        <div class="stat-label">Total Views</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ $stats['skills_tracked'] }}</div>
                        <div class="stat-label">Skills Tracked</div>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <h2 style="font-size: 1.3rem; font-weight: 700;">Portfolio Items</h2>
                    <button class="btn btn-primary btn-sm" data-modal="add-project-modal">+ Add New Project</button>
                </div>

                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Category</th>
                                <th>Tech Stack</th>
                                <th>Live Link</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $p)
                            <tr>
                                <td><strong>{{ $p['title'] }}</strong></td>
                                <td><span class="tech-tag">{{ strtoupper($p['category']) }}</span></td>
                                <td>{{ $p['tech_stack'] }}</td>
                                <td><a href="{{ $p['demo_url'] }}" target="_blank" style="color: var(--accent-primary); text-decoration: none;">Preview ↗</a></td>
                                <td>
                                    <button class="btn btn-outline btn-sm" onclick="alert('Editing {{ $p['title'] }}')">Edit</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- TAB 2: Projects Manager -->
            <section id="tab-projects" class="admin-tab-content">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h2 style="font-size: 1.4rem; font-weight: 700;">Manage Portfolio Showcase</h2>
                    <button class="btn btn-primary" data-modal="add-project-modal">+ Add Project</button>
                </div>

                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Project Title</th>
                                <th>Category</th>
                                <th>Tech Stack</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $p)
                            <tr>
                                <td><strong>{{ $p['title'] }}</strong></td>
                                <td><span class="tech-tag">{{ strtoupper($p['category']) }}</span></td>
                                <td>{{ $p['tech_stack'] }}</td>
                                <td>
                                    <button class="btn btn-outline btn-sm" style="color: var(--accent-rose); border-color: var(--accent-rose);" onclick="alert('Deleted {{ $p['title'] }}')">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- TAB 3: Inbox Messages -->
            <section id="tab-inbox" class="admin-tab-content">
                <div style="margin-bottom: 1.5rem;">
                    <h2 style="font-size: 1.4rem; font-weight: 700;">Inbox Messages</h2>
                    <p style="color: var(--text-secondary); font-size: 0.9rem;">Contact submissions received via portfolio website.</p>
                </div>

                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Sender</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="admin-inbox-list">
                            <!-- Populated dynamically via app.js -->
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- TAB 4: Skills & Stack -->
            <section id="tab-skills" class="admin-tab-content">
                <div style="margin-bottom: 1.5rem;">
                    <h2 style="font-size: 1.4rem; font-weight: 700;">Skills & Technology Stack</h2>
                    <p style="color: var(--text-secondary); font-size: 0.9rem;">Manage proficiency metrics and tech categories.</p>
                </div>

                <div class="skills-grid">
                    <div class="skill-category-card">
                        <h3 class="category-title">🎨 Frontend Technologies</h3>
                        <p style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 1rem;">Vue.js, Next.js, React, TypeScript, HTML5/CSS3</p>
                        <button class="btn btn-outline btn-sm">Manage Stack</button>
                    </div>

                    <div class="skill-category-card">
                        <h3 class="category-title">⚡ Backend & DB</h3>
                        <p style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 1rem;">Laravel, Node.js, Express, PostgreSQL, MySQL</p>
                        <button class="btn btn-outline btn-sm">Manage Stack</button>
                    </div>

                    <div class="skill-category-card">
                        <h3 class="category-title">🛡️ QA & DevOps</h3>
                        <p style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 1rem;">Docker, Playwright, k6 Load Test, CI/CD</p>
                        <button class="btn btn-outline btn-sm">Manage Stack</button>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Modal: Add New Project -->
    <div id="add-project-modal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3 class="modal-title">✨ Add New Portfolio Project</h3>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="add-project-form">
                    <div class="form-group">
                        <label class="form-label" for="proj-title">Project Title</label>
                        <input type="text" id="proj-title" name="title" class="form-input" placeholder="e.g. E-Commerce Microservice" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="proj-cat">Category</label>
                        <select id="proj-cat" name="category" class="form-select" required>
                            <option value="fullstack">Full Stack</option>
                            <option value="qa">QA & Automation</option>
                            <option value="ai">AI Tools</option>
                            <option value="cloud">Cloud / DevOps</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="proj-tech">Tech Stack (comma separated)</label>
                        <input type="text" id="proj-tech" name="tech_stack" class="form-input" placeholder="e.g. Laravel, React, Docker, MySQL" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="proj-desc">Description</label>
                        <textarea id="proj-desc" name="description" class="form-textarea" placeholder="Brief project summary..." required></textarea>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label class="form-label" for="proj-demo">Demo URL</label>
                            <input type="url" id="proj-demo" name="demo_url" class="form-input" placeholder="https://example.com">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="proj-github">GitHub Repository</label>
                            <input type="url" id="proj-github" name="github_url" class="form-input" placeholder="https://github.com/user/repo">
                        </div>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem;">
                        <button type="button" class="btn btn-outline modal-close">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>