<template>
    <div class="bg-slate-50 min-h-screen py-12 text-left">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <h1 class="text-4xl font-bold text-slate-900 mb-2 font-outfit text-left">My <span class="text-indigo-600">Favorites</span></h1>
                <p class="text-slate-500">Questions you've saved for later.</p>
            </div>

            <div class="space-y-4">
                <div v-for="favorite in favorites" :key="favorite.id" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:border-indigo-200 transition-all group relative">
                    <router-link :to="'/questions/' + favorite.question.id" class="absolute inset-0 z-0"></router-link>
                    <div class="flex items-start justify-between relative z-10 pointer-events-none">
                        <div class="flex-grow">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 text-[10px] font-bold uppercase rounded-md tracking-wider">{{ favorite.question.location }}</span>
                                <span class="text-slate-400 text-xs">• Favorited {{ formatDate(favorite.created_at) }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-indigo-600 transition-colors">{{ favorite.question.title }}</h3>
                            <p class="text-slate-500 line-clamp-2">{{ favorite.question.content.substring(0, 150) }}...</p>
                        </div>
                        <button @click.prevent="toggleFavorite(favorite.question.id)" class="ml-4 p-3 text-amber-500 bg-amber-50 rounded-xl transition-all pointer-events-auto" title="Remove from Favorites">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                    </div>
                </div>

                <div v-if="favorites.length === 0 && !loading" class="bg-white p-12 rounded-3xl text-center border border-slate-100 shadow-sm">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 font-outfit">No favorites yet</h3>
                    <p class="text-slate-500 mb-8">Questions you favorite will appear here.</p>
                    <router-link to="/questions" class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-all inline-block">Explore Questions</router-link>
                </div>

                <div v-if="loading" class="text-center py-12">
                     <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600 mx-auto"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const favorites = ref([]);
const loading = ref(true);

const fetchFavorites = async () => {
    loading.value = true;
    try {
        const response = await axios.get('/api/favorites');
        favorites.value = response.data.data;
    } catch (error) {
        console.error("Error fetching favorites:", error);
    } finally {
        loading.value = false;
    }
};

const toggleFavorite = async (questionId) => {
    try {
        await axios.post(`/api/questions/${questionId}/favorite`);
        favorites.value = favorites.value.filter(f => f.question.id !== questionId);
    } catch (error) {
        console.error("Error toggling favorite:", error);
    }
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString();
};

onMounted(fetchFavorites);
</script>
