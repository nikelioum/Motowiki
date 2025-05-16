<script setup lang="ts">
import { ref, onMounted, onUnmounted, watch } from 'vue'
import { usePage, Link } from '@inertiajs/vue3'
import Topbar from '@/components/header/Topbar.vue'

const isOpen = ref(false)
const accountDropdownOpen = ref(false)
const scrollPosition = ref(0)
const searchQuery = ref('')

const toggleMenu = () => {
    isOpen.value = !isOpen.value
}

const page = usePage()
watch(() => page.url, () => {
    isOpen.value = false
    accountDropdownOpen.value = false
})

const handleScroll = () => {
    scrollPosition.value = window.scrollY
}

// Dropdown hover timeout handling
let dropdownTimeout: ReturnType<typeof setTimeout>

const openDropdown = () => {
    clearTimeout(dropdownTimeout)
    accountDropdownOpen.value = true
}

const closeDropdown = () => {
    dropdownTimeout = setTimeout(() => {
        accountDropdownOpen.value = false
    }, 200)
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

    <header
        :class="{ 'fixed top-0 left-0 w-full bg-white border-b shadow z-50': scrollPosition > 90 }"
        class="transition-all"
    >
        <div class="max-w-[1720px] mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between relative">
            <!-- Left: Logo -->
            <a href="/" class="text-2xl font-bold text-gray-800 z-10">
                <img src="/images/logo.png" alt="MotoWiki" class="w-[170px]" />
            </a>

            <!-- Center: Menu -->
            <nav class="hidden md:flex space-x-6 absolute left-1/2 transform -translate-x-1/2">
                <Link href="/" class="text-gray-900 text-lg hover:text-black">Αρχική</Link>
                <Link href="/categories" class="text-gray-900 text-lg hover:text-black">Κατηγορίες</Link>
                <Link href="/brands" class="text-gray-900 text-lg hover:text-black">Εταιρείες</Link>
                <Link href="/vendors" class="text-gray-900 text-lg hover:text-black">Αντιπροσωπίες</Link>
                <Link href="/about" class="text-gray-900 text-lg hover:text-black">Σχετικά</Link>
            </nav>

            <!-- Right: Search & Account -->
            <div class="hidden md:flex items-center space-x-2 z-10">
                <input
                    type="search"
                    v-model="searchQuery"
                    placeholder="Αναζήτηση..."
                    class="border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-black"
                    @keydown.enter.prevent="() => { if(searchQuery) window.location.href = `/search?q=${encodeURIComponent(searchQuery)}` }"
                />

                <!-- Account Dropdown -->
                <div class="relative" @mouseenter="openDropdown" @mouseleave="closeDropdown">
                    <button
                        id="account-button"
                        class="flex items-center space-x-1 py-2 cursor-pointer"
                        type="button"
                    >
                        <span>Ο Λογαριασμός μου</span>
                        <svg
                            :class="{'transform rotate-180': accountDropdownOpen, 'transform rotate-0': !accountDropdownOpen}"
                            class="w-4 h-4 transition-transform duration-200"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M6 9l6 6 6-6" />
                        </svg>
                    </button>

                    <div
                        id="account-dropdown"
                        v-show="accountDropdownOpen"
                        class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg z-50"
                    >
                        <Link
                            href="/login"
                            class="block px-4 py-2 text-gray-900 hover:bg-gray-100 transition"
                            @click="accountDropdownOpen = false"
                        >
                            Σύνδεση
                        </Link>
                        <Link
                            href="/register"
                            class="block px-4 py-2 text-gray-900 hover:bg-gray-100 transition"
                            @click="accountDropdownOpen = false"
                        >
                            Εγγραφή
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Mobile Hamburger -->
            <button @click="toggleMenu" class="md:hidden text-gray-700 focus:outline-none z-10">
                <svg
                    v-if="!isOpen"
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg
                    v-else
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
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

            <!-- Mobile Search -->
            <div class="pt-2">
                <input
                    type="search"
                    v-model="searchQuery"
                    placeholder="Αναζήτηση..."
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black"
                    @keydown.enter.prevent="() => { if(searchQuery) window.location.href = `/search?q=${encodeURIComponent(searchQuery)}` }"
                />
            </div>

            <!-- Auth Links -->
            <div class="pt-4 space-y-2">
                <Link
                    href="/login"
                    class="block text-center px-4 py-2 border border-black text-black hover:bg-black hover:text-white transition"
                    @click="isOpen = false"
                >
                    Σύνδεση
                </Link>
                <Link
                    href="/register"
                    class="block text-center px-4 py-2 bg-black text-white hover:opacity-90 transition"
                    @click="isOpen = false"
                >
                    Εγγραφή
                </Link>
            </div>
        </div>
    </header>
</template>
