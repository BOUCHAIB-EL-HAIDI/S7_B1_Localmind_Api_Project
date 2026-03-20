@extends('layouts.app')

@section('title', 'LocalMind - Empowering Communities Through Knowledge')

@section('content')
<section class="relative bg-white pt-20 pb-32 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center">
            <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                <span class="inline-block px-4 py-1.5 mb-6 text-sm font-semibold tracking-wide text-indigo-600 bg-indigo-50 rounded-full">
                    Now available in your city
                </span>
                <h1 class="text-5xl font-extrabold tracking-tight text-slate-900 sm:text-6xl lg:text-7xl mb-6">
                    Your local experts, <br/>
                    <span class="text-gradient">one click away.</span>
                </h1>
                <p class="text-xl text-slate-500 mb-10 leading-relaxed">
                    LocalMind is the community-driven platform where neighbors help neighbors. Ask anything about your city, find the best local spots, or share your own expertise.
                </p>
                <div class="flex flex-col sm:flex-row sm:justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="/register" class="px-8 py-4 bg-indigo-600 text-white font-bold rounded-2xl shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-1 transition-all">
                        Get Started Free
                    </a>
                    <a href="/questions" class="px-8 py-4 bg-white text-slate-700 font-bold rounded-2xl border border-slate-200 hover:bg-slate-50 transition-all">
                        Browse Questions
                    </a>
                </div>
                <div class="mt-12 flex items-center sm:justify-center lg:justify-start space-x-6 grayscale opacity-60">
                    <span class="text-sm font-bold uppercase tracking-widest text-slate-400">Trusted By</span>
                    <div class="font-bold text-slate-500 italic">CommunityHub</div>
                    <div class="font-bold text-slate-500 italic">NeighborWatch</div>
                </div>
            </div>
            
            <div class="mt-16 sm:mt-24 lg:mt-0 lg:col-span-6 relative">
                <div class="relative mx-auto w-full max-w-lg">
                    <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
                    <div class="absolute top-0 -right-4 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
                    <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
                    
                    <div class="relative glass rounded-3xl p-6 shadow-2xl border border-white/40">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="w-12 h-12 rounded-full bg-slate-200"></div>
                            <div class="flex-1 space-y-2">
                                <div class="h-4 bg-slate-100 rounded-full w-3/4"></div>
                                <div class="h-3 bg-slate-50 rounded-full w-1/2"></div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="h-4 bg-indigo-50 rounded-lg w-full"></div>
                            <div class="h-4 bg-indigo-50 rounded-lg w-full"></div>
                            <div class="h-4 bg-indigo-50 rounded-lg w-4/5"></div>
                        </div>
                        <div class="mt-8 flex justify-end">
                            <div class="px-6 py-2 bg-indigo-600 rounded-xl text-white font-bold text-sm">Post Question</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold text-slate-900 mb-4">Why LocalMind?</h2>
        <p class="text-slate-500 max-w-2xl mx-auto mb-16 text-lg">Built for real communities, where knowledge stays local and helpfulness is rewarded.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl transition-all group">
                <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Hyper-Local Focus</h3>
                <p class="text-slate-500">Only see questions and answers relevant to your specific neighborhood or city.</p>
            </div>
            
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl transition-all group">
                <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.033L3 9m4.588 15.514L12 21.944l4.412 2.57a1.997 1.997 0 002.158-.124 1.947 1.947 0 00.784-1.574v-2.28a1.947 1.947 0 00-.784-1.574 1.997 1.997 0 00-2.158-.124L12 21.944l-4.412-2.57a1.997 1.997 0 00-2.158.124 1.947 1.947 0 00-.784 1.574v2.28a1.947 1.947 0 00.784 1.574 1.997 1.997 0 002.158.124z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Verified Experts</h3>
                <p class="text-slate-500">Identify true local experts through our unique reputation and badge system.</p>
            </div>
            
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl transition-all group">
                <div class="w-16 h-16 bg-pink-50 text-pink-600 rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:bg-pink-600 group-hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Instant Connections</h3>
                <p class="text-slate-500">Get quick answers to your questions from people who actually live near you.</p>
            </div>
        </div>
    </div>
</section>
@endsection