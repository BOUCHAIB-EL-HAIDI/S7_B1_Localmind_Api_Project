@extends('layouts.app')

@section('title', 'My Profile - LocalMind')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-8">
            <div class="w-full md:w-80 shrink-0">
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 text-center sticky top-24">
                    <div class="w-24 h-24 bg-indigo-600 rounded-[2rem] mx-auto mb-6 flex items-center justify-center text-white font-bold text-3xl">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">{{ $user->name }}</h2>
                    <p class="text-slate-500 text-sm mb-6 capitalize">{{ $user->role }} Member</p>
                    
                    <div class="bg-slate-50 p-4 rounded-2xl mb-8">
                        <span class="block text-sm font-bold text-slate-400 uppercase tracking-widest mb-1">Email</span>
                        <span class="text-slate-700 font-medium">{{ $user->email }}</span>
                    </div>

                    <div class="space-y-2 text-left">
                        <a href="{{ route('questions.create') }}" class="w-full text-center block px-4 py-3 bg-indigo-600 text-white font-bold rounded-xl text-sm transition-all hover:bg-indigo-700">
                            Ask a Question
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex-grow space-y-8">
                <!-- My Questions -->
                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xl font-bold text-slate-900">My Recent Questions</h3>
                        <span class="bg-indigo-50 text-indigo-600 text-xs font-bold px-3 py-1 rounded-full">{{ $questions->count() }} Posted</span>
                    </div>

                    <div class="space-y-4">
                        @forelse ($questions as $question)
                        <div class="p-6 bg-slate-50 rounded-[2rem] hover:bg-slate-100 transition-all group">
                            <div class="flex items-center justify-between">
                                <div class="flex-grow">
                                    <a href="{{ route('questions.show', $question) }}" class="block">
                                        <h4 class="font-bold text-slate-900 mb-1 group-hover:text-indigo-600 transition-colors">{{ $question->title }}</h4>
                                        <p class="text-sm text-slate-500 line-clamp-1">{{ $question->content }}</p>
                                    </a>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('questions.edit', $question) }}" class="p-2 text-slate-400 hover:text-indigo-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('questions.destroy', $question) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this question?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12 text-slate-400 italic">
                            You haven't posted any questions yet.
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- My Favorites -->
                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xl font-bold text-slate-900">Bookmarked Questions</h3>
                        <a href="{{ route('favorites.index') }}" class="text-indigo-600 text-sm font-bold hover:underline">View All</a>
                    </div>

                    <div class="space-y-4">
                        @forelse ($favorites as $favorite)
                        <div class="p-6 bg-slate-50 rounded-[2rem] hover:bg-slate-100 transition-all">
                            <a href="{{ route('questions.show', $favorite->question) }}" class="flex items-center justify-between">
                                <div class="flex-grow">
                                    <h4 class="font-bold text-slate-900 mb-1 line-clamp-1">{{ $favorite->question->title }}</h4>
                                    <p class="text-sm text-slate-500 italic">by {{ $favorite->question->user->name }}</p>
                                </div>
                                <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path></svg>
                            </a>
                        </div>
                        @empty
                        <div class="text-center py-12 text-slate-400 italic">
                            Your bookmarked items will appear here.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
