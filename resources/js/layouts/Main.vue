<script setup lang="ts">
import Navbar from '@/components/header/Navbar.vue'
import Footer from '@/components/footer/Footer.vue'
import Newsletter from '@/components/Homepage/Newsletter.vue'
</script>

<template>
<!--    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet" />-->
    <Navbar />
    <div class="bg-gray-100">
        <!-- Main content -->
        <main class="max-w-[1720px] mx-auto px-12 min-h-screen">
            <slot />
        </main>
    </div>
    <Newsletter />
    <Footer />
</template>
