<script setup lang="ts">
import { ref } from 'vue'

const faqs = ref([
    {
        question: 'What is your return policy?',
        answer: 'You can return any item within 30 days of purchase with a receipt.',
        open: false,
    },
    {
        question: 'Do you offer financing for new bikes?',
        answer: 'Yes, we offer flexible financing options through our partners.',
        open: false,
    },
    {
        question: 'Can I test ride a bike before buying?',
        answer: 'Absolutely! Book a test ride at any of our partner stores.',
        open: false,
    },
])

function toggle(index: number) {
    faqs.value[index].open = !faqs.value[index].open
}
</script>

<template>
    <section class="max-w-3xl mx-auto px-4 py-10">
        <h2 class="text-2xl font-bold text-center mb-6">Frequently Asked Questions</h2>
        <div v-for="(faq, index) in faqs" :key="index" class="border-b py-4">
            <button
                class="w-full text-left flex justify-between items-center font-medium text-lg cursor-pointer"
                @click="toggle(index)"
            >
                {{ faq.question }}
                <svg
                    :class="{ 'rotate-180': faq.open }"
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
                v-show="faq.open"
                class="mt-2 text-gray-600 transition-all duration-300"
            >
                {{ faq.answer }}
            </div>
        </div>
    </section>
</template>
