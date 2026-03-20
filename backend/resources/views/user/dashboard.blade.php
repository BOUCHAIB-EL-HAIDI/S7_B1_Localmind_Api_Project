@extends('layouts.app')

@section('title', 'My Dashboard - LocalMind')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-8">
            <div class="w-full md:w-80 shrink-0">
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 text-center sticky top-24">
                    <div class="w-24 h-24 bg-indigo-100 rounded-[2rem] mx-auto mb-6 flex items-center justify-center text-indigo-600 font-bold text-3xl">
                        SJ
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Sarah Jenkins</h2>
                    <p class="text-slate-500 text-sm mb-6">Expert in Downtown Area</p>
                    
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-slate-50 p-4 rounded-2xl">
                            <span class="block text-xl font-bold text-indigo-600">45</span>
                            <span class="text-[10px] uppercase font-bold text-slate-400">Questions</span>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-2xl">
                            <span class="block text-xl font-bold text-indigo-600">128</span>
                            <span class="text-[10px] uppercase font-bold text-slate-400">Reputation</span>
                        </div>
                    </div>

                    <div class="space-y-2 text-left">
                        <button class="w-full text-left px-4 py-3 bg-indigo-50 text-indigo-700 font-bold rounded-xl text-sm flex items-center">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Profile Overview
                        </button>
                        <button class="w-full text-left px-4 py-3 text-slate-600 hover:bg-slate-50 font-bold rounded-xl text-sm transition-all flex items-center">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            My Questions
                        </button>
                        <button class="w-full text-left px-4 py-3 text-slate-600 hover:bg-slate-50 font-bold rounded-xl text-sm transition-all flex items-center">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Settings
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex-grow space-y-8">
                <div class="bg-indigo-600 rounded-[2.5rem] p-10 text-white flex justify-between items-center shadow-xl shadow-indigo-100">
                    <div>
                        <h1 class="text-3xl font-bold mb-2 text-white">Hello, Sarah!</h1>
                        <p class="text-indigo-100">You have 3 new notifications today.</p>
                    </div>
                    <button class="bg-white text-indigo-600 font-bold px-6 py-3 rounded-2xl hover:bg-indigo-50 transition-all shadow-lg">Ask Question</button>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 min-h-[400px]">
                    <div class="flex items-center space-x-8 border-b border-slate-100 mb-8">
                        <button class="pb-4 text-indigo-600 font-bold border-b-2 border-indigo-600">Active Questions</button>
                        <button class="pb-4 text-slate-400 font-bold hover:text-slate-600 transition-colors">Contributions (12)</button>
                        <button class="pb-4 text-slate-400 font-bold hover:text-slate-600 transition-colors">Drafts</button>
                    </div>

                    <div class="space-y-6">
                        @for ($i = 0; $i < 3; $i++)
                        <div class="flex items-center justify-between p-6 bg-slate-50 rounded-[2rem] hover:bg-slate-100 transition-all cursor-pointer group">
                            <div class="flex-grow">
                                <h4 class="font-bold text-slate-900 mb-1 group-hover:text-indigo-600 transition-colors">Best place for organic vegetables?</h4>
                                <p class="text-sm text-slate-500">Posted in <span class="text-indigo-600">Lifestyle</span> • 3 days ago</p>
                            </div>
                            <div class="flex items-center space-x-6">
                                <div class="text-right">
                                    <span class="block font-bold text-slate-900 text-sm">8 Answers</span>
                                    <span class="text-[10px] text-green-500 font-bold uppercase tracking-widest">Active</span>
                                </div>
                                <div class="w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 group-hover:bg-white transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
