<template>
    <div class="fixed bottom-8 right-8 z-[100] flex flex-col space-y-3">
        <transition-group name="toast">
            <div v-for="toast in store.toasts" :key="toast.id" 
                :class="[
                    'px-6 py-4 rounded-2xl shadow-2xl flex items-center space-x-3 min-w-[300px] border transform transition-all duration-300',
                    toast.type === 'success' ? 'bg-emerald-500 text-white border-emerald-400' : 'bg-red-500 text-white border-red-400'
                ]">
                <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center">
                    <svg v-if="toast.type === 'success'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
                <p class="font-bold font-outfit">{{ toast.message }}</p>
                <button @click="store.remove(toast.id)" class="ml-auto hover:scale-110 transition-transform">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </transition-group>
    </div>
</template>

<script setup>
import { useToastStore } from '../stores/toast';
const store = useToastStore();
</script>

<style scoped>
.toast-enter-from { opacity: 0; transform: translateX(100%) scale(0.9); }
.toast-enter-to { opacity: 1; transform: translateX(0) scale(1); }
.toast-leave-from { opacity: 1; transform: translateX(0); }
.toast-leave-to { opacity: 0; transform: translateX(100%); }
</style>
