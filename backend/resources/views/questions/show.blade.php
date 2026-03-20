@extends('layouts.app')

@section('title', 'Question Detail - LocalMind')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <article class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 mb-8 relative overflow-hidden">
            @auth
                <div class="absolute top-0 right-0 p-6 flex items-center space-x-2">
                    <form action="{{ route('favorites.toggle', $question) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-3 {{ $question->favorites->contains('user_id', auth()->id()) ? 'text-amber-500 bg-amber-50' : 'text-slate-400 hover:text-amber-500 hover:bg-amber-50' }} rounded-2xl transition-all" title="Add to Favorites">
                            @if($question->favorites->contains('user_id', auth()->id()))
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            @endif
                        </button>
                    </form>

                    @php
                        $isOwner = auth()->id() === $question->user_id;
                        $isAdmin = auth()->user()->role === 'admin';
                    @endphp

                    @if($isOwner || $isAdmin)
                        @if($isOwner)
                        <a href="{{ route('questions.edit', $question) }}" class="p-3 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-2xl transition-all" title="Edit Question">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </a>
                        @endif

                        <form action="{{ route('questions.destroy', $question) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-3 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-2xl transition-all" title="Delete Question" onclick="return confirm('Are you sure you want to delete this question?')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    @endif
                </div>
            @endauth

            <div class="flex items-center space-x-3 mb-6">
                <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-xs font-bold uppercase rounded-lg tracking-wider">{{ $question->location }}</span>
                <span class="text-slate-400 text-sm">Asked {{ $question->created_at->diffForHumans() }}</span>
            </div>

            <h1 class="text-3xl font-extrabold text-slate-900 mb-6 leading-tight">
                {{ $question->title }}
            </h1>

            <div class="prose prose-slate max-w-none text-slate-600 mb-8 leading-relaxed whitespace-pre-line">
                {{ $question->content }}
            </div>

            <div class="flex items-center justify-between border-t border-slate-50 pt-8">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                        {{ strtoupper(substr($question->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-bold text-slate-900">{{ $question->user->name }}</p>
                        <p class="text-slate-500 text-xs">Community Member</p>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <button class="flex items-center text-slate-400 hover:text-indigo-600 transition-colors group">
                        <svg class="w-5 h-5 mr-1 group-hover:fill-indigo-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        <span class="font-bold text-sm">{{ rand(10, 50) }}</span>
                    </button>
                    <button class="flex items-center text-slate-400 hover:text-indigo-600 transition-colors group">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                        <span class="font-bold text-sm">Share</span>
                    </button>
                </div>
            </div>
        </article>

        <div class="flex items-center justify-between mb-8 px-4">
            <h2 class="text-2xl font-bold text-slate-900">{{ $question->responses->count() }} Community Answers</h2>
            <div class="flex space-x-2">
                <button class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all">Most Helpful</button>
                @auth
                <a href="#answer-form" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 italic">Answer</a>
                @endauth
            </div>
        </div>

        <div class="space-y-6">
            @forelse($question->responses as $response)
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 transition-all hover:border-indigo-100 group">
                <div class="flex items-start justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600 font-bold">
                            {{ strtoupper(substr($response->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-bold text-slate-900">{{ $response->user->name }}</p>
                            <span class="text-slate-400 text-xs">Answered {{ $response->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    @auth
                        @if(auth()->id() === $response->user_id || auth()->user()->role === 'admin')
                        <div class="flex items-center space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
                            @if(auth()->id() === $response->user_id)
                            <a href="{{ route('responses.edit', $response) }}" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Edit Answer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            @endif
                            <form action="{{ route('responses.destroy', $response) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Delete Answer" onclick="return confirm('Are you sure you want to delete this answer?')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                        @endif
                    @endauth
                </div>
                <div class="text-slate-600 leading-relaxed mb-6 whitespace-pre-line">
                    {{ $response->content }}
                </div>
                <div class="flex items-center space-x-4">
                    <button class="flex items-center px-4 py-2 bg-slate-50 rounded-xl text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-all group font-bold text-xs uppercase tracking-widest">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                        Helpful ({{ rand(1, 15) }})
                    </button>
                    <button class="text-slate-400 hover:text-slate-600 transition-colors font-bold text-xs uppercase tracking-widest">Reply</button>
                </div>
            </div>
            @empty
            <div class="bg-white p-12 rounded-[2.5rem] text-center border border-slate-100 shadow-sm text-slate-500 italic">
                No answers yet. Share your knowledge!
            </div>
            @endforelse
        </div>

        @auth
        <div id="answer-form" class="mt-12 bg-indigo-600 rounded-[3rem] p-10 text-white shadow-2xl shadow-indigo-100">
            <h2 class="text-2xl font-bold mb-6">Your Answer</h2>
            <form action="{{ route('responses.store', $question) }}" method="POST">
                @csrf
                <textarea 
                    name="content" required
                    class="w-full h-40 bg-white/10 border border-white/20 rounded-2xl p-6 text-white placeholder-indigo-200 outline-none focus:ring-2 focus:ring-white/50 transition-all mb-4"
                    placeholder="Write your advice here...">{{ old('content') }}</textarea>
                @error('content') <p class="text-red-200 text-xs mb-4">{{ $message }}</p> @enderror
                <div class="flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-white text-indigo-600 font-bold rounded-2xl hover:bg-indigo-50 transition-all transform hover:-translate-y-1">
                        Post Answer
                    </button>
                </div>
            </form>
        </div>
        @else
        <div class="mt-12 bg-slate-100 rounded-[3rem] p-10 text-center text-slate-600">
            <p class="text-xl mb-6 font-medium">Want to help? Log in to share your answer!</p>
            <a href="{{ route('login') }}" class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-all">Go to Login</a>
        </div>
        @endauth
    </div>
</div>
@endsection
