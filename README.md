# 💡 LocalMind - Community Q&A Platform

LocalMind is a modern, high-performance Community Q&A platform built with **Laravel 12** and **Vue.js 3**. It allows users to ask questions, provide specialized responses, and build a local knowledge base.

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Vue.js](https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vuedotjs&logoColor=4FC08D)](https://vuejs.org)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)

## ✨ Key Features

- **🔐 Robust Authentication**: Secure user registration and login powered by Laravel Sanctum.
- **❓ Question Management**: Create, update, and delete questions with tag support.
- **💬 Interactive Responses**: Real-time response system with the ability to mark solutions.
- **⭐ Favorites System**: Save your favorite questions for quick access.
- **👤 User Profiles**: Dedicated profiles showing user activity and contributions.
- **🎨 Premium UI**: Sleek, responsive design built with Tailwind CSS and Vue components.

## 🏗️ Technical Architecture

### Backend (Laravel 12)
- **API First**: RESTful API design with JSON responses.
- **Sanctum Auth**: Lightweight token-based authentication.
- **Eloquent ORM**: Elegant database interactions and relationships.
- **Automated Testing**: Feature tests for API endpoints.

### Frontend (Vue 3 + Vite)
- **Composition API**: Modern Vue 3 script setup.
- **Pinia**: Robust state management (Auth, Toast, etc.).
- **Vue Router**: Dynamic client-side routing.
- **Axios**: Promised-based HTTP client for API communication.

## 🚀 Getting Started

### Prerequisites
- PHP 8.2+
- Node.js & NPM
- Composer
- PostgreSQL

### Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/BOUCHAIB-EL-HAIDI/S7_B1_Localmind_Api_Project.git
   cd S7_B1_Localmind_Api_Project
   ```

2. **Backend Setup**
   ```bash
   cd backend
   composer install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate --seed
   php artisan serve
   ```

3. **Frontend Setup**
   ```bash
   cd ../frontend
   npm install
   npm run dev
   ```


