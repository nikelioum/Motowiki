<script setup lang="ts">
import MainLayout from '@/layouts/Main.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    success: Boolean,
    message: String,
})

defineOptions({
    layout: MainLayout,
});

</script>

<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
        <div class="bg-white p-8 rounded shadow max-w-md w-full text-center">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">
                {{ success ? 'Unsubscribed' : 'Error' }}
            </h1>
            <p class="text-gray-600 mb-6">
                {{ message }}
            </p>
            <Link href="/" class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Go to Homepage
            </Link>
        </div>
    </div>
</template>


