<template>
    <div class="min-h-[calc(100vh-64px)] flex">
        <!-- Brand Side -->
        <div class="hidden lg:flex lg:w-1/2 bg-indigo-600 items-center justify-center p-12 overflow-hidden relative">
            <div class="absolute inset-0 z-0">
                <svg class="h-full w-full text-indigo-500 opacity-20" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <polygon points="0,0 50,0 100,100 50,100" />
                </svg>
            </div>
            <div class="relative z-10 text-white max-w-lg">
                <h1 class="text-5xl font-extrabold leading-tight mb-6 text-white">Join the <span class="text-indigo-200">community</span> today.</h1>
                <p class="text-xl text-indigo-100 mb-8">Get expert advice from neighbors, share your knowledge, and build a better city together.</p>
                <ul class="space-y-4">
                    <li class="flex items-center space-x-3 text-indigo-50 font-medium">
                        <svg class="h-6 w-6 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        <span>Hyper-local information</span>
                    </li>
                    <li class="flex items-center space-x-3 text-indigo-50 font-medium">
                        <svg class="h-6 w-6 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        <span>Verified expert answers</span>
                    </li>
                    <li class="flex items-center space-x-3 text-indigo-50 font-medium">
                        <svg class="h-6 w-6 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        <span>Reputation system</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Form Side -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white overflow-y-auto">
            <div class="w-full max-w-md">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-slate-900 mb-2 font-outfit">Create account</h2>
                    <p class="text-slate-500">Join thousands of neighbors sharing knowledge</p>
                </div>

                <form @submit.prevent="handleRegister" class="space-y-5">
                    <div v-if="error" class="bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-xl text-sm text-center">
                        {{ error }}
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
                        <input v-model="form.name" type="text" id="name" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400"
                            placeholder="John Doe">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                        <input v-model="form.email" type="email" id="email" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400"
                            placeholder="name@example.com">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                        <input v-model="form.password" type="password" id="password" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400"
                            placeholder="min. 8 characters">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Confirm Password</label>
                        <input v-model="form.password_confirmation" type="password" id="password_confirmation" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400"
                            placeholder="repeat your password">
                    </div>

                    <div class="flex items-start">
                        <input type="checkbox" id="terms" required class="mt-1 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-slate-700 cursor-pointer">I agree to the <a href="#" class="text-indigo-600 font-semibold">Terms of Service</a> and <a href="#" class="text-indigo-600 font-semibold">Privacy Policy</a></label>
                    </div>

                    <button type="submit" :disabled="loading"
                        class="w-full py-4 bg-indigo-600 text-white font-bold rounded-xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all transform active:scale-[0.98] disabled:opacity-70">
                        {{ loading ? 'Creating account...' : 'Create Account' }}
                    </button>
                    
                    <p class="text-center text-sm text-slate-500 mt-6">
                        Already have an account? <router-link to="/login" class="font-bold text-indigo-600 hover:text-indigo-500">Sign in here</router-link>
                    </p>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useAuthStore } from '../../stores/auth';
import { useRouter } from 'vue-router';

const auth = useAuthStore();
const router = useRouter();

const form = reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
});

const loading = ref(false);
const error = ref(null);

const handleRegister = async () => {
    loading.value = true;
    error.value = null;
    try {
        await auth.register(form);
        router.push('/');
    } catch (err) {
        console.error('Registration error details:', err);
        if (err.response?.data?.errors) {
            error.value = Object.values(err.response.data.errors).flat().join(' ');
        } else if (err.response?.data?.message) {
            error.value = err.response.data.message;
        } else {
            error.value = `Registration failed: ${err.message} ${err.response ? '(Status: ' + err.response.status + ')' : '(Network Error)'}`;
        }
    } finally {
        loading.value = false;
    }
};
</script>
