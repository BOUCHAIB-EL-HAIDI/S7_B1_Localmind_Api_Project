# LocalMind - Community Q&A Platform

LocalMind is a community-driven web application where neighbors can help each other by asking and answering localized questions.

## 🚀 Features

### 🔐 Authentication & Roles
- **User Registration & Login**: Secure authentication for all users.
- **Roles**: Two roles implemented: `admin` and `user`.
- **Permissions**: Users can manage their own content; admins have full control over all questions and responses.

### 💬 Questions & Answers
- **Ask Questions**: Users can post questions with a title, content, and specific location.
- **Proximity Search**: Filter questions by keyword or location to find what's relevant to you.
- **Community Answers**: Anyone can provide helpful responses to community questions.
- **Full CRUD**: Users can edit or delete their own questions/answers.

### ⭐ Favorites
- **Save for Later**: Authenticated users can favorite questions to keep track of important discussions.
- **Personal List**: View all your favorited questions in a dedicated section.

### 📊 Admin Dashboard
- **Activity Overview**: Real-time statistics including total questions, answers, and members.
- **Content Management**: A central hub for admins to monitor and moderate all community interactions.

## 🛠️ Tech Stack
- **Framework**: Laravel (PHP)
- **Database**: PostgreSQL (Migrations & Eloquent ORM)
- **Styling**: Vanilla CSS with Tailwind Utility Classes (Modern UI)

## ⚙️ Installation

1. **Clone the repository**:
   ```bash
   git clone <repository_url>
   cd LocalMind
   ```

2. **Install dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment**:
   - Copy `.env.example` to `.env`.
   - Update database credentials and app key.
   ```bash
   php artisan key:generate
   ```

4. **Run Migrations & Seeders**:
   ```bash
   php artisan migrate --seed
   ```

5. **Start the server**:
   ```bash
   php artisan serve
   ```

## 📐 Architecture
The project follows the **MVC (Model-View-Controller)** pattern:
- **Models**: `User`, `Question`, `Response`, `Favorite`
- **Controllers**: `AuthController`, `QuestionController`, `ResponseController`, `FavoriteController`, `HomeController` (Admin Stats)
- **Views**: Blade templates with a responsive design and premium aesthetics.

---
*Developed as part of the Sprint 6 Brief.*
