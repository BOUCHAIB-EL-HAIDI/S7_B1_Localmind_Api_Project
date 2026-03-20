<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Request $request, Question $question)
    {
        $user = Auth::user();
        $favorite = Favorite::where('user_id', $user->id)
                            ->where('question_id', $question->id)
                            ->first();

        if ($favorite) {
            $favorite->delete();
            $message = 'Question removed from favorites.';
            $is_favorite = false;
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'question_id' => $question->id,
            ]);
            $message = 'Question added to favorites.';
            $is_favorite = true;
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => $message,
                'is_favorite' => $is_favorite
            ]);
        }

        return back()->with('success', $message);
    }

    public function index(Request $request)
    {
        $favorites = Favorite::with('question.user')
                             ->where('user_id', Auth::id())
                             ->latest()
                             ->paginate(10);
        
        if ($request->wantsJson()) {
            return response()->json($favorites);
        }

        return view('user.favorites', compact('favorites'));
    }
}
