<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::with(['user', 'favorites'])->withCount('responses');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($request->filled('location')) {
            $location = $request->input('location');
            $query->where('location', 'like', "%{$location}%");
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $questions = $query->latest()->paginate(10);

        if ($request->wantsJson()) {
            return response()->json($questions);
        }

        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'location' => 'required|string|max:255',
        ]);

        $question = new Question($validated);
        $question->user_id = Auth::id();
        $question->save();

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Question posted successfully!',
                'question' => $question->load('user')
            ], 201);
        }

        return redirect()->route('questions.index')->with('success', 'Question posted successfully!');
    }

    public function show(Request $request, Question $question)
    {
        $question->load(['user', 'responses.user', 'favorites']);
        
        if ($request->wantsJson()) {
            return response()->json($question);
        }

        return view('questions.show', compact('question'));
    }

    public function edit(Question $question)
    {
        if (Auth::id() !== $question->user_id) {
            abort(403, 'You can only edit your own questions.');
        }
        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        if (Auth::id() !== $question->user_id) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            abort(403, 'You can only update your own questions.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'location' => 'required|string|max:255',
        ]);

        $question->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Question updated successfully!',
                'question' => $question
            ]);
        }

        return redirect()->route('questions.show', $question)->with('success', 'Question updated successfully!');
    }

    public function destroy(Request $request, Question $question)
    {
        if (Auth::id() !== $question->user_id && Auth::user()->role !== 'admin') {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            abort(403);
        }

        $question->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Question deleted successfully!']);
        }

        return redirect()->route('questions.index')->with('success', 'Question deleted successfully!');
    }

    public function userQuestions()
    {
        return Question::where('user_id', Auth::id())->latest()->get();
    }
}
