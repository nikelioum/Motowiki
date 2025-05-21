<script setup lang="ts">
import MainLayout from '@/layouts/Main.vue';
import { Link, Head } from '@inertiajs/vue3';
import { defineProps, ref, computed } from 'vue';
import Review from '@/components/bike/Review.vue';

const props = defineProps({
    bike: Object,
    breadcrumb: Array,
});

defineOptions({
    layout: MainLayout,
});

// Group spec_values by spec_category
const groupedSpecs = computed(() => {
    const groups = {};

    props.bike.spec_values.forEach(specValue => {
        const categoryName = specValue.spec?.spec_category?.name || 'Άγνωστη Κατηγορία';

        if (!groups[categoryName]) {
            groups[categoryName] = [];
        }

        groups[categoryName].push(specValue);
    });

    return groups;
});

// Set initial selected tab
const selectedTab = ref(Object.keys(groupedSpecs.value)[0] || '');
</script>

<template>
    <Head>
        <title>{{ bike.name }} | Moto Showcase</title>
        <meta name="description" :content="bike.description">
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
                <li v-for="(crumb, index) in props.breadcrumb" :key="index" class="flex items-center">
                    <Link :href="crumb.url" class="hover:underline px-2">{{ crumb.label }}</Link>
                    <span v-if="index < props.breadcrumb.length - 1">/</span>
                </li>
            </ol>
        </nav>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left: Bike Image -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img :src="`/storage/${bike.image}`" :alt="bike.title" class="w-full object-contain bg-white" />
            </div>

            <!-- Right: Bike Info -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900">{{ bike.name }}</h2>
                <div class="py-5 text-xl font-bold text-gray-900">Από {{ Math.floor(bike.price) }}€</div>
                <p class="text-gray-700 text-base">{{ bike.description }}</p>

                <ul class="text-gray-700 text-lg space-y-3 py-10">
                    <li><strong>Έτος:</strong> {{ bike.year }}</li>
                    <li>
                        <strong>Κατηγορία:</strong>
                        <Link :href="`/category/${bike.category.slug}`">{{ bike.category?.title }}</Link>
                    </li>
                    <li>
                        <strong>Κατασκευαστής:</strong>
                        <Link :href="`/brand/${bike.brand.slug}`">{{ bike.brand?.name }}</Link>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Specs Section Below -->
        <div class="mt-16">
            <h3 class="text-2xl font-bold mb-4">Χαρακτηριστικά</h3>

            <!-- Tabs -->
            <div class="flex flex-wrap border-b border-gray-300 mb-4">
                <button
                    v-for="(specs, category) in groupedSpecs"
                    :key="category"
                    @click="selectedTab = category"
                    class="py-2 px-4 text-sm font-medium hover:text-gray-800 hover:cursor-pointer"
                    :class="{
                        'border-b-2 border-gray-900 text-gray-600': selectedTab === category,
                        'text-gray-600': selectedTab !== category
                    }"
                >
                    {{ category }}
                </button>
            </div>

            <!-- Tab Content -->
            <div v-if="selectedTab">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <div
                        v-for="spec in groupedSpecs[selectedTab]"
                        :key="spec.id"
                        class="bg-gray-50 p-4 rounded shadow"
                    >
                        <strong>{{ spec.spec?.label || spec.spec?.name }}:</strong> {{ spec.value }}
                    </div>
                </div>
            </div>
        </div>

        <Review :bike-id="bike.id" />
    </div>
</template>

