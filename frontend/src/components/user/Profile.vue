<template>
    <div class="bg-slate-50 min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div v-if="auth.user" class="space-y-8">
                <!-- Header / Profile Info -->
                <div class="bg-white rounded-[3rem] p-10 shadow-xl shadow-slate-200/50 border border-slate-100 flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8 text-left">
                    <div class="w-32 h-32 rounded-[2rem] bg-indigo-600 flex items-center justify-center text-white text-5xl font-bold shadow-2xl shadow-indigo-200">
                        {{ auth.user.name.charAt(0).toUpperCase() }}
                    </div>
                    <div class="flex-grow">
                        <div class="flex items-center justify-between mb-2">
                             <h1 class="text-4xl font-extrabold text-slate-900 font-outfit">{{ auth.user.name }}</h1>
                             <span class="px-4 py-1 bg-indigo-50 text-indigo-600 text-sm font-bold rounded-full uppercase tracking-widest">{{ auth.user.role }}</span>
                        </div>
                        <p class="text-slate-500 text-lg mb-6">{{ auth.user.email }}</p>
                        
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                <span class="block text-2xl font-bold text-slate-900">{{ userQuestions.length }}</span>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Questions</span>
                            </div>
                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                <span class="block text-2xl font-bold text-slate-900">{{ userResponses.length }}</span>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Responses</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="flex space-x-4 border-b border-slate-200 pb-px">
                    <button @click="activeTab = 'questions'" 
                        :class="activeTab === 'questions' ? 'text-indigo-600 border-indigo-600' : 'text-slate-400 border-transparent hover:text-slate-600'"
                        class="pb-4 px-2 font-bold text-sm uppercase tracking-widest border-b-2 transition-all">
                        My Questions
                    </button>
                    <button @click="activeTab = 'responses'" 
                        :class="activeTab === 'responses' ? 'text-indigo-600 border-indigo-600' : 'text-slate-400 border-transparent hover:text-slate-600'"
                        class="pb-4 px-2 font-bold text-sm uppercase tracking-widest border-b-2 transition-all">
                        My Responses
                    </button>
                </div>

                <!-- Tab Content -->
                <div v-if="activeTab === 'questions'" class="space-y-4">
                    <div v-for="q in userQuestions" :key="q.id" class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:border-indigo-200 transition-all text-left group">
                        <router-link :to="'/questions/' + q.id" class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center space-x-2 mb-2">
                                     <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 text-[10px] font-bold uppercase rounded-md tracking-wider">{{ q.location }}</span>
                                     <span class="text-slate-400 text-xs">• {{ formatDate(q.created_at) }}</span>
                                </div>
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">{{ q.title }}</h3>
                            </div>
                            <svg class="w-5 h-5 text-slate-300 group-hover:text-indigo-600 transition-colors transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </router-link>
                    </div>
                    <div v-if="userQuestions.length === 0" class="text-center py-20 bg-white rounded-3xl border border-slate-100 text-slate-400 italic">
                        You haven't asked any questions yet.
                    </div>
                </div>

                <div v-if="activeTab === 'responses'" class="space-y-4">
                    <div v-for="r in userResponses" :key="r.id" class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:border-indigo-200 transition-all text-left group">
                         <router-link :to="'/questions/' + r.question_id" class="block">
                            <div class="flex items-center space-x-2 mb-3">
                                <span class="text-slate-400 text-xs">Answered on {{ formatDate(r.created_at) }}</span>
                                <span v-if="r.is_solution" class="px-2 py-0.5 bg-emerald-100 text-emerald-700 text-[10px] font-bold rounded-md">Solution</span>
                            </div>
                            <p class="text-slate-700 line-clamp-2 mb-4 italic">"{{ r.content }}"</p>
                            <div class="p-3 bg-slate-50 rounded-xl">
                                <span class="text-xs font-bold text-slate-400 uppercase block mb-1">To question:</span>
                                <span class="text-sm font-bold text-slate-900">{{ r.question?.title }}</span>
                            </div>
                         </router-link>
                    </div>
                     <div v-if="userResponses.length === 0" class="text-center py-20 bg-white rounded-3xl border border-slate-100 text-slate-400 italic">
                        You haven't answered any questions yet.
                    </div>
                </div>
            </div>
            
            <div v-else-if="loading" class="text-center py-20">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600 mx-auto"></div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useAuthStore } from '../../stores/auth';
import axios from 'axios';

const auth = useAuthStore();
const loading = ref(true);
const userQuestions = ref([]);
const userResponses = ref([]);
const activeTab = ref('questions');

const fetchData = async () => {
    try {
        // We'll add a new endpoint or filter existing ones
        const [qRes, rRes] = await Promise.all([
            axios.get('/api/user/questions'),
            axios.get('/api/user/responses')
        ]);
        userQuestions.value = qRes.data;
        userResponses.value = rRes.data;
    } catch (error) {
        console.error("Error fetching profile data:", error);
    } finally {
        loading.value = false;
    }
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString();
};

onMounted(fetchData);
</script>
