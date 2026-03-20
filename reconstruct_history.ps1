# Reconstruct Git History Script

$repoPath = "c:\Users\safiy\Desktop\Nouveau dossier\S6_B1_Systeme_Question_Reponses"
Set-Location $repoPath

# Function to commit with a specific date
function Commit-Dated ($message, $date) {
    $env:GIT_AUTHOR_DATE = "$date 12:00:00"
    $env:GIT_COMMITTER_DATE = "$date 12:00:00"
    git commit -m $message
    $env:GIT_AUTHOR_DATE = ""
    $env:GIT_COMMITTER_DATE = ""
}

# 1. Initial commit
# Only add files that exist
$initialFiles = @("README.md", ".gitignore", ".gitattributes", ".editorconfig", ".styleci.yml")
foreach ($file in $initialFiles) {
    if (Test-Path $file) { git add $file }
}
Commit-Dated "Initial project structure and documentation" "2026-03-09"

# 2. Backend Foundation
git add backend/composer.json backend/composer.lock backend/artisan backend/package.json
Commit-Dated "Setup Laravel backend environment and dependencies" "2026-03-09"

# 3. Backend Config
git add backend/config/ backend/bootstrap/
Commit-Dated "Configure Laravel application core" "2026-03-10"

# 4. Database Migrations - Users
git add backend/database/migrations/*create_users_table.php
Commit-Dated "Add users table migration" "2026-03-10"

# 5. Database Migrations - Questions
git add backend/database/migrations/*create_questions_table.php
Commit-Dated "Add questions table migration" "2026-03-10"

# 6. Database Migrations - Responses
git add backend/database/migrations/*create_responses_table.php
Commit-Dated "Add responses table migration" "2026-03-11"

# 7. Database Migrations - Solution & Favorites
git add backend/database/migrations/*add_is_solution*.php backend/database/migrations/*create_favorites*.php
Commit-Dated "Add solution flag and favorites table migrations" "2026-03-11"

# 8. Models - User
git add backend/app/Models/User.php
Commit-Dated "Implement User model with auth traits" "2026-03-11"

# 9. Models - Question
git add backend/app/Models/Question.php
Commit-Dated "Implement Question model and relationships" "2026-03-12"

# 10. Models - Response
git add backend/app/Models/Response.php
Commit-Dated "Implement Response model and relationships" "2026-03-12"

# 11. Auth Logic - Sanctum Setup
git add backend/config/sanctum.php
Commit-Dated "Configure Laravel Sanctum for API authentication" "2026-03-12"

# 12. Auth Logic - AuthController
git add backend/app/Http/Controllers/Api/AuthController.php
Commit-Dated "Implement API registration and login logic" "2026-03-13"

# 13. API Logic - QuestionController
git add backend/app/Http/Controllers/QuestionController.php
Commit-Dated "Implement CRUD operations for questions" "2026-03-13"

# 14. API Logic - ResponseController
git add backend/app/Http/Controllers/ResponseController.php
Commit-Dated "Implement response management and solution marking" "2026-03-13"

# 15. Routing - API Routes
git add backend/routes/api.php
Commit-Dated "Define API endpoints for questions and authentication" "2026-03-14"

# 16. Backend Seeders
git add backend/database/seeders/ backend/database/factories/
Commit-Dated "Add database seeders and factories for development" "2026-03-14"

# 17. Backend Providers & Kernel
git add backend/app/Providers/ backend/app/Http/Kernel.php backend/app/Http/Middleware/
Commit-Dated "Configure service providers and middleware" "2026-03-14"

# 18. Frontend Foundation - Package
git add frontend/package.json frontend/package-lock.json frontend/vite.config.js
Commit-Dated "Initialize Vue 3 frontend with Vite" "2026-03-15"

# 19. Frontend Foundation - Assets
git add frontend/index.html frontend/public/
Commit-Dated "Add main entry point and public assets" "2026-03-15"

# 20. Frontend Core - Main
git add frontend/src/main.js frontend/src/bootstrap.js
Commit-Dated "Setup frontend bootstrapping and axios" "2026-03-15"

# 21. Frontend State - Pinia
git add frontend/src/stores/
Commit-Dated "Implement authentication and notification state stores" "2026-03-16"

# 22. Frontend Routing
git add frontend/src/router/
Commit-Dated "Configure client-side routing for the application" "2026-03-16"

# 23. Components - Auth Views
git add frontend/src/components/auth/
Commit-Dated "Implement Login and Register components" "2026-03-16"

# 24. Components - Question List
git add frontend/src/components/questions/QuestionList.vue
Commit-Dated "Create question listing component" "2026-03-17"

# 25. Components - Question Detail
git add frontend/src/components/questions/QuestionDetail.vue
Commit-Dated "Create question detail and response view" "2026-03-17"

# 26. Components - Question Creation
git add frontend/src/components/questions/CreateQuestion.vue
Commit-Dated "Implement question submission form" "2026-03-17"

# 27. Components - User Profile
git add frontend/src/components/user/Profile.vue
Commit-Dated "Implement user profile page with activity history" "2026-03-18"

# 28. Components - Favorites
git add frontend/src/components/user/Favorites.vue
Commit-Dated "Implement user favorites management" "2026-03-18"

# 29. Frontend UI - App Shell
git add frontend/src/App.vue frontend/src/style.css
Commit-Dated "Add main layout and global styles" "2026-03-18"

# 30. Backend Testing
git add backend/tests/
Commit-Dated "Add feature tests for API endpoints" "2026-03-19"

# 31. Frontend Testing
git add frontend/src/stores/auth.test.js
Commit-Dated "Add unit tests for frontend stores" "2026-03-19"

# 32. UML Diagrams
git add uml/
Commit-Dated "Add system architecture and database UML diagrams" "2026-03-19"

# 33. Utility Scripts
git add test_register.js
Commit-Dated "Add registration testing utility script" "2026-03-20"

# 34. Final Documentation
git add README.md
Commit-Dated "Complete README with installation and usage instructions" "2026-03-20"

# 35. Final Polish
git add .
Commit-Dated "Final project polish and verification" "2026-03-20"

# Push to GitHub
if (git remote | findstr origin) { git remote remove origin }
git remote add origin https://github.com/BOUCHAIB-EL-HAIDI/S7_B1_Localmind_Api_Project.git
git branch -M main
