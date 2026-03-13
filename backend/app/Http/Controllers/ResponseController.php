<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $response = new Response();
        $response->content = $validated['content'];
        $response->user_id = Auth::id();
        $response->question_id = $question->id;
        $response->save();

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Your answer has been posted!',
                'response' => $response->load('user')
            ], 201);
        }

        return redirect()->route('questions.show', $question)->with('success', 'Your answer has been posted!');
    }

    public function edit(Response $response)
    {
        if (Auth::id() !== $response->user_id) {
            abort(403);
        }

        return view('responses.edit', compact('response'));
    }

    public function update(Request $request, Response $response)
    {
        if (Auth::id() !== $response->user_id) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            abort(403);
        }

        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $response->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Answer updated!',
                'response' => $response
            ]);
        }

        return redirect()->route('questions.show', $response->question_id)->with('success', 'Answer updated!');
    }

    public function destroy(Request $request, Response $response)
    {
        if (Auth::id() !== $response->user_id && Auth::user()->role !== 'admin') {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            abort(403);
        }

        $questionId = $response->question_id;
        $response->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Answer deleted.']);
        }

        return redirect()->route('questions.show', $questionId)->with('success', 'Answer deleted.');
    }

    public function markAsSolution(Request $request, Response $response)
    {
        $question = $response->question;

        if (Auth::id() !== $question->user_id) {
            return response()->json(['message' => 'Only the question owner can mark a solution.'], 403);
        }

        // Unmark previous solution if any
        Response::where('question_id', $question->id)->update(['is_solution' => false]);

        // Mark this response as solution
        $response->update(['is_solution' => true]);
        $question->update(['is_solved' => true]);

        return response()->json([
            'message' => 'Answer marked as solution!',
            'question' => $question->load('responses.user')
        ]);
    }

    public function userResponses()
    {
        return \App\Models\Response::where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->with('question:id,title')
            ->latest()
            ->get();
    }
}
