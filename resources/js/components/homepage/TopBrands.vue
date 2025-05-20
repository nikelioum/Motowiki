<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import { ArrowRightIcon } from '@heroicons/vue/24/outline';

// Define the prop for brands, expecting an array
const props = defineProps({
    brands: Array
});

</script>

<template>
    <div class="py-12">
        <h1 class="text-3xl font-bold text-center mb-10">Δημοφιλής Μάρκες</h1>

        <!-- Brands Grid -->
        <div class="grid grid-cols-3 gap-6 sm:grid-cols-3 md:grid-cols-6 lg:grid-cols-6 pt-12 pb-12">
            <!-- Loop through the brands and display each one -->
            <div v-for="brand in props.brands" :key="brand.id">
                <!-- Card -->
                <div class="overflow-hidden rounded-lg bg-white shadow-lg">
                    <!-- Link to brand page -->
                    <Link :href="`/brand/${brand.slug}`" class="block p-4">
                        <!-- Brand image -->
                        <img :src="`/storage/${brand.image}`" :alt="brand.name" class="h-20 w-full object-contain bg-white" />

<!--                        <div class="p-4">-->
<!--                            &lt;!&ndash; Brand name &ndash;&gt;-->
<!--                            <h3 class="mt-2 mb-2 text-center text-xl font-semibold">{{ brand.name }}</h3>-->
<!--                        </div>-->
                    </Link>
                </div>
            </div>
        </div>

        <!-- Centered Button -->
        <div class="flex justify-center mt-8">
            <Link href="/brands" class="inline-flex items-center px-6 py-2 border border-black text-black font-semibold text-center hover:bg-black hover:text-white transition-colors">
                <!-- Button Text -->
                Όλες οι μάρκες
                <!-- Heroicon -->
                <ArrowRightIcon class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-2" />
            </Link>
        </div>

    </div>
</template>


<style scoped>
</style>
