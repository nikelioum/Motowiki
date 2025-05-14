<script setup lang="ts">
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3';
import { ArrowRightIcon } from '@heroicons/vue/24/outline';

// Define the prop for new bikes, expecting an array
const props = defineProps({
    newBikes: Array
});
</script>

<template>
    <div class="py-12">
        <h1 class="text-3xl font-bold text-center mb-10">Νέες Μοτοσυκλέτες</h1>

        <!-- Brands Grid -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 pt-12 pb-12">
            <!-- Loop through the brands and display each one -->
            <div v-for="bike in props.newBikes" :key="bike.id">
                <!-- Card -->
                <div class="overflow-hidden rounded-lg bg-white shadow-lg">
                    <Link :href="`/bike/${bike.slug}`" class="block p-4">
                        <!-- Brand image -->
                        <img :src="`/storage/${bike.image}`" :alt="bike.name" class="h-48 w-full object-contain bg-white" />

                        <div class="p-4">
                            <!-- Brand name -->
                            <h3 class="mt-2 mb-2 text-center text-xl font-semibold">{{ bike.name }}</h3>
                        </div>
                    </Link>
                </div>
            </div>
        </div>

    </div>
</template>


<style scoped>
</style>
