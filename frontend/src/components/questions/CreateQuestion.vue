<template>
    <div class="bg-slate-50 min-h-[calc(100vh-64px)] py-12 text-left">
        <div class="max-w-2xl mx-auto px-4">
            <div class="mb-8">
                <router-link to="/questions" class="inline-flex items-center text-slate-500 hover:text-indigo-600 transition-colors mb-4 group">
                    <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Back to all questions
                </router-link>
                <h1 class="text-4xl font-extrabold text-slate-900 leading-tight font-outfit">Ask your Community</h1>
                <p class="text-slate-500 mt-2">Get insights, advice, and answers from people right in your neighborhood.</p>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-12">
                <form @submit.prevent="handleSubmit" class="space-y-8">
                    <div v-if="error" class="bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-xl text-sm text-center">
                        {{ error }}
                    </div>

                    <div class="space-y-2">
                        <label for="title" class="block text-sm font-bold text-slate-700 uppercase tracking-widest ml-1">Title</label>
                        <input v-model="form.title" type="text" id="title" required
                            class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder-slate-400 text-slate-700 font-medium"
                            placeholder="What's your question? Be specific.">
                    </div>

                    <div class="space-y-2">
                        <label for="category" class="block text-sm font-bold text-slate-700 uppercase tracking-widest ml-1">Category</label>
                        <select v-model="form.category" id="category" required
                            class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all text-slate-700 font-medium">
                            <option value="General">General</option>
                            <option value="Services">Services & Shops</option>
                            <option value="Events">Events & Activities</option>
                            <option value="Safety">Safety & Alerts</option>
                            <option value="Recommendations">Recommendations</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="location" class="block text-sm font-bold text-slate-700 uppercase tracking-widest ml-1">Location</label>
                        <input v-model="form.location" type="text" id="location" required
                            class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder-slate-400 text-slate-700 font-medium"
                            placeholder="e.g. Casablanca, Oasis, Maarif">
                    </div>

                    <div class="space-y-2">
                        <label for="content" class="block text-sm font-bold text-slate-700 uppercase tracking-widest ml-1">Description</label>
                        <textarea v-model="form.content" id="content" rows="6" required
                            class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-3xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder-slate-400 text-slate-700 font-medium lg:resize-none"
                            placeholder="Provide all the details someone would need to answer your question..."></textarea>
                    </div>

                    <button type="submit" :disabled="loading"
                        class="w-full py-5 bg-indigo-600 text-white font-bold rounded-2xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:shadow-indigo-200 transition-all transform hover:-translate-y-1 active:translate-y-0 disabled:opacity-70">
                        {{ loading ? 'Posting...' : 'Post Question' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();
const loading = ref(false);
const error = ref(null);

const form = reactive({
    title: '',
    category: 'General',
    location: '',
    content: ''
});

const handleSubmit = async () => {
    loading.value = true;
    error.value = null;
    try {
        const response = await axios.post('/api/questions', form);
        router.push('/questions/' + response.data.question.id);
    } catch (err) {
        error.value = err.response?.data?.message || 'Failed to post question';
    } finally {
        loading.value = false;
    }
};
</script>
