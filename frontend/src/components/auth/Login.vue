<template>
    <div class="min-h-[calc(100vh-64px)] flex">
        <!-- Brand Side -->
        <div class="hidden lg:flex lg:w-1/2 bg-indigo-600 items-center justify-center p-12 overflow-hidden relative">
            <div class="absolute inset-0 z-0">
                <svg class="h-full w-full text-indigo-500 opacity-20" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <polygon points="50,0 100,0 50,100 0,100" />
                </svg>
            </div>
            <div class="relative z-10 text-white max-w-lg">
                <h1 class="text-5xl font-extrabold leading-tight mb-6 text-white">Welcome back to the <span class="text-indigo-200">neighborhood.</span></h1>
                <p class="text-xl text-indigo-100 mb-8">Reconnect with your community, answer local questions, and help your neighbors out.</p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-indigo-700/50 p-4 rounded-2xl border border-indigo-500/30">
                        <span class="block text-3xl font-bold mb-1">5k+</span>
                        <span class="text-indigo-200 text-sm italic">Active Users</span>
                    </div>
                    <div class="bg-indigo-700/50 p-4 rounded-2xl border border-indigo-500/30">
                        <span class="block text-3xl font-bold mb-1">12k+</span>
                        <span class="text-indigo-200 text-sm italic">Local Answers</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Side -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-slate-900 mb-2 font-outfit">Sign in</h2>
                    <p class="text-slate-500">Enter your credentials to access your account</p>
                </div>

                <form @submit.prevent="handleLogin" class="space-y-6">
                    <div v-if="error" class="bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-xl text-sm text-center">
                        {{ error }}
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                        <input v-model="form.email" type="email" id="email" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400"
                            placeholder="name@example.com">
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                            <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                        </div>
                        <input v-model="form.password" type="password" id="password" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400"
                            placeholder="••••••••">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-slate-700 cursor-pointer">Remember me for 30 days</label>
                    </div>

                    <button type="submit" :disabled="loading"
                        class="w-full py-4 bg-indigo-600 text-white font-bold rounded-xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all transform active:scale-[0.98] disabled:opacity-70">
                        {{ loading ? 'Signing in...' : 'Sign In' }}
                    </button>
                    
                    <p class="text-center text-sm text-slate-500 mt-6">
                        Don't have an account? <router-link to="/register" class="font-bold text-indigo-600 hover:text-indigo-500">Create one for free</router-link>
                    </p>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useAuthStore } from '../../stores/auth';
import { useToastStore } from '../../stores/toast';
import { useRouter } from 'vue-router';

const auth = useAuthStore();
const router = useRouter();

const form = reactive({
    email: '',
    password: ''
});

const loading = ref(false);
const error = ref(null);

const handleLogin = async () => {
    loading.value = true;
    error.value = null;
    try {
        await auth.login(form);
        useToastStore().add('Welcome back!');
        router.push('/');
    } catch (err) {
        error.value = err.response?.data?.message || 'Invalid credentials';
    } finally {
        loading.value = false;
    }
};
</script>
