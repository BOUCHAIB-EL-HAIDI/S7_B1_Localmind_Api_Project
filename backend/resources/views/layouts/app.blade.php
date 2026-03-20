<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LocalMind - Community Q&A')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .text-gradient {
            background: linear-gradient(to right, #4f46e5, #9333ea);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-gray-50 text-slate-900 min-h-screen flex flex-col">
    <nav class="sticky top-0 z-50 glass border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex-shrink-0 flex items-center group">
                        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-200 group-hover:rotate-6 transition-transform">
                            L
                        </div>
                        <span class="ml-3 text-2xl font-bold text-slate-900">Local<span class="text-indigo-600">Mind</span></span>
                    </a>
                    <div class="hidden sm:ml-10 sm:flex sm:space-x-8">
                        <a href="/" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-indigo-300 transition-all">Home</a>
                        <a href="/questions" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-indigo-300 transition-all">Questions</a>
                        @auth
                            <a href="{{ route('favorites.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-indigo-300 transition-all">Favorites</a>
                        @endauth
                        <a href="/about" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-indigo-300 transition-all">About</a>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center sm:space-x-4">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Admin Dashboard</a>
                        @endif
                        <a href="{{ route('user.profile') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Profile</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-5 py-2.5 bg-slate-100 text-slate-600 text-sm font-semibold rounded-full hover:bg-slate-200 transition-all transform active:scale-95">Log out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Log in</a>
                        <a href="{{ route('register') }}" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-full shadow-md shadow-indigo-100 hover:bg-indigo-700 hover:shadow-lg transition-all transform active:scale-95">Sign up</a>
                    @endauth
                </div>
                <div class="flex items-center sm:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-gray-100 focus:outline-none" aria-expanded="false">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-6">
            <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl flex items-center justify-between shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-400 hover:text-green-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
        @endif
        @yield('content')
    </main>

    <footer class="bg-slate-900 text-white mt-auto">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center text-white font-bold text-lg">
                            L
                        </div>
                        <span class="ml-2 text-xl font-bold">LocalMind</span>
                    </div>
                    <p class="mt-4 text-slate-400 max-w-xs">
                        Connecting your local community through knowledge sharing. Ask questions, get answers from neighbors.
                    </p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-300">Quick Links</h3>
                    <ul class="mt-4 space-y-4">
                        <li><a href="/" class="text-slate-400 hover:text-white transition-colors">Home</a></li>
                        <li><a href="/questions" class="text-slate-400 hover:text-white transition-colors">Browse Questions</a></li>
                        <li><a href="/about" class="text-slate-400 hover:text-white transition-colors">About Us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-300">Legal</h3>
                    <ul class="mt-4 space-y-4">
                        <li><a href="#" class="text-slate-400 hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-white transition-colors">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 border-t border-slate-800 pt-8 flex justify-between items-center">
                <p class="text-slate-400 text-sm">&copy; {{ date('Y') }} LocalMind. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
