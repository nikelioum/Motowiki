<script lang="ts" setup>
import { ref, onMounted, onUnmounted } from 'vue';

const showMiniNav = ref(false);

function handleScroll() {
    showMiniNav.value = window.scrollY > 90; // Show after scrolling 300px
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <nav
        v-show="showMiniNav"
        class="fixed top-16 left-0 right-0 bg-white shadow-md border-t border-b z-50 transition-opacity duration-300"
    >
        <div
            class="max-w-7xl mx-auto px-4 py-2 flex space-x-4 overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100"
            style="scroll-snap-type: x mandatory;"
        >
            <a
                href="#specs-section"
                class="text-black hover:underline font-semibold cursor-pointer flex-shrink-0 px-2 scroll-snap-align: start;"
            >Χαρακτηριστικά</a>
            <a
                href="#reviews-section"
                class="text-black hover:underline font-semibold cursor-pointer flex-shrink-0 px-2 scroll-snap-align: start;"
            >Αξιολογήσεις</a>
        </div>
    </nav>
</template>


<style scoped>
/* Optionally add fade in/out */
nav[v-cloak] {
    opacity: 0;
    transition: opacity 0.3s ease;
}
</style>
