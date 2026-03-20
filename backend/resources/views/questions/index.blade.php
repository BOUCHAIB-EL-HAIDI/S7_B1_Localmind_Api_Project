@extends('layouts.app')

@section('title', 'Browse Questions - LocalMind')

@section('content')
<div class="bg-slate-50 min-h-screen py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-slate-900 mb-6">Explore <span class="text-indigo-600">Questions</span></h1>
            <form action="{{ route('questions.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-6 relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for questions or topics..." 
                        class="w-full pl-14 pr-4 py-4 bg-white rounded-2xl shadow-sm border-none focus:ring-2 focus:ring-indigo-500 text-lg outline-none transition-all placeholder:text-slate-400">
                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
                <div class="md:col-span-4 relative">
                    <input type="text" name="location" value="{{ request('location') }}" placeholder="Location..." 
                        class="w-full pl-14 pr-4 py-4 bg-white rounded-2xl shadow-sm border-none focus:ring-2 focus:ring-indigo-500 text-lg outline-none transition-all placeholder:text-slate-400">
                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="w-full h-full px-6 py-4 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-100">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <div class="flex-grow space-y-4">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="font-bold text-slate-700 uppercase tracking-wider text-sm">Recent Questions</h2>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-600 hover:bg-slate-50">Newest</button>
                        <button class="px-3 py-1 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-600 hover:bg-slate-50">Popular</button>
                    </div>
                </div>

                @forelse($questions as $question)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:border-indigo-200 transition-all cursor-pointer group relative">
                    <a href="{{ route('questions.show', $question) }}" class="absolute inset-0 z-0"></a>
                    <div class="flex items-start justify-between relative z-10 pointer-events-none">
                        <div class="flex-grow">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 text-[10px] font-bold uppercase rounded-md tracking-wider">{{ $question->location }}</span>
                                <span class="text-slate-400 text-xs">• {{ $question->created_at->diffForHumans() }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-indigo-600 transition-colors">{{ $question->title }}</h3>
                            <p class="text-slate-500 line-clamp-2">{{ Str::limit($question->content, 150) }}</p>
                        </div>
                        <div class="ml-4 text-center px-4 py-2 bg-slate-50 rounded-xl min-w-[80px]">
                            <span class="block text-xl font-bold text-slate-900">{{ $question->responses_count }}</span>
                            <span class="text-slate-500 text-[10px] uppercase font-bold tracking-widest">Answers</span>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-between border-t border-slate-50 pt-4 relative z-10">
                        <div class="flex items-center space-x-2">
                            <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-[10px] font-bold">
                                {{ strtoupper(substr($question->user->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-medium text-slate-600">{{ $question->user->name }}</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            @auth
                                <form action="{{ route('favorites.toggle', $question) }}" method="POST" class="inline pointer-events-auto">
                                    @csrf
                                    <button type="submit" class="p-2 {{ $question->favorites->contains('user_id', auth()->id()) ? 'text-amber-500 bg-amber-50' : 'text-slate-400 hover:text-amber-500 hover:bg-amber-50' }} rounded-lg transition-all" title="Add to Favorites">
                                        @if($question->favorites->contains('user_id', auth()->id()))
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                        @endif
                                    </button>
                                </form>

                                @php
                                    $isOwner = auth()->id() === $question->user_id;
                                    $isAdmin = auth()->user()->role === 'admin';
                                @endphp

                                @if($isOwner || $isAdmin)
                                <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-auto">
                                    @if($isOwner)
                                    <a href="{{ route('questions.edit', $question) }}" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Edit Question">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    @endif
                                    
                                    <form action="{{ route('questions.destroy', $question) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Delete Question" onclick="return confirm('Are you sure you want to delete this question?')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                                @endif
                            @endauth
                            <span class="flex items-center text-slate-400 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> 
                                {{ count($question->responses) }}
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white p-12 rounded-3xl text-center border border-slate-100 shadow-sm">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">No questions yet</h3>
                    <p class="text-slate-500 mb-8">Be the first to ask something to your community!</p>
                    <a href="{{ route('questions.create') }}" class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-all">Ask a Question</a>
                </div>
                @endforelse

                <div class="mt-8">
                    {{ $questions->links() }}
                </div>
            </div>

            <div class="w-full lg:w-72 space-y-6">
                <div class="bg-indigo-600 p-8 rounded-3xl text-white shadow-xl shadow-indigo-100">
                    <h4 class="font-bold text-xl mb-3">Ask a Question</h4>
                    <p class="text-indigo-100 text-sm mb-6">Need help with something local? Our community is here for you.</p>
                    @auth
                        <a href="{{ route('questions.create') }}" class="block w-full text-center py-3 bg-white text-indigo-600 font-bold rounded-xl hover:bg-indigo-50 transition-colors">Post Now</a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center py-3 bg-white text-indigo-600 font-bold rounded-xl hover:bg-indigo-50 transition-colors">Login to Post</a>
                    @endauth
                </div>

                <div class="bg-white p-6 rounded-3xl border border-slate-100">
                    <h4 class="font-bold text-slate-900 mb-4 uppercase tracking-wider text-xs">Trending Topics</h4>
                    <div class="flex flex-wrap gap-2">
                        <button class="px-3 py-1.5 bg-slate-50 text-slate-600 text-xs font-bold rounded-lg hover:bg-slate-100 transition-colors">#Events</button>
                        <button class="px-3 py-1.5 bg-slate-50 text-slate-600 text-xs font-bold rounded-lg hover:bg-slate-100 transition-colors">#Foodie</button>
                        <button class="px-3 py-1.5 bg-slate-50 text-slate-600 text-xs font-bold rounded-lg hover:bg-slate-100 transition-colors">#Nightlife</button>
                        <button class="px-3 py-1.5 bg-slate-50 text-slate-600 text-xs font-bold rounded-lg hover:bg-slate-100 transition-colors">#Safety</button>
                        <button class="px-3 py-1.5 bg-slate-50 text-slate-600 text-xs font-bold rounded-lg hover:bg-slate-100 transition-colors">#Business</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
