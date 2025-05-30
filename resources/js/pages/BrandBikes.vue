<script setup lang="ts">
import MainLayout from '@/layouts/Main.vue';
import { Link, Head } from '@inertiajs/vue3';
import { defineProps, ref, computed } from 'vue';
import { ArrowLeftIcon } from '@heroicons/vue/24/solid';
import CompareBar from '@/components/main/CompareBar.vue';

const compareBarRef = ref<InstanceType<typeof CompareBar> | null>(null);

function compareBike(bike: any) {
    if (!compareBarRef.value) return;
    compareBarRef.value.addBike(bike);
}

const props = defineProps({
    brands: Array,
    bikes: Array,
    breadcrumb: Array,
    brand: Array,
});

// Filters
const selectedBrand = ref(''); // For filtering bikes by brand, optional if you want filtering by brand inside brand page

// All years for filter dropdown (same as before)
const years = computed(() => {
    const allYears = props.bikes.map((b) => b.year).filter(Boolean);
    return [...new Set(allYears)].sort((a, b) => b - a);
});

// Apply filters before grouping bikes by brand and year
const filteredBikes = computed(() => {
    return props.bikes.filter((bike) => {
        // If you want to filter bikes inside this brand page by selected brand or not,
        // here you can tweak the filter logic. For now, we skip filtering by brand because we're on brands page.
        const yearMatch = selectedYear.value ? bike.year === selectedYear.value : true;
        return yearMatch;
    });
});

// Group filtered bikes by brand and year
const groupedBikes = computed(() => {
    const result = {};

    filteredBikes.value.forEach((bike) => {
        const brand = bike.brand?.name || 'Άγνωστη Μάρκα';
        const year = bike.year?.toString() || 'Άγνωστο Έτος';

        if (!result[brand]) result[brand] = {};
        if (!result[brand][year]) result[brand][year] = [];

        result[brand][year].push(bike);
    });

    return result;
});

const selectedYear = ref('');

defineOptions({
    layout: MainLayout,
});
</script>

<template>
    <Head>
        <title>Brands</title>
        <meta name="description" content="Brands and their bikes" />
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://example.com/brands" />
        <meta property="og:title" content="Brands" />
        <meta property="og:description" content="Explore bikes by brands." />
        <meta property="og:image" content="https://example.com/images/brands-social.jpg" />
    </Head>

    <div class="py-20">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm text-gray-600" aria-label="Breadcrumb">
            <ol class="list-reset flex items-center">
                <li v-for="(crumb, index) in breadcrumb" :key="index" class="flex items-center">
                    <Link :href="crumb.url" class="px-2 hover:underline">{{ crumb.label }}</Link>
                    <span v-if="index < breadcrumb.length - 1">/</span>
                </li>
            </ol>
        </nav>

        <!-- Page title -->
        <h1 class="mb-4 text-2xl font-bold">{{ brand.name }}</h1>
        <p class="mb-6 max-w-[1200px]">{{ brand.description }}</p>

        <Link class="mt-6 inline-flex items-center gap-2 bg-black px-6 py-1 text-base text-white" href="/categories">
            <ArrowLeftIcon class="h-5 w-5" />
            Επιστροφή
        </Link>

        <!-- Filter by Year -->
        <div class="my-10 flex flex-wrap gap-6">
            <div>
                <label class="mb-1 block font-medium">Φίλτρο κατά Έτος</label>
                <select v-model="selectedYear" class="rounded border p-2">
                    <option value="">Όλα</option>
                    <option v-for="year in years" :key="year" :value="year">
                        {{ year }}
                    </option>
                </select>
            </div>
        </div>

        <!-- Grouped Bikes by Brand and Year -->
        <div v-if="Object.keys(groupedBikes).length">
            <div v-for="(years, brand) in groupedBikes" :key="brand" class="mb-10">
                <h2 class="mb-2 text-xl font-bold">{{ brand }}</h2>
                <div v-for="(bikes, year) in years" :key="year" class="mb-6">
                    <h3 class="mb-2 text-lg font-semibold">{{ year }}</h3>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        <div v-for="bike in bikes" :key="bike.id">
                            <div class="group relative overflow-hidden rounded-lg bg-white shadow-lg">
                                <!-- Compare Button (shown on hover) -->
                                <button
                                    @click="compareBike(bike)"
                                    class="absolute top-1/2 right-2 z-10 -translate-y-1/2 cursor-pointer rounded-full bg-white p-2 text-gray-700 opacity-0 opacity-100 shadow-lg group-hover:opacity-100 hover:bg-gray-100 md:opacity-0 md:group-hover:opacity-100"
                                    title="Σύγκριση μοντέλου"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 6h4V4H4v2zm6 0h4V4h-4v2zM4 12h4v-2H4v2zm6 0h4v-2h-4v2zM4 18h4v-2H4v2zm6 0h4v-2h-4v2zM16 6h4V4h-4v2zm0 6h4v-2h-4v2zm0 6h4v-2h-4v2z"
                                        />
                                    </svg>
                                </button>

                                <Link :href="`/bike/${bike.slug}`" class="block p-4">
                                    <span class="absolute top-2 right-2 rounded bg-black px-2 py-1 text-xs font-bold text-white">
                                        Από {{ Math.floor(bike.price) }} €</span
                                    >
                                    <img :src="`/storage/${bike.image}`" :alt="bike.title" class="h-48 w-full bg-white object-contain" />
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
        <div v-else class="mt-10 text-center text-gray-500">Δεν βρέθηκαν αποτελέσματα.</div>

        <CompareBar ref="compareBarRef" />
    </div>
</template>
