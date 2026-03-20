@extends('layouts.app')

@section('title', 'About Us - LocalMind')

@section('content')
<div class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-extrabold text-slate-900 sm:text-5xl mb-4">Connecting Neighbors, <br/><span class="text-gradient">Sharing Knowledge.</span></h1>
            <p class="text-xl text-slate-500 max-w-3xl mx-auto">LocalMind was founded on a simple idea: the people living nearest to you are often your best source of information.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-24">
            <div>
                <h2 class="text-3xl font-bold text-slate-900 mb-6">Our Mission</h2>
                <p class="text-lg text-slate-600 mb-6 leading-relaxed">
                    We believe every community has a wealth of untapped knowledge. Whether it's finding the best hidden café, understanding local school choices, or getting help with a home repair, your neighbors have the answers.
                </p>
                <p class="text-lg text-slate-600 mb-6 leading-relaxed">
                    LocalMind provides the platform to make these connections happen seamlessly. We're building a world where neighborhood wisdom is just a question away.
                </p>
                <div class="flex space-x-4">
                    <div class="bg-indigo-50 border border-indigo-100 p-6 rounded-2xl flex-1">
                        <span class="block text-indigo-600 text-3xl font-bold mb-1">100%</span>
                        <span class="text-indigo-800 font-semibold">Community Driven</span>
                    </div>
                    <div class="bg-purple-50 border border-purple-100 p-6 rounded-2xl flex-1">
                        <span class="block text-purple-600 text-3xl font-bold mb-1">24/7</span>
                        <span class="text-purple-800 font-semibold">Supportive Network</span>
                    </div>
                </div>
            </div>
            <div class="bg-slate-100 rounded-3xl aspect-square flex items-center justify-center p-8 overflow-hidden relative">
                <div class="w-full h-full bg-indigo-200/50 rounded-2xl flex flex-col items-center justify-center space-y-4">
                    <div class="w-2/3 h-8 bg-indigo-300 rounded-full animate-pulse"></div>
                    <div class="w-1/2 h-8 bg-indigo-300/60 rounded-full animate-pulse"></div>
                    <div class="w-3/4 h-8 bg-indigo-300/40 rounded-full animate-pulse"></div>
                </div>
            </div>
        </div>

        <div class="bg-indigo-600 rounded-[3rem] p-12 lg:p-20 text-center text-white relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-3xl lg:text-5xl font-bold mb-8">Ready to join your local community?</h2>
                <p class="text-indigo-100 text-xl mb-12 max-w-2xl mx-auto">Create your account today and start asking questions or sharing what you know.</p>
                <a href="/register" class="inline-block px-10 py-5 bg-white text-indigo-600 font-bold rounded-2xl hover:bg-indigo-50 transition-all transform hover:-translate-y-1">
                    Get Started for Free
                </a>
            </div>
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-indigo-500 rounded-full opacity-20"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-indigo-700 rounded-full opacity-30"></div>
        </div>
    </div>
</div>
@endsection
