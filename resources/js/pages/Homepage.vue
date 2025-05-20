<script setup lang="ts">
import MainLayout from '@/layouts/Main.vue'
import Intro from '@/components/homepage/Header.vue'
import TopBrands from '@/components/homepage/TopBrands.vue'
import NewBikes from '@/components/homepage/NewBikes.vue'
import Faq from '@/components/homepage/Faq.vue'

defineProps({
    brands: Array,
    newBikes: Array,
    faqs: Array,
    slider: Array,
    banner: Array,
})

defineOptions({
    layout: MainLayout
});
</script>

<template>
    <Intro :slider="slider" :banner="banner"/>
    <TopBrands :brands="brands" />
    <NewBikes :newBikes="newBikes"/>
    <Faq :faqs="faqs"/>
</template>
