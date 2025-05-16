<script setup lang="ts">
import MainLayout from '@/layouts/Main.vue';
import { Head, Link } from '@inertiajs/vue3';


defineOptions({
    layout: MainLayout,
});
</script>

<template>
    <div class="flex flex-col justify-center items-center min-h-screen">
        <!-- 404 Message Section -->
        <div class="text-center">
            <h1 class="text-6xl font-extrabold text-gray-800">404</h1>
            <h2 class="text-2xl mt-4 text-gray-600">Ωχ! Η σελίδα δεν βρέθηκε</h2>
            <p class="mt-2 mb-6 text-lg text-gray-500">Η σελίδα που ψάχνετε δεν υπάρχει ή έχει μετακινηθεί.</p>

            <!-- Go back to home button -->
            <Link href="/" class="mt-8 px-6 py-2 bg-black text-white text-lg transition duration-200 hover:cursor">
                Επιστροφή στην Αρχική
            </Link>
        </div>
    </div>
</template>

