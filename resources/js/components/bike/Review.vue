<script lang="ts" setup>
import { ref, computed, onMounted } from 'vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps<{
    bikeId: number
}>()

const hasSubmitted = ref(false)
const showForm = ref(false)
const allReviews = ref<Array<{
    id: number,
    name: string,
    stars: number,
    text: string,
    created_at: string,
}>>([])

const loading = ref(true)
const error = ref<string | null>(null)

// You can change this number to control how many reviews are shown per step
const reviewsPerPage = 6
const visibleCount = ref(reviewsPerPage)

const visibleReviews = computed(() => {
    return allReviews.value.slice(0, visibleCount.value)
})

const form = useForm({
    bike_id: props.bikeId,
    name: '',
    email: '',
    stars: 5,
    text: '',
})

const fetchReviews = async () => {
    loading.value = true
    error.value = null
    try {
        const res = await fetch(`/bikes/${props.bikeId}/reviews`)
        if (!res.ok) throw new Error('Failed to fetch reviews')
        const data = await res.json()
        allReviews.value = data ?? []
    } catch (e: any) {
        error.value = e.message || 'Error loading reviews'
    } finally {
        loading.value = false
    }
}

onMounted(() => {
    fetchReviews()
    const cookieName = `reviewed_bike_${props.bikeId}`
    hasSubmitted.value = document.cookie.split('; ').some(row => row.startsWith(`${cookieName}=`))
})

const submit = () => {
    form.post(route('reviews.store'), {
        onSuccess: () => {
            form.reset('name', 'email', 'stars', 'text')
            showForm.value = false
            fetchReviews()

            // Set cookie for 30 days
            const cookieName = `reviewed_bike_${props.bikeId}`
            const expires = new Date()
            expires.setDate(expires.getDate() + 30)
            document.cookie = `${cookieName}=true;expires=${expires.toUTCString()};path=/`
            hasSubmitted.value = true
        }
    })
}

const starArray = computed(() => [1, 2, 3, 4, 5])

const setStars = (n: number) => {
    form.stars = n
}

const loadMore = () => {
    visibleCount.value += reviewsPerPage
}
</script>

<template>
    <div class="py-20 max-w-[1200px] space-y-6">
        <!-- Reviews List -->
        <div>
            <h3 class="text-xl font-semibold mb-4">Αξιολογήσεις</h3>
            <div v-if="loading" class="italic text-gray-600">Φόρτωση αξιολογήσεων...</div>
            <div v-else-if="error" class="text-red-500">{{ error }}</div>
            <div v-else-if="allReviews.length === 0" class="italic text-gray-600">Δεν υπάρχουν ακόμα κριτικές.</div>
            <div v-else class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div
                    v-for="review in visibleReviews"
                    :key="review.id"
                    class="border p-4 rounded shadow-sm"
                >
                    <div class="flex items-center space-x-2 mb-2">
                        <strong>{{ review.name }}</strong>
                        <div class="flex">
                            <template v-for="n in starArray" :key="n">
                                <svg
                                    class="w-5 h-5"
                                    :class="n <= review.stars ? 'text-yellow-400' : 'text-gray-300'"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.163c.969 0 1.371 1.24.588 1.81l-3.37 2.447a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.37-2.447a1 1 0 00-1.175 0l-3.37 2.447c-.784.57-1.838-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.037 9.384c-.783-.57-.38-1.81.588-1.81h4.163a1 1 0 00.95-.69l1.286-3.957z" />
                                </svg>
                            </template>
                        </div>
                    </div>
                    <p class="text-gray-700 whitespace-pre-line">{{ review.text }}</p>
                    <div class="text-xs text-gray-400 mt-1">{{ new Date(review.created_at).toLocaleDateString() }}</div>
                </div>

                <div v-if="visibleReviews.length < allReviews.length" class="text-center">
                    <button @click="loadMore" class="mt-4 text-sm text-black underline cursor-pointer">
                        Φόρτωσε περισσότερα
                    </button>
                </div>
            </div>
        </div>

        <!-- Toggle Review Form -->
        <!-- Toggle Review Form -->
        <button v-if="!hasSubmitted" @click="showForm = !showForm" class="text-dark px-4 py-2 cursor-pointer">
            {{ showForm ? 'Απόκρυψη' : 'Γράψε μια αξιολόγηση' }}
        </button>

        <!-- Review Form -->
        <form v-if="showForm" @submit.prevent="submit" class="bg-white p-6 shadow rounded space-y-4">
            <div>
                <label class="block mb-1 font-semibold"></label>
                <div class="flex space-x-1">
                    <template v-for="n in starArray" :key="n">
                        <svg
                            @click="setStars(n)"
                            class="w-8 h-8 cursor-pointer"
                            :class="n <= form.stars ? 'text-yellow-400' : 'text-gray-300'"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.163c.969 0 1.371 1.24.588 1.81l-3.37 2.447a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.37-2.447a1 1 0 00-1.175 0l-3.37 2.447c-.784.57-1.838-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.037 9.384c-.783-.57-.38-1.81.588-1.81h4.163a1 1 0 00.95-.69l1.286-3.957z" />
                        </svg>
                    </template>
                </div>
                <div v-if="form.errors.stars" class="text-red-500 text-sm mt-1">{{ form.errors.stars }}</div>
            </div>

            <div class="flex space-x-4">
                <div class="flex-1">
                    <label class="block mb-1 font-semibold">Όνομα *</label>
                    <input v-model="form.name" type="text" class="w-full border rounded p-2" />
                    <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
                </div>

                <div class="flex-1">
                    <label class="block mb-1 font-semibold">Email *</label>
                    <input v-model="form.email" type="email" class="w-full border rounded p-2" />
                    <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
                </div>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Αξιολόγηση</label>
                <textarea v-model="form.text" class="w-full border rounded p-2" rows="4"></textarea>
                <div v-if="form.errors.text" class="text-red-500 text-sm mt-1">{{ form.errors.text }}</div>
            </div>

            <button type="submit" :disabled="form.processing" class="bg-black text-white px-4 py-2 rounded cursor-pointer">
                Αποστολή
            </button>
        </form>

        <div v-if="form.recentlySuccessful" class="text-green-600 mt-2">
            Σε ευχαριστούμε. Η αξιολογήση σου θα εμφανιστεί όταν εγκριθεί.
        </div>
    </div>
</template>
