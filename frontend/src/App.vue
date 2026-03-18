<template>
    <div class="bg-gray-50 text-slate-900 min-h-screen flex flex-col">
        <Toast />
        <!-- Navigation -->
        <nav class="sticky top-0 z-50 glass border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <router-link to="/" class="flex-shrink-0 flex items-center group">
                            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-200 group-hover:rotate-6 transition-transform">
                                L
                            </div>
                            <span class="ml-3 text-2xl font-bold text-slate-900">Local<span class="text-indigo-600">Mind</span></span>
                        </router-link>
                        <div class="hidden sm:ml-10 sm:flex sm:space-x-8">
                            <router-link to="/" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-indigo-300 transition-all">Home</router-link>
                            <router-link to="/questions" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-indigo-300 transition-all">Questions</router-link>
                            <router-link v-if="auth.isAuthenticated" to="/favorites" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-indigo-300 transition-all">Favorites</router-link>
                        </div>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:items-center sm:space-x-4">
                        <template v-if="auth.isAuthenticated">
                            <router-link to="/profile" class="flex items-center space-x-2 mr-4 group">
                                <div class="w-8 h-8 rounded-lg bg-indigo-600 text-white flex items-center justify-center font-bold text-xs shadow-lg shadow-indigo-100 group-hover:scale-110 transition-transform">
                                    {{ auth.user?.name.charAt(0).toUpperCase() }}
                                </div>
                                <span class="hidden sm:inline font-bold text-slate-700 hover:text-indigo-600 transition-colors">Hello, {{ auth.user?.name }}</span>
                            </router-link>
                            <button @click="handleLogout" class="px-5 py-2.5 bg-slate-100 text-slate-600 text-sm font-semibold rounded-full hover:bg-slate-200 transition-all transform active:scale-95">Log out</button>
                        </template>
                        <template v-else>
                            <router-link to="/login" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Log in</router-link>
                            <router-link to="/register" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-full shadow-md shadow-indigo-100 hover:bg-indigo-700 hover:shadow-lg transition-all transform active:scale-95">Sign up</router-link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow">
            <router-view></router-view>
        </main>

        <!-- Footer -->
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
                            <li><router-link to="/" class="text-slate-400 hover:text-white transition-colors">Home</router-link></li>
                            <li><router-link to="/questions" class="text-slate-400 hover:text-white transition-colors">Browse Questions</router-link></li>
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
                    <p class="text-slate-400 text-sm">&copy; {{ new Date().getFullYear() }} LocalMind. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { useAuthStore } from './stores/auth';
import { useRouter } from 'vue-router';
import Toast from './components/Toast.vue';

const auth = useAuthStore();
const router = useRouter();

const handleLogout = async () => {
    await auth.logout();
    router.push('/login');
};
</script>


