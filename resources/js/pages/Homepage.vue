<script setup lang="ts">
import MainLayout from '@/layouts/Main.vue'
import Intro from '@/components/Homepage/Header.vue'
import TopBrands from '@/components/Homepage/TopBrands.vue'
import Newsletter from '@/components/Homepage/Newsletter.vue';

// Receive the brands prop from the controller
defineProps({
    brands: Array,
})

defineOptions({
    layout: MainLayout
});
</script>

<template>
    <Intro />
    <TopBrands :brands="brands" />
</template>
