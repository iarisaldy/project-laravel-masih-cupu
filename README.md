# 🚀 Revamped Personal Web Profile & Portfolio CMS

[![Laravel Version](https://img.shields.io/badge/Laravel-v8.83.27-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-v7.4%20%7C%20v8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Docker](https://img.shields.io/badge/Docker-Containerized-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://docker.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)
[![Status](https://img.shields.io/badge/Status-Revamped-brightgreen?style=for-the-badge)](#)

> A modern, high-performance personal web profile & interactive portfolio CMS built with **Laravel 8**, featuring dark/light glassmorphism design, real-time project filtering, interactive API endpoints, and a full-featured admin management dashboard.

---

## 🌟 Key Features

- 🎨 **Modern Glassmorphism UI**: Engineered with custom CSS variables, dark/light theme toggling, sleek micro-animations, and responsive typography.
- 💼 **Interactive Portfolio & Filtering**: Instant client-side filtering across Full Stack, QA Automation, AI Tools, and Cloud project categories.
- ⚡ **Skills Matrix**: Dynamic skills presentation grouped by Frontend, Backend, and DevOps/QA with progress indicators.
- 🔒 **Admin CMS Dashboard**: Manage showcase projects dynamically via a dedicated administration control panel.
- ✉️ **Contact API Integration**: Async AJAX contact submission with validation and instant status feedback.
- 🐳 **Dockerized Deployment**: Complete `Dockerfile` and `docker-compose.yml` configuration for zero-setup containerized runtime.

---

## 🛠️ Tech Stack & Architecture

- **Backend**: PHP 7.4 / 8.x, Laravel 8 Framework, Blade Templating
- **Frontend**: Vanilla CSS (Custom Design System & CSS Tokens), Modern JavaScript (ES6+), Google Fonts (Inter)
- **Containerization & Server**: Docker, Docker Compose, PHP-FPM, Nginx
- **API Standards**: RESTful JSON responses, Laravel CSRF Protection, Form Validation

---

## 🚀 Quick Start Guide

### Option 1: Local Development (Artisan)

1. **Clone repository**:
   ```bash
   git clone https://github.com/iarisaldy/project-laravel-masih-cupu.git
   cd project-laravel-masih-cupu
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Environment Setup**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Serve Application**:
   ```bash
   php artisan serve
   ```
   Open `http://127.0.0.1:8000` in your browser.

---

### Option 2: Docker Compose

Start the entire environment in containerized mode:

```bash
docker-compose up -d --build
```
Access the application at `http://localhost:8000`.

---

## 🌐 Application Routes

| Method | Route | Name | Description |
| :--- | :--- | :--- | :--- |
| `GET` | `/` | `home` | Main Personal Portfolio & Web Profile Page |
| `GET` | `/admin` | `admin` | Admin Management Dashboard |
| `POST` | `/api/contact` | `api.contact` | Submit Contact Form Endpoint |
| `POST` | `/api/projects` | `api.projects.store` | Add Project API Endpoint |

---

## 📂 Directory Overview

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── ProfileController.php    # Portfolio data & Contact API logic
│   │   │   └── AdminController.php      # Admin CMS logic & project creation
├── public/
│   ├── css/
│   │   └── style.css                    # Glassmorphism design tokens & styles
├── resources/
│   └── views/
│       ├── home.blade.php               # Public Portfolio Frontend
│       └── admin.blade.php              # Admin Dashboard Frontend
├── routes/
│   └── web.php                          # Application Routes
├── docker-compose.yml                   # Docker orchestration config
└── Dockerfile                           # PHP-FPM / Laravel Docker image
```

---

## 📜 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
