<script setup lang="ts">
import { ref, onMounted } from 'vue'

// Accept `faqs` as a prop
const props = defineProps<{
    faqs: {
        id: number
        question: string
        answer: string
    }[]
}>()

// Create reactive open/close state per FAQ
const openStates = ref<boolean[]>([])

onMounted(() => {
    // Initialize open state to false for each FAQ
    openStates.value = props.faqs.map(() => false)
})

function toggle(index: number) {
    openStates.value[index] = !openStates.value[index]
}
</script>

<template>
    <section class="max-w-3xl mx-auto px-4 py-10">
        <h2 class="text-2xl font-bold text-center mb-6">Frequently Asked Questions</h2>
        <div v-for="(faq, index) in faqs" :key="faq.id ?? index" class="border-b py-4">
            <button
                class="w-full text-left flex justify-between items-center font-medium text-lg cursor-pointer"
                @click="toggle(index)"
            >
                {{ faq.question }}
                <svg
                    :class="{ 'rotate-180': openStates[index] }"
                    class="w-5 h-5 transition-transform duration-300"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7"
                    />
                </svg>
            </button>
            <div
                v-show="openStates[index]"
                class="mt-2 text-gray-600 transition-all duration-300"
            >
                {{ faq.answer }}
            </div>
        </div>
    </section>
</template>
