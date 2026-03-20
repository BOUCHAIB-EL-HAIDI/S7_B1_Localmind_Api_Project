@extends('layouts.app')

@section('title', 'Register - LocalMind')

@section('content')
<div class="min-h-[calc(100vh-64px)] flex flex-row-reverse">
    <div class="hidden lg:flex lg:w-1/2 bg-indigo-600 items-center justify-center p-12 overflow-hidden relative">
        <div class="absolute inset-0 z-0">
            <svg class="h-full w-full text-indigo-500 opacity-20" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                <circle cx="50" cy="50" r="40" />
            </svg>
        </div>
        <div class="relative z-10 text-white max-w-lg">
            <h1 class="text-5xl font-extrabold leading-tight mb-6">Build your <span class="text-indigo-200">local profile.</span></h1>
            <p class="text-xl text-indigo-100 mb-8">Join thousands of neighbors sharing knowledge and building a stronger community every day.</p>
            <div class="space-y-4">
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-indigo-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg">Personalized Feed</h4>
                        <p class="text-indigo-200">See questions and answers from your specific area.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-indigo-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg">Expert Badges</h4>
                        <p class="text-indigo-200">Gain reputation and badges for your helpful contributions.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-slate-900 mb-2">Create Account</h2>
                <p class="text-slate-500">Start your community experience today</p>
            </div>

            <form action="{{ route('auth.submitRegister') }}" method="POST" class="space-y-5">
               @csrf 
                <div class="w-full">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name')}}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400"
                            placeholder="John">
                    </div>
                    @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message  }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email')}}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400"
                        placeholder="john@example.com">
                     @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message  }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" 
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400"
                        placeholder="••••••••">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400"
                        placeholder="••••••••">
                        @error('password')
                      <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                      @enderror
                </div>

                <button type="submit" 
                    class="w-full py-4 bg-indigo-600 text-white font-bold rounded-xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all transform active:scale-[0.98]">
                    Create Account
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
