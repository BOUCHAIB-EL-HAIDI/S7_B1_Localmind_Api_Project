@extends('layouts.app')

@section('title', 'Ask a Question - LocalMind')

@section('content')
<div class="bg-slate-50 min-h-[calc(100vh-64px)] py-12">
    <div class="max-w-2xl mx-auto px-4">
        <div class="mb-8">
            <a href="{{ route('questions.index') }}" class="inline-flex items-center text-slate-500 hover:text-indigo-600 transition-colors mb-4 group">
                <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Back to all questions
            </a>
            <h1 class="text-4xl font-extrabold text-slate-900 leading-tight">Ask your Community</h1>
            <p class="text-slate-500 mt-2">Get insights, advice, and answers from people right in your neighborhood.</p>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-12">
            <form action="{{ route('questions.store') }}" method="POST" class="space-y-8">
                @csrf
                
                <div class="space-y-2">
                    <label for="title" class="block text-sm font-bold text-slate-700 uppercase tracking-widest ml-1">Title</label>
                    <input type="text" name="title" id="title" required
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder-slate-400 text-slate-700 font-medium"
                        placeholder="What's your question? Be specific.">
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="location" class="block text-sm font-bold text-slate-700 uppercase tracking-widest ml-1">Location</label>
                    <input type="text" name="location" id="location" required
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder-slate-400 text-slate-700 font-medium"
                        placeholder="e.g. Downtown, North Side, Central Park">
                    @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="content" class="block text-sm font-bold text-slate-700 uppercase tracking-widest ml-1">Description</label>
                    <textarea name="content" id="content" rows="6" required
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-3xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder-slate-400 text-slate-700 font-medium lg:resize-none"
                        placeholder="Provide all the details someone would need to answer your question..."></textarea>
                    @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" 
                    class="w-full py-5 bg-indigo-600 text-white font-bold rounded-2xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:shadow-indigo-200 transition-all transform hover:-translate-y-1 active:translate-y-0">
                    Post Question
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
