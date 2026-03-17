<template>
    <div class="bg-slate-50 min-h-screen py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <h1 class="text-4xl font-bold text-slate-900 mb-6 font-outfit text-left">Explore <span class="text-indigo-600">Questions</span></h1>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-6 relative">
                        <input v-model="search" type="text" placeholder="Search for questions or topics..." 
                            class="w-full pl-14 pr-4 py-4 bg-white rounded-2xl shadow-sm border-none focus:ring-2 focus:ring-indigo-500 text-lg outline-none transition-all placeholder:text-slate-400">
                        <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                    <div class="md:col-span-4 relative">
                        <input v-model="location" type="text" placeholder="Location..." 
                            class="w-full pl-14 pr-4 py-4 bg-white rounded-2xl shadow-sm border-none focus:ring-2 focus:ring-indigo-500 text-lg outline-none transition-all placeholder:text-slate-400">
                        <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <button @click="fetchQuestions" class="w-full h-full px-6 py-4 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-100">
                            Search
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <div class="flex-grow space-y-4">
                    <div class="mb-6">
                        <div class="flex flex-wrap gap-2">
                            <button v-for="cat in categories" :key="cat" 
                                @click="toggleCategory(cat)"
                                :class="selectedCategory === cat ? 'bg-indigo-600 text-white' : 'bg-white text-slate-600 hover:bg-slate-50'"
                                class="px-4 py-2 rounded-xl text-sm font-bold border border-slate-100 transition-all shadow-sm">
                                {{ cat }}
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-2">
                        <h2 class="font-bold text-slate-700 uppercase tracking-wider text-sm">{{ selectedCategory }} Questions</h2>
                    </div>

                    <div v-for="question in questions" :key="question.id" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:border-indigo-200 transition-all group relative">
                        <router-link :to="'/questions/' + question.id" class="absolute inset-0 z-0"></router-link>
                        <div class="flex items-start justify-between relative z-10 pointer-events-none">
                            <div class="flex-grow text-left">
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 text-[10px] font-bold uppercase rounded-md tracking-wider">{{ question.location }}</span>
                                    <span class="text-slate-400 text-xs">• {{ formatDate(question.created_at) }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-indigo-600 transition-colors">{{ question.title }}</h3>
                                <p class="text-slate-500 line-clamp-2">{{ question.content.substring(0, 150) }}...</p>
                            </div>
                            <div class="ml-4 text-center px-4 py-2 bg-slate-50 rounded-xl min-w-[80px]">
                                <span class="block text-xl font-bold text-slate-900 font-outfit">{{ question.responses_count }}</span>
                                <span class="text-slate-500 text-[10px] uppercase font-bold tracking-widest">Answers</span>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-between border-t border-slate-50 pt-4 relative z-10">
                            <div class="flex items-center space-x-2">
                                <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-[10px] font-bold">
                                    {{ question.user?.name?.charAt(0).toUpperCase() }}
                                </div>
                                <span class="text-sm font-medium text-slate-600">{{ question.user?.name }}</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="flex items-center text-slate-400 text-sm">
                                    <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> 
                                    {{ question.responses_count }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div v-if="questions.length === 0 && !loading" class="bg-white p-12 rounded-3xl text-center border border-slate-100 shadow-sm">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2 font-outfit">No questions yet</h3>
                        <p class="text-slate-500 mb-8">Be the first to ask something to your community!</p>
                        <router-link to="/questions/create" class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-all inline-block">Ask a Question</router-link>
                    </div>

                    <div v-if="loading" class="text-center py-12">
                         <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600 mx-auto"></div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="w-full lg:w-72 space-y-6">
                    <div class="bg-indigo-600 p-8 rounded-3xl text-white shadow-xl shadow-indigo-100 text-left">
                        <h4 class="font-bold text-xl mb-3 font-outfit text-white">Ask a Question</h4>
                        <p class="text-indigo-100 text-sm mb-6">Need help with something local? Our community is here for you.</p>
                        <router-link v-if="auth.isAuthenticated" to="/questions/create" class="block w-full text-center py-3 bg-white text-indigo-600 font-bold rounded-xl hover:bg-indigo-50 transition-colors">Post Now</router-link>
                        <router-link v-else to="/login" class="block w-full text-center py-3 bg-white text-indigo-600 font-bold rounded-xl hover:bg-indigo-50 transition-colors">Login to Post</router-link>
                    </div>

                    <div class="bg-white p-6 rounded-3xl border border-slate-100 text-left">
                        <h4 class="font-bold text-slate-900 mb-4 uppercase tracking-wider text-xs">Trending Topics</h4>
                        <div class="flex flex-wrap gap-2">
                            <button class="px-3 py-1.5 bg-slate-50 text-slate-600 text-xs font-bold rounded-lg hover:bg-slate-100 transition-colors">#Events</button>
                            <button class="px-3 py-1.5 bg-slate-50 text-slate-600 text-xs font-bold rounded-lg hover:bg-slate-100 transition-colors">#Foodie</button>
                            <button class="px-3 py-1.5 bg-slate-50 text-slate-600 text-xs font-bold rounded-lg hover:bg-slate-100 transition-colors">#Nightlife</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useAuthStore } from '../../stores/auth';
import axios from 'axios';

const auth = useAuthStore();
const questions = ref([]);
const loading = ref(true);
const search = ref('');
const location = ref('');
const selectedCategory = ref('All');
const categories = ['All', 'General', 'Services', 'Events', 'Safety', 'Recommendations'];

const toggleCategory = (cat) => {
    selectedCategory.value = cat;
    fetchQuestions();
};

const fetchQuestions = async () => {
    loading.value = true;
    try {
        const response = await axios.get('/api/questions', {
            params: {
                search: search.value,
                location: location.value,
                category: selectedCategory.value === 'All' ? null : selectedCategory.value
            }
        });
        // Handle paginated data
        questions.value = response.data.data;
    } catch (error) {
        console.error("Error fetching questions:", error);
    } finally {
        loading.value = false;
    }
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString(); // Simpler version of diffForHumans
};

onMounted(fetchQuestions);
</script>
