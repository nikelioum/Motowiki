<script setup lang="ts">
import MainLayout from '@/layouts/Main.vue';
import { Head, Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

// Define props to accept the categories data from the controller
const props = defineProps({
    categories: Array,
    breadcrumb: Array,
});

defineOptions({
    layout: MainLayout,
});
</script>

<style scoped>
.scrollbar-thick-black::-webkit-scrollbar {
    height: 10px;
}

.scrollbar-thick-black::-webkit-scrollbar-track {
    background: transparent;
}

.scrollbar-thick-black::-webkit-scrollbar-thumb {
    background-color: black;
    border-radius: 6px;
}

.scrollbar-thick-black {
    scrollbar-color: black transparent;
    scrollbar-width: thin;
}
</style>

<template>
    <Head>
        <title>Your page title</title>
        <meta name="description" content="Your page description" />
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://example.com/my-page" />
        <meta property="og:title" content="My Awesome Page" />
        <meta property="og:description" content="This is the description of my awesome page." />
        <meta property="og:image" content="https://example.com/images/social-image.jpg" />
    </Head>

    <div class="py-20">
        <nav class="mb-6 text-sm text-gray-600" aria-label="Breadcrumb">
            <ol class="list-reset flex items-center">
                <li v-for="(crumb, index) in props.breadcrumb" :key="index" class="flex items-center">
                    <Link :href="crumb.url" class="px-2 hover:underline">{{ crumb.label }}</Link>
                    <span v-if="index < props.breadcrumb.length - 1" class="">/</span>
                </li>
            </ol>
        </nav>

        <h1 class="mb-4 text-2xl font-bold">Κατηγορίες Μοτοσυκλέτας</h1>
        <p class="max-w-[1200px]">
            Ανακαλύψτε όλες τις κατηγορίες των μοτοσυκλετών και τις τελευταίες καινοτομίες που προσφέρουν οι κορυφαίοι κατασκευαστές στον κόσμο. Εδώ
            μπορείτε να μάθετε για τις νέες μοτοσυκλέτες, τις εξελιγμένες τεχνολογίες και τα μοναδικά χαρακτηριστικά τους, χωρίς να χρειάζεται να
            κάνετε κάποια αγορά.
        </p>

        <div class="pt-15">
            <h6 class="mb-4 text-xl font-semibold">Δημοφιλέστερες Κατηγορίες</h6>
            <div class="scrollbar-thick-black flex space-x-4 overflow-x-auto pb-4">
                <div
                    v-for="category in props.categories.filter((c) => c.is_popular).slice(0, 10)"
                    :key="'popular-' + category.id"
                    class="min-w-[200px] flex-shrink-0 rounded-lg border border-gray-300 bg-white px-4 py-2 text-center shadow-lg hover:bg-gray-100"
                >
                    <Link :href="`/category/${category.slug}`" class="block">
                        <h5 class="text-base font-medium">{{ category.title }}</h5>
                    </Link>
                </div>
            </div>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 gap-6 pt-12 pb-12 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <div v-for="category in props.categories" :key="category.id">
                <!-- Card -->
                <div class="overflow-hidden rounded-lg bg-white shadow-lg relative">
                    <!-- "HOT" Label -->
                    <span v-if="category.is_popular" class="absolute top-2 right-2 rounded bg-black px-2 py-1 text-xs font-bold text-white">
                        HOT
                    </span>
                    <Link :href="`/category/${category.slug}`" class="block p-4">
                        <img :src="`/storage/${category.image}`" :alt="category.title" class="h-48 w-full object-contain bg-white" />

                        <div class="p-4">
                            <h3 class="mt-2 mb-2 text-center text-xl font-semibold">{{ category.title }}</h3>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
