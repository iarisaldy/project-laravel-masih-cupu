<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Personal Web Profile & Portfolio of Muhammad Irfan - Senior Full Stack & Software Engineer. Explore projects, tech stack, and experience.">
    <title>{{ $profile['name'] ?? 'Muhammad Irfan' }} | Personal Web Profile & Portfolio</title>
    
    <!-- Google Fonts & Stylesheets -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container navbar-container">
            <a href="/" class="logo">
                <span class="gradient-text">IRFAN</span>.DEV
                <span class="logo-badge">PORTFOLIO</span>
            </a>

            <ul class="nav-links">
                <li><a href="#about" class="nav-link">About</a></li>
                <li><a href="#skills" class="nav-link">Skills</a></li>
                <li><a href="#projects" class="nav-link">Projects</a></li>
                <li><a href="#experience" class="nav-link">Experience</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
            </ul>

            <div class="nav-actions">
                <button id="theme-toggle-btn" class="theme-toggle" aria-label="Toggle Theme">☀️</button>
                <a href="/admin" class="btn btn-outline btn-sm">🔒 Admin Dashboard</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="about" class="hero">
        <div class="hero-glow"></div>
        <div class="container hero-content">
            <div class="status-badge">
                <span class="status-pulse"></span>
                {{ $profile['status'] ?? 'Available for new opportunities' }}
            </div>

            <h1 class="hero-title">
                Building scalable web systems & <br>
                <span class="gradient-text">extraordinary digital experiences.</span>
            </h1>

            <p class="hero-subtitle">
                Hi, I'm <strong>{{ $profile['name'] }}</strong> — {{ $profile['bio'] }}
            </p>

            <div class="hero-buttons">
                <a href="#projects" class="btn btn-primary">🚀 Explore Projects</a>
                <a href="#contact" class="btn btn-outline">✉️ Get in Touch</a>
                <a href="/admin" class="btn btn-outline" style="border-color: var(--accent-secondary); color: var(--accent-secondary);">⚙️ Admin CMS Demo</a>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ $profile['experience_years'] }}</div>
                    <div class="stat-label">Years Experience</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $profile['projects_completed'] }}</div>
                    <div class="stat-label">Projects Completed</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $profile['satisfied_clients'] }}</div>
                    <div class="stat-label">Happy Clients</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $profile['contributions'] }}</div>
                    <div class="stat-label">Git Contributions</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Tech Stack & Expertise</span>
                <h2 class="section-title">Capabilities & Skills Matrix</h2>
                <p class="section-desc">Constantly mastering cutting-edge frameworks, backend architectures, and quality engineering tools.</p>
            </div>

            <div class="skills-grid">
                @foreach($skills as $group)
                <div class="skill-category-card">
                    <div class="category-icon">{{ $group['icon'] }}</div>
                    <h3 class="category-title">{{ $group['category'] }}</h3>

                    <div class="skill-list">
                        @foreach($group['items'] as $skill)
                        <div class="skill-item">
                            <div class="skill-info">
                                <span class="skill-name">{{ $skill['name'] }}</span>
                                <span class="skill-pct">{{ $skill['level'] }}%</span>
                            </div>
                            <div class="progress-bar-bg">
                                <div class="progress-bar-fill" style="width: {{ $skill['level'] }}%;"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Portfolio Projects Section -->
    <section id="projects" class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Selected Showcase</span>
                <h2 class="section-title">Featured Projects & Systems</h2>
                <p class="section-desc">A collection of full-stack web apps, automation frameworks, and cloud solutions built for performance.</p>
            </div>

            <div class="portfolio-filter">
                <button class="filter-btn active" data-filter="all">All Projects</button>
                <button class="filter-btn" data-filter="fullstack">Full Stack</button>
                <button class="filter-btn" data-filter="qa">QA & Automation</button>
                <button class="filter-btn" data-filter="ai">AI Tools</button>
                <button class="filter-btn" data-filter="cloud">Cloud / API</button>
            </div>

            <div class="projects-grid">
                @foreach($projects as $proj)
                <div class="project-card" data-category="{{ $proj['category'] }}">
                    <div class="project-img-wrapper">
                        <img src="{{ $proj['image'] }}" alt="{{ $proj['title'] }}" loading="lazy">
                        <span class="project-badge">{{ strtoupper($proj['category']) }}</span>
                    </div>

                    <div class="project-content">
                        <h3 class="project-title">{{ $proj['title'] }}</h3>
                        <p class="project-desc">{{ $proj['description'] }}</p>

                        <div class="tech-tags">
                            @foreach($proj['tags'] as $tag)
                            <span class="tech-tag">{{ $tag }}</span>
                            @endforeach
                        </div>

                        <div class="project-links">
                            <a href="{{ $proj['demo'] }}" target="_blank" class="btn btn-primary btn-sm" style="flex: 1;">🌐 Live Demo</a>
                            <a href="{{ $proj['github'] }}" target="_blank" class="btn btn-outline btn-sm" style="flex: 1;">💻 Source Code</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Experience Timeline Section -->
    <section id="experience" class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Career Journey</span>
                <h2 class="section-title">Work & Leadership Experience</h2>
                <p class="section-desc">Track record of building enterprise products and scaling engineering practices.</p>
            </div>

            <div class="timeline">
                @foreach($experiences as $exp)
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date">{{ $exp['period'] }}</div>
                        <h3 class="timeline-role">{{ $exp['role'] }}</h3>
                        <div class="timeline-company">{{ $exp['company'] }}</div>
                        <p style="color: var(--text-secondary); font-size: 0.92rem;">{{ $exp['description'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Let's Connect</span>
                <h2 class="section-title">Start a Project or Chat</h2>
                <p class="section-desc">Have an upcoming project, hiring opportunity, or technical question? Feel free to reach out!</p>
            </div>

            <div class="contact-container">
                <div class="contact-card">
                    <h3 style="font-size: 1.4rem; font-weight: 700; margin-bottom: 1rem;">Contact Information</h3>
                    <p style="color: var(--text-secondary); margin-bottom: 1.8rem; font-size: 0.95rem;">
                        I'm open to freelance work, consulting, full-time engineering roles, and open-source contributions.
                    </p>

                    <div style="display: flex; flex-direction: column; gap: 1.2rem;">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 42px; height: 42px; border-radius: var(--radius-md); background: rgba(99, 102, 241, 0.1); color: var(--accent-primary); display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">📧</div>
                            <div>
                                <div style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600;">EMAIL ME</div>
                                <a href="mailto:irfan@example.com" style="color: var(--text-primary); font-weight: 600; text-decoration: none;">irfan@example.com</a>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 42px; height: 42px; border-radius: var(--radius-md); background: rgba(16, 185, 129, 0.1); color: var(--accent-emerald); display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">📍</div>
                            <div>
                                <div style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600;">LOCATION</div>
                                <div style="color: var(--text-primary); font-weight: 600;">Indonesia & Remote Worldwide</div>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 42px; height: 42px; border-radius: var(--radius-md); background: rgba(6, 182, 212, 0.1); color: var(--accent-cyan); display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">⚡</div>
                            <div>
                                <div style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600;">RESPONSE TIME</div>
                                <div style="color: var(--text-primary); font-weight: 600;">Within 24 Hours</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contact-card">
                    <form id="contact-form">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="contact-name">Your Name</label>
                            <input type="text" id="contact-name" name="name" class="form-input" placeholder="e.g. Alex Morgan" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="contact-email">Your Email</label>
                            <input type="email" id="contact-email" name="email" class="form-input" placeholder="alex@company.com" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="contact-subject">Subject</label>
                            <input type="text" id="contact-subject" name="subject" class="form-input" placeholder="Project Inquiry / Job Opportunity" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="contact-message">Message</label>
                            <textarea id="contact-message" name="message" class="form-textarea" placeholder="Tell me about your project or inquiry..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            ✉️ Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-socials">
                <a href="https://github.com/iarisaldy" target="_blank" class="social-icon" aria-label="GitHub">💻</a>
                <a href="https://linkedin.com" target="_blank" class="social-icon" aria-label="LinkedIn">💼</a>
                <a href="https://twitter.com" target="_blank" class="social-icon" aria-label="Twitter">🐦</a>
            </div>
            <p>&copy; {{ date('Y') }} <strong>Muhammad Irfan</strong>. Revamped from starter project to Modern Portfolio.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>