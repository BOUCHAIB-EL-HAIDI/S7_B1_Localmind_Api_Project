<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }

    public function profile()
    {
        $user = auth()->user();
        $questions = $user->questions()->latest()->take(5)->get();
        $favorites = $user->favorites()->with('question.user')->latest()->take(5)->get();
        
        return view('user.profile', compact('user', 'questions', 'favorites'));
    }

    public function adminDashboard()
    {
        $stats = [
            'total_questions' => \App\Models\Question::count(),
            'total_responses' => \App\Models\Response::count(),
            'total_users' => \App\Models\User::count(),
            'popular_question' => \App\Models\Question::withCount('responses')->orderBy('responses_count', 'desc')->first(),
        ];

        $recentQuestions = \App\Models\Question::with('user')->latest()->take(5)->get();
        $recentResponses = \App\Models\Response::with(['user', 'question'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentQuestions', 'recentResponses'));
    }

    public function question(){
        return view('questions.show');
    }
}
