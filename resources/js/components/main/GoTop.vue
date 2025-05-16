<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import { ArrowUpIcon } from '@heroicons/vue/24/solid'

const showButton = ref(false)

const handleScroll = () => {
    showButton.value = window.scrollY > 90
}

const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' })
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
})
</script>

<template>
    <button
        v-if="showButton"
        @click="scrollToTop"
        class="fixed cursor-pointer bottom-6 right-6 z-50 w-12 h-12 rounded-full bg-gray-700 text-white flex items-center justify-center shadow-lg hover:bg-gray-900 transition"
    >
        <ArrowUpIcon class="w-6 h-6" />
    </button>
</template>
