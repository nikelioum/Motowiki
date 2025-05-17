<script setup lang="ts">
import { ref, watch, onMounted, onUnmounted } from 'vue'
import { Link, router } from '@inertiajs/vue3'

const searchQuery = ref('')
const showModal = ref(false)

// Dynamic data
const popularBrands = ref([])
const popularCategories = ref([])
const popularBikes = ref([])

// Live search results for bikes based on user input
const searchResults = ref([])

// Loading state for live search
const isSearching = ref(false)

// Debounce helper function
function debounce(fn: Function, delay = 300) {
    let timeout: ReturnType<typeof setTimeout>
    return (...args: any[]) => {
        clearTimeout(timeout)
        timeout = setTimeout(() => fn(...args), delay)
    }
}

const openModal = () => {
    showModal.value = true
    fetchRecommendations()
}

const closeModal = () => {
    showModal.value = false
    searchQuery.value = ''
    searchResults.value = []
}

const handleKeyDown = (e: KeyboardEvent) => {
    if (e.key === 'Escape') closeModal()
}

const fetchRecommendations = async () => {
    try {
        const response = await fetch('/search/recommendations')
        if (!response.ok) throw new Error('Failed to fetch recommendations')
        const data = await response.json()
        popularBrands.value = data.popularBrands
        popularCategories.value = data.popularCategories
        popularBikes.value = data.popularBikes
    } catch (error) {
        console.error(error)
    }
}

// Live search bikes API call
const fetchBikeSearchResults = async (query: string) => {
    if (query.length < 3) {
        searchResults.value = []
        return
    }
    isSearching.value = true
    try {
        const res = await fetch(`/bikes/search?q=${encodeURIComponent(query)}`)
        if (!res.ok) throw new Error('Failed to fetch bikes')
        const data = await res.json()
        searchResults.value = data.bikes || []
    } catch (error) {
        console.error(error)
        searchResults.value = []
    } finally {
        isSearching.value = false
    }
}

// Debounced version of live search
const debouncedSearch = debounce(fetchBikeSearchResults, 300)

// Watch for changes in searchQuery to trigger live search
watch(searchQuery, (newQuery) => {
    if (newQuery.length >= 3) {
        debouncedSearch(newQuery)
    } else {
        searchResults.value = []
    }
})

onMounted(() => {
    window.addEventListener('keydown', handleKeyDown)
})

onUnmounted(() => {
    window.removeEventListener('keydown', handleKeyDown)
})

// Handle Inertia link clicks and close modal
const goTo = (url: string) => {
    closeModal()
    router.visit(url)
}
</script>

<template>
    <div>
        <!-- Search Input -->
        <input
            type="search"
            v-model="searchQuery"
            placeholder="Αναζήτηση..."
            class="border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-black"
            @focus="openModal"
        />

        <!-- Modal -->
        <Teleport to="body">
            <div
                v-if="showModal"
                class="fixed inset-0 bg-black/40 z-50 flex items-start justify-center pt-24"
                @click.self="closeModal"
            >
                <div class="bg-white rounded-xl shadow-lg w-full max-w-3xl p-6 relative">
                    <!-- Close Button -->
                    <button
                        @click="closeModal"
                        class="absolute top-4 right-4 text-gray-500 hover:text-black text-xl cursor-pointer"
                        aria-label="Close"
                    >
                        &times;
                    </button>

                    <!-- Title -->
                    <div class="text-lg py-4 font-semibold">Αναζήτηση</div>

                    <!-- Modal Search Input -->
                    <input
                        type="search"
                        v-model="searchQuery"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black"
                        placeholder="Αναζήτηση προϊόντων..."
                        @keydown.enter.prevent
                    />

                    <!-- Live Search Results -->
                    <!-- Search Results Grid -->
                    <div v-if="searchResults.length > 0" class="grid grid-cols-3 md:grid-cols-3 gap-6 mt-6">
                        <div
                            v-for="bike in searchResults"
                            :key="bike.id"
                            class="p-4 rounded-lg border border-gray-200 shadow hover:shadow-md transition cursor-pointer"
                        >
                            <Link :href="`/bike/${bike.slug}`" @click="() => closeModal()" class="block text-center">
                                <img
                                    :src="`/storage/${bike.image}`"
                                    :alt="bike.name"
                                    class="w-full h-32 object-contain mx-auto mb-3"
                                />
                                <div class="text-sm font-medium text-gray-800">{{ bike.name }}</div>
                                {{bike.category.title}}
                                {{bike.brand.name}}
                            </Link>
                        </div>
                    </div>

                    <!-- No Results Message -->
                    <div v-else-if="searchQuery.length >= 3" class="mt-6 text-center text-gray-500 font-medium">
                        Δεν βρέθηκαν αποτελέσματα.
                    </div>

                    <div class="mt-6 max-h-[300px] overflow-y-auto space-y-6">
                    <!-- Recommendations Grid -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Popular Brands -->
                        <div>
                            <p class="text-sm text-gray-500 mb-2">Δημοφιλής Μάρκες:</p>
                            <ul class="space-y-3">
                                <li
                                    v-for="brand in popularBrands"
                                    :key="brand.id"
                                    class="hover:bg-gray-100 p-2 rounded cursor-pointer flex items-center gap-3"
                                >
                                    <Link
                                        :href="`/brand/${brand.slug}`"
                                        class="flex items-center gap-3 w-full"
                                        @click="() => closeModal()"
                                    >
                                        <img
                                            :src="`/storage/${brand.image}`"
                                            :alt="brand.name"
                                            class="w-12 h-12 object-contain rounded"
                                        />
                                        <span>{{ brand.name }}</span>
                                    </Link>
                                </li>
                            </ul>
                        </div>

                        <!-- Popular Categories -->
                        <div>
                            <p class="text-sm text-gray-500 mb-2">Δημοφιλής Κατηγορίες:</p>
                            <ul class="space-y-3">
                                <li
                                    v-for="category in popularCategories"
                                    :key="category.id"
                                    class="hover:bg-gray-100 p-2 rounded cursor-pointer flex items-center gap-3"
                                >
                                    <Link
                                        :href="`/category/${category.slug}`"
                                        class="flex items-center gap-3 w-full"
                                        @click="() => closeModal()"
                                    >
                                        <img
                                            :src="`/storage/${category.image}`"
                                            :alt="category.title"
                                            class="w-12 h-12 object-contain rounded"
                                        />
                                        <span>{{ category.title }}</span>
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <!-- Popular Bikes Section (4 columns) -->
                    <div class="mt-10">
                        <p class="text-sm text-gray-500 mb-4">Δημοφιλή Μοντέλα Μοτοσυκλετών:</p>
                        <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                            <div
                                v-for="bike in popularBikes"
                                :key="bike.id"
                                class="p-4 rounded-lg border border-gray-200 shadow hover:shadow-md transition cursor-pointer"
                            >
                                <Link :href="`/bike/${bike.slug}`" @click="() => closeModal()" class="block text-center">
                                    <img
                                        :src="`/storage/${bike.image}`"
                                        :alt="bike.name"
                                        class="w-full h-32 object-contain mx-auto mb-3"
                                    />
                                    <div class="text-sm font-medium text-gray-800">{{ bike.name }}</div>
                                </Link>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </Teleport>
    </div>
</template>
