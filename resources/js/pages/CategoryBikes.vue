<script setup lang="ts">
import MainLayout from '@/layouts/Main.vue';
import { Link, Head } from '@inertiajs/vue3';
import { defineProps, ref, computed } from 'vue';
import { ArrowLeftIcon } from '@heroicons/vue/24/solid';

const props = defineProps({
    brands: Array,
    bikes: Array,
    category: Object,
    breadcrumb: Array,
});

// Filters
const selectedBrand = ref('');
const selectedYear = ref('');

// All years for filter dropdown
const years = computed(() => {
    const allYears = props.bikes.map(b => b.year).filter(Boolean);
    return [...new Set(allYears)].sort((a, b) => b - a);
});

// Apply filters before grouping
const filteredBikes = computed(() => {
    return props.bikes.filter(bike => {
        const brandMatch = selectedBrand.value ? bike.brand?.id === selectedBrand.value : true;
        const yearMatch = selectedYear.value ? bike.year === selectedYear.value : true;
        return brandMatch && yearMatch;
    });
});

// Group filtered bikes by brand and year
const groupedBikes = computed(() => {
    const result = {};

    filteredBikes.value.forEach(bike => {
        const brand = bike.brand?.name || 'Άγνωστη Μάρκα';
        const year = bike.year?.toString() || 'Άγνωστο Έτος';

        if (!result[brand]) result[brand] = {};
        if (!result[brand][year]) result[brand][year] = [];

        result[brand][year].push(bike);
    });

    return result;
});

defineOptions({
    layout: MainLayout,
});
</script>

<template>
    <Head>
        <title>{{ category.title }}</title>
        <meta name="description" :content="category.description">
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://example.com/my-page" />
        <meta property="og:title" content="My Awesome Page" />
        <meta property="og:description" content="This is the description of my awesome page." />
        <meta property="og:image" content="https://example.com/images/social-image.jpg" />
    </Head>

    <div class="py-20">
        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-600 mb-6" aria-label="Breadcrumb">
            <ol class="list-reset flex items-center">
                <li v-for="(crumb, index) in breadcrumb" :key="index" class="flex items-center">
                    <Link :href="crumb.url" class="hover:underline px-2">{{ crumb.label }}</Link>
                    <span v-if="index < breadcrumb.length - 1">/</span>
                </li>
            </ol>
        </nav>

        <!-- Title + Description -->
        <h1 class="mb-4 text-2xl font-bold">{{ category.title }}</h1>
        <p class="max-w-[1200px]">{{ category.description }}</p>

        <Link class="bg-black text-white text-base px-6 py-1 inline-flex items-center gap-2 mt-6" href="/categories">
            <ArrowLeftIcon class="w-5 h-5" />
            Επιστροφή
        </Link>

        <!-- Filters -->
        <div class="my-10 flex flex-wrap gap-6">
            <div>
                <label class="block mb-1 font-medium">Φίλτρο κατά Μάρκα</label>
                <select v-model="selectedBrand" class="border rounded p-2">
                    <option value="">Όλες</option>
                    <option v-for="brand in brands" :key="brand.id" :value="brand.id">
                        {{ brand.name }}
                    </option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Φίλτρο κατά Έτος</label>
                <select v-model="selectedYear" class="border rounded p-2">
                    <option value="">Όλα</option>
                    <option v-for="year in years" :key="year" :value="year">
                        {{ year }}
                    </option>
                </select>
            </div>
        </div>

        <!-- Grouped Bikes Grid -->
        <div v-if="Object.keys(groupedBikes).length">
            <div v-for="(years, brand) in groupedBikes" :key="brand" class="mb-10">
                <h2 class="text-xl font-bold mb-2">{{ brand }}</h2>
                <div v-for="(bikes, year) in years" :key="year" class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">{{ year }}</h3>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        <div v-for="bike in bikes" :key="bike.id">
                            <div class="overflow-hidden rounded-lg bg-white shadow-lg relative">
                                <Link :href="`/bike/${bike.slug}`" class="block p-4">
                                    <span class="absolute top-2 right-2 rounded bg-black px-2 py-1 text-xs font-bold text-white"> Από {{ Math.floor(bike.price) }} €</span>
                                    <img :src="`/storage/${bike.image}`" :alt="bike.title" class="h-48 w-full object-contain bg-white" />
                                    <div class="p-4">
                                        <h3 class="mt-2 mb-2 text-center text-xl font-semibold">{{ bike.name }}</h3>
                                    </div>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- No bikes -->
        <div v-else class="text-center text-gray-500 mt-10">Δεν βρέθηκαν αποτελέσματα.</div>
    </div>
</template>
