<script setup lang="ts">
import { ref, onMounted, watch } from 'vue'
import { useForm } from '@inertiajs/vue3'

const showBanner = ref(false)
const showForm = ref(false)
const submitted = ref(false)

const moods = [
    { emoji: '👎', label: 'Κακό' },
    { emoji: '🙂', label: 'Καλό' },
    { emoji: '😃', label: 'Πολύ Καλό' },
    { emoji: '🌟', label: 'Εξαιρετικό' },
]

const form = useForm({
    mood: '',
    feedback: '',
})

function cookieExists(name: string) {
    return document.cookie.split(';').some(c => c.trim().startsWith(name + '='))
}

onMounted(() => {
    if (!cookieExists('review_prompt_dismissed')) {
        setTimeout(() => {
            showBanner.value = true
        }, 5000)
    }
})

const dismiss = () => {
    const date = new Date()
    date.setFullYear(date.getFullYear() + 1)
    document.cookie = `review_prompt_dismissed=true; expires=${date.toUTCString()}; path=/`
    showBanner.value = false
    submitted.value = false
    showForm.value = false
    form.reset()
}

const submitFeedback = () => {
    if (form.mood === '') {
        alert('Παρακαλώ επέλεξε διάθεση πριν υποβάλεις.')
        return
    }

    form.post('/feedback', {
        preserveScroll: true,
        onSuccess: () => {
            submitted.value = true
            const date = new Date()
            date.setFullYear(date.getFullYear() + 1)
            document.cookie = `review_prompt_dismissed=true; expires=${date.toUTCString()}; path=/`
        },
        onError: () => {
            // handle errors if needed
        },
    })
}

// Auto close banner 3 seconds after successful submission
watch(submitted, (newVal) => {
    if (newVal) {
        setTimeout(() => {
            showBanner.value = false
            submitted.value = false
            showForm.value = false
            form.reset()
        }, 3000)
    }
})
</script>

<template>
    <div
        v-if="showBanner"
        class="fixed bottom-4 left-4 bg-white border border-black shadow-lg p-4 max-w-sm w-full z-50"
    >
        <div v-if="submitted">
            <p class="text-green-700 font-medium text-sm">Ευχαριστούμε για το σχόλιό σου!</p>
            <!-- No close button here -->
        </div>

        <div v-else-if="showForm">
            <p class="text-sm text-gray-800 mb-2 font-semibold">Το σχόλιό σου:</p>

            <!-- Mood selector -->
            <div class="mb-4 flex gap-6 text-3xl justify-center">
                <label
                    v-for="mood in moods"
                    :key="mood.label"
                    class="cursor-pointer flex flex-col items-center select-none"
                >
                    <input
                        type="radio"
                        name="mood"
                        :value="mood.emoji"
                        v-model="form.mood"
                        class="hidden"
                    />
                    <span
                        :class="{
              'scale-125 text-black': form.mood === mood.emoji,
              'opacity-50 text-gray-400': form.mood !== mood.emoji
            }"
                        :title="mood.label"
                    >
            {{ mood.emoji }}
          </span>
                    <span class="text-xs mt-1 text-gray-700">{{ mood.label }}</span>
                </label>
            </div>

            <textarea
                v-model="form.feedback"
                class="w-full border border-gray-300 p-2 mb-3 text-sm focus:outline-none focus:ring-1 focus:ring-black"
                rows="4"
                placeholder="Γράψε την άποψή σου εδώ... (προαιρετικό)"
                name="message"
            ></textarea>

            <div class="flex flex-col gap-2">
                <button
                    @click="submitFeedback"
                    class="bg-black text-white px-4 py-2 cursor-pointer hover:bg-gray-900 transition"
                    :disabled="form.processing"
                >
                    Υποβολή
                </button>
                <button
                    @click="dismiss"
                    class="bg-white text-black cursor-pointer border border-black px-4 py-2 hover:bg-gray-100 transition"
                >
                    Άκυρο
                </button>
            </div>
        </div>

        <div v-else>
            <p class="text-sm text-gray-800 mb-3">
                Βοήθησέ μας να βελτιωθούμε! Θες να αφήσεις ένα σχόλιο;
            </p>
            <div class="flex flex-col gap-2">
                <button
                    @click="showForm = true"
                    class="bg-black text-white px-4 py-2 hover:bg-gray-900 transition cursor-pointer cursor-pointer"
                >
                    Ναι, φυσικά!
                </button>
                <button
                    @click="dismiss"
                    class="bg-white text-black border cursor-pointer border-black px-4 py-2 hover:bg-gray-100 transition cursor-pointer"
                >
                    Όχι ευχαριστώ
                </button>
            </div>
        </div>
    </div>
</template>
