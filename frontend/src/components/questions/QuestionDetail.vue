<template>
    <div class="bg-slate-50 min-h-screen py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <template v-if="question">
                <article class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 mb-8 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-6 flex items-center space-x-2">
                         <button @click="toggleFavorite" class="p-3 rounded-2xl transition-all" :class="isFavorited ? 'text-amber-500 bg-amber-50' : 'text-slate-400 hover:text-amber-500 hover:bg-amber-50'">
                            <svg class="w-6 h-6" :class="{ 'fill-current': isFavorited }" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        </button>
                        
                        <div v-if="canManage" class="flex items-center space-x-2">
                             <router-link v-if="isOwner" :to="'/questions/edit/' + question.id" class="p-3 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-2xl transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </router-link>
                            <button @click="deleteQuestion" class="p-3 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-2xl transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3 mb-6">
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-xs font-bold uppercase rounded-lg tracking-wider">{{ question.location }}</span>
                        <span class="text-slate-400 text-sm">Asked {{ formatDate(question.created_at) }}</span>
                    </div>

                    <h1 class="text-3xl font-extrabold text-slate-900 mb-6 leading-tight font-outfit text-left">
                        {{ question.title }}
                    </h1>

                    <div class="prose prose-slate max-w-none text-slate-600 mb-8 leading-relaxed whitespace-pre-line text-left">
                        {{ question.content }}
                    </div>

                    <div class="flex items-center justify-between border-t border-slate-50 pt-8">
                        <div class="flex items-center space-x-3 text-left">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                                {{ question.user?.name?.charAt(0).toUpperCase() }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">{{ question.user?.name }}</p>
                                <p class="text-slate-500 text-xs">Community Member</p>
                            </div>
                        </div>
                    </div>
                </article>

                <div class="flex items-center justify-between mb-8 px-4">
                    <h2 class="text-2xl font-bold text-slate-900 font-outfit">{{ question.responses?.length }} Community Answers</h2>
                </div>

                <div class="space-y-6">
                    <div v-for="response in question.responses" :key="response.id" class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 transition-all hover:border-indigo-100 group">
                        <div class="flex items-start justify-between mb-6">
                            <div class="flex items-center space-x-3 text-left">
                                <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600 font-bold">
                                    {{ response.user?.name?.charAt(0).toUpperCase() }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">{{ response.user?.name }}</p>
                                    <span class="text-slate-400 text-xs">Answered {{ formatDate(response.created_at) }}</span>
                                </div>
                            </div>
                            <!-- Response Actions -->
                            <div class="flex items-center space-x-1">
                                <button v-if="isOwner && !response.is_solution" @click="markAsSolution(response.id)" 
                                    class="p-2 text-slate-400 hover:text-emerald-500 hover:bg-emerald-50 rounded-lg transition-all" title="Mark as solution">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </button>
                                <span v-if="response.is_solution" class="flex items-center space-x-1 px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    <span>Solution</span>
                                </span>
                                <div v-if="auth.user && response.user_id === auth.user.id" class="flex items-center space-x-1">
                                    <button @click="startEdit(response)" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    <button @click="deleteResponse(response.id)" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div v-if="editingResponseId === response.id" class="mt-4">
                            <textarea v-model="editContent" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500" rows="3"></textarea>
                            <div class="flex justify-end space-x-2 mt-2">
                                <button @click="editingResponseId = null" class="px-4 py-2 text-slate-500 hover:text-slate-700 font-medium">Cancel</button>
                                <button @click="updateResponse(response.id)" class="px-4 py-2 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all">Save</button>
                            </div>
                        </div>
                        <div v-else class="text-slate-600 leading-relaxed mb-6 whitespace-pre-line text-left">
                            {{ response.content }}
                        </div>
                    </div>

                    <div v-if="!question.responses?.length" class="bg-white p-12 rounded-[2.5rem] text-center border border-slate-100 shadow-sm text-slate-500 italic">
                        No answers yet. Share your knowledge!
                    </div>
                </div>

                <!-- Answer Form -->
                <div v-if="auth.isAuthenticated" class="mt-12 bg-indigo-600 rounded-[3rem] p-10 text-white shadow-2xl shadow-indigo-100 text-left">
                    <h2 class="text-2xl font-bold mb-6 font-outfit text-white">Your Answer</h2>
                    <form @submit.prevent="submitResponse">
                        <textarea v-model="newResponse" required
                            class="w-full h-40 bg-white/10 border border-white/20 rounded-2xl p-6 text-white placeholder-indigo-200 outline-none focus:ring-2 focus:ring-white/50 transition-all mb-4"
                            placeholder="Write your advice here..."></textarea>
                        <div class="flex justify-end">
                            <button type="submit" :disabled="submitting" class="px-8 py-3 bg-white text-indigo-600 font-bold rounded-2xl hover:bg-indigo-50 transition-all transform hover:-translate-y-1">
                                {{ submitting ? 'Posting...' : 'Post Answer' }}
                            </button>
                        </div>
                    </form>
                </div>
                <div v-else class="mt-12 bg-slate-100 rounded-[3rem] p-10 text-center text-slate-600">
                    <p class="text-xl mb-6 font-medium">Want to help? Log in to share your answer!</p>
                    <router-link to="/login" class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-all">Go to Login</router-link>
                </div>
            </template>
            <div v-else-if="loading" class="text-center py-20">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600 mx-auto"></div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { useAuthStore } from '../../stores/auth';
import { useToastStore } from '../../stores/toast';
import { useRouter } from 'vue-router';
import axios from 'axios';

const props = defineProps(['id']);
const auth = useAuthStore();
const router = useRouter();

const question = ref(null);
const loading = ref(true);
const submitting = ref(false);
const newResponse = ref('');
const isFavorited = ref(false);

const editingResponseId = ref(null);
const editContent = ref('');

const isOwner = computed(() => auth.user && question.value && auth.user.id === question.value.user_id);
const canManage = computed(() => isOwner.value || (auth.user && auth.user.role === 'admin'));

const fetchQuestion = async () => {
    try {
        const response = await axios.get(`/api/questions/${props.id}`);
        question.value = response.data;
        // Simplified favorite check for demo
        isFavorited.value = response.data.favorites?.some(f => f.user_id === auth.user?.id);
    } catch (error) {
        console.error("Error fetching question:", error);
    } finally {
        loading.value = false;
    }
};

const submitResponse = async () => {
    if (!newResponse.value.trim()) return;
    submitting.value = true;
    try {
        const response = await axios.post(`/api/questions/${props.id}/responses`, {
            content: newResponse.value
        });
        question.value.responses.push(response.data.response);
        newResponse.value = '';
        useToastStore().add('Answer posted!');
    } catch (error) {
        console.error("Error posting response:", error);
    } finally {
        submitting.value = false;
    }
};

const startEdit = (response) => {
    editingResponseId.value = response.id;
    editContent.value = response.content;
};

const updateResponse = async (id) => {
    try {
        const res = await axios.put(`/api/responses/${id}`, { content: editContent.value });
        const index = question.value.responses.findIndex(r => r.id === id);
        question.value.responses[index].content = res.data.response.content;
        editingResponseId.value = null;
    } catch (error) {
        console.error("Error updating response:", error);
    }
};

const deleteResponse = async (id) => {
    if (!confirm('Delete this answer?')) return;
    try {
        await axios.delete(`/api/responses/${id}`);
        question.value.responses = question.value.responses.filter(r => r.id !== id);
    } catch (error) {
        console.error("Error deleting response:", error);
    }
};

const markAsSolution = async (id) => {
    try {
        const res = await axios.post(`/api/responses/${id}/solution`);
        question.value = res.data.question;
    } catch (error) {
        console.error("Error marking solution:", error);
    }
};

const toggleFavorite = async () => {
    if (!auth.isAuthenticated) {
        router.push('/login');
        return;
    }
    try {
        await axios.post(`/api/questions/${props.id}/favorite`);
        isFavorited.value = !isFavorited.value;
    } catch (error) {
        console.error("Error toggling favorite:", error);
    }
};

const deleteQuestion = async () => {
    if (!confirm('Are you sure you want to delete this question?')) return;
    try {
        await axios.delete(`/api/questions/${props.id}`);
        router.push('/questions');
    } catch (error) {
        console.error("Error deleting question:", error);
    }
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString();
};

onMounted(fetchQuestion);
</script>
