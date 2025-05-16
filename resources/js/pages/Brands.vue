<script setup lang="ts">
import MainLayout from '@/layouts/Main.vue';
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import { Head } from '@inertiajs/vue3'

//Define props to accept the categories data from the controller
const props = defineProps({
    brands: Array,
    breadcrumb: Array,
});

defineOptions({
    layout: MainLayout,
});
</script>

<template>
    <Head>
        <title>Your page title</title>
        <meta name="description" content="Your page description">
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://example.com/my-page" />
        <meta property="og:title" content="My Awesome Page" />
        <meta property="og:description" content="This is the description of my awesome page." />
        <meta property="og:image" content="https://example.com/images/social-image.jpg" />
    </Head>

    <div class="py-20">

        <nav class="text-sm text-gray-600 mb-6" aria-label="Breadcrumb">
            <ol class="list-reset flex items-center">
                <li v-for="(crumb, index) in props.breadcrumb" :key="index" class="flex items-center">
                    <Link :href="crumb.url" class="hover:underline px-2">{{ crumb.label }}</Link>
                    <span v-if="index < props.breadcrumb.length - 1" class="">/</span>
                </li>
            </ol>
        </nav>

        <h1 class="mb-4 text-2xl font-bold">Εταιρείες Μοτοσυκλέτας</h1>
        <p class="max-w-[1200px]">
            Ανακαλύψτε όλες τις κατηγορίες των μοτοσυκλετών και τις τελευταίες καινοτομίες που προσφέρουν οι κορυφαίοι κατασκευαστές στον κόσμο. Εδώ
            μπορείτε να μάθετε για τις νέες μοτοσυκλέτες, τις εξελιγμένες τεχνολογίες και τα μοναδικά χαρακτηριστικά τους, χωρίς να χρειάζεται να
            κάνετε κάποια αγορά.
        </p>


        <div class="pt-15">
            <h6 class="mb-4 text-xl font-semibold">Δημοφιλέστερες Κατηγορίες</h6>
            <div class="flex space-x-4 overflow-x-auto pb-4 scrollbar-thick-black">
                <div
                    v-for="brand in props.brands.filter((c) => c.is_popular).slice(0, 10)"
                    :key="'popular-' + brand.id"
                    class="min-w-[200px] flex-shrink-0 rounded-lg border border-gray-300 bg-white px-4 py-2 text-center shadow-lg hover:bg-gray-100"
                >
                    <Link :href="`/brand/${brand.slug}`" class="block">
                        <h5 class="text-base font-medium">{{ brand.name }}</h5>
                    </Link>
                </div>
            </div>
        </div>


        <!-- Brands Grid -->
        <div class="grid grid-cols-3 gap-6 pt-12 pb-12 sm:grid-cols-6 md:grid-cols-6 lg:grid-cols-6">
            <div v-for="brand in props.brands" :key="brand.id">
                <!-- Card -->
                <div class="overflow-hidden rounded-lg bg-white shadow-lg">
                    <Link :href="`/brand/${brand.slug}`" class="block p-4">
                        <img :src="`/storage/${brand.image}`" :alt="brand.title" class=" h-20 w-full object-contain bg-white" />

<!--                        <div class="p-4">-->
<!--                            <h3 class="mt-2 mb-2 text-center text-xl font-semibold">{{ brand.name }}</h3>-->
<!--                        </div>-->
                    </Link>
                </div>
            </div>
        </div>

    </div>
</template>
