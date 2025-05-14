<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import { Link } from '@inertiajs/vue3'
import Topbar from '@/components/header/Topbar.vue'

const isOpen = ref(false)
const scrollPosition = ref(0)
const toggleMenu = () => {
    isOpen.value = !isOpen.value
}

const handleScroll = () => {
    scrollPosition.value = window.scrollY
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
})
</script>

<template>
    <Topbar />
    <header :class="{'fixed top-0 left-0 w-full bg-white border-b shadow z-50': scrollPosition > 90}" class="transition-all">
        <div class="max-w-[1720px] mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Logo -->
            <a href="/" class="text-2xl font-bold text-gray-800">
                <img src="/images/logo.png" alt="MotoWiki" class="w-[170px]">
            </a>

            <!-- Centered Menu -->
            <nav class="hidden md:flex space-x-6 ml-10">
                <Link href="/" class="text-gray-900 text-lg hover:text-black">Αρχική</Link>
                <Link href="/categories" class="text-gray-900 text-lg hover:text-black">Κατηγορίες</Link>
                <Link href="/brands" class="text-gray-900 text-lg hover:text-black">Εταιρείες</Link>
                <Link href="/vendors" class="text-gray-900 text-lg hover:text-black">Αντιπροσωπίες</Link>
                <Link href="/about" class="text-gray-900 text-lg hover:text-black">Σχετικά</Link>
            </nav>

            <!-- Buttons Right -->
            <div class="hidden md:flex space-x-3">
                <Link href="/login" class="px-4 py-2 border border-black text-black  hover:bg-black hover:text-white transition">Σύνδεση</Link>
                <Link href="/register" class="px-4 py-2 bg-black text-white hover:opacity-90 transition">Εγγραφή</Link>
            </div>

            <!-- Mobile Hamburger -->
            <button @click="toggleMenu" class="md:hidden text-gray-700 focus:outline-none">
                <!-- Hamburger Icon (when menu is closed) -->
                <svg v-if="!isOpen" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>

                <!-- Close Icon (when menu is open) -->
                <svg v-if="isOpen" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Dropdown -->
        <div v-if="isOpen" class="md:hidden px-5 pb-4 space-y-2 bg-white">
            <Link href="/" class="block text-gray-900 text-lg hover:text-black">Αρχική</Link>
            <Link href="/categories" class="block text-gray-900 text-lg hover:text-black">Κατηγορίες</Link>
            <Link href="/brands" class="block text-gray-900 text-lg hover:text-black">Εταιρείες</Link>
            <Link href="/vendors" class="block text-gray-900 text-lg hover:text-black">Αντιπροσωπίες</Link>
            <Link href="/about" class="block text-gray-900 text-lg hover:text-black">Σχετικά</Link>

            <!-- Buttons in mobile -->
            <div class="pt-4 space-y-2">
                <Link href="/login" class="block text-center px-4 py-2 border border-black text-black hover:bg-black hover:text-white transition">Σύνδεση</Link>
                <Link href="/register" class="block text-center px-4 py-2 bg-black text-white hover:opacity-90 transition">Εγγραφή</Link>
            </div>
        </div>
    </header>
</template>
