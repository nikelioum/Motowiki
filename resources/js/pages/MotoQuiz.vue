<script setup lang="ts">
import MainLayout from '@/layouts/Main.vue';
import { Link, Head } from '@inertiajs/vue3';
import { defineProps, defineOptions, ref } from 'vue';

const props = defineProps({
    breadcrumb: Array,
});

defineOptions({
    layout: MainLayout,
});

const questions = [
    {
        text: 'Ποια είναι η αγαπημένη σου μάρκα μοτοσυκλέτας;',
        options: ['Honda', 'Yamaha', 'Kawasaki', 'Ducati'],
    },
    {
        text: 'Ποιο είδος μοτοσυκλέτας προτιμάς;',
        options: ['Sport', 'Touring', 'Adventure', 'Naked'],
    },
    {
        text: 'Ποιο είναι το εύρος του προϋπολογισμού σου;',
        options: [
            'Κάτω από 3.000€ (μεταχειρισμένα / οικονομικά μοντέλα)',
            '3.000€ - 7.000€',
            '7.000€ - 12.000€',
            'Άνω των 12.000€',
        ],
    },
    {
        text: 'Ποιο είναι το κύριο κριτήριο επιλογής σου;',
        options: ['Τιμή', 'Επιδόσεις', 'Άνεση', 'Εμφάνιση'],
    },
];

const answers = ref(Array(questions.length).fill(''));
const currentStep = ref(0);
const completed = ref(false);
const suggestedBikes = ref([]);
const loading = ref(false);

function nextStep() {
    if (currentStep.value < questions.length - 1) {
        currentStep.value++;
    } else {
        completed.value = true;
        loading.value = true;
        fetchResults();
    }
}

function prevStep() {
    if (currentStep.value > 0) {
        currentStep.value--;
    }
}

function restartQuiz() {
    answers.value = Array(questions.length).fill('');
    currentStep.value = 0;
    completed.value = false;
    loading.value = false;
    suggestedBikes.value = [];
}

async function fetchResults() {
    loading.value = true;
    try {
        const url = new URL('/moto-quiz-results', window.location.origin);
        answers.value.forEach((answer, index) => {
            url.searchParams.append(`answers[${index}]`, answer);
        });

        const response = await fetch(url.toString(), {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            },
        });

        if (!response.ok) throw new Error('Failed to fetch results');
        const data = await response.json();
        suggestedBikes.value = data.bikes || [];
    } catch (error) {
        console.error('Error fetching results:', error);
        suggestedBikes.value = [];
    } finally {
        loading.value = false;
    }
}
</script>

<template>
    <Head>
        <title>MotoQuiz</title>
        <meta name="description" content="Το Moto Wiki είναι η απόλυτη ψηφιακή εγκυκλοπαίδεια για τον κόσμο των μοτοσυκλετών." />
    </Head>

    <div class="py-20 mx-auto">
        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-600 mb-6" aria-label="Breadcrumb">
            <ol class="list-reset flex items-center">
                <li v-for="(crumb, index) in props.breadcrumb" :key="index" class="flex items-center">
                    <Link :href="crumb.url" class="hover:underline px-2">{{ crumb.label }}</Link>
                    <span v-if="index < props.breadcrumb.length - 1">/</span>
                </li>
            </ol>
        </nav>

        <h1 class="mb-4 text-2xl font-bold">MotoQuiz</h1>
        <p class="mb-6">
            Το Moto Wiki είναι η απόλυτη ψηφιακή εγκυκλοπαίδεια για τον κόσμο των μοτοσυκλετών. Εξερευνήστε μάρκες,
            μοντέλα, τεχνικά χαρακτηριστικά, συγκρίσεις και μάθετε τα πάντα γύρω από τη μοτοσυκλέτα που σας ενδιαφέρει.
            Η γνώση είναι ελευθερία — και η ελευθερία είναι πάνω σε δύο τροχούς.
        </p>

        <!-- Quiz Form -->
        <div v-if="!completed" class="bg-white shadow-md rounded-lg p-8 mt-30">
            <p class="mb-4 font-semibold text-gray-600">Βήμα {{ currentStep + 1 }} / {{ questions.length }}</p>
            <h2 class="text-lg font-semibold pb-6">{{ questions[currentStep].text }}</h2>

            <div class="grid grid-cols-2 gap-4 mb-8">
                <label
                    v-for="option in questions[currentStep].options"
                    :key="option"
                    class="cursor-pointer border rounded-lg p-4 text-center transition hover:border-gray-400"
                    :class="{
                        'bg-gray-100 border-gray-400': answers[currentStep] === option,
                    }"
                >
                    <input
                        type="radio"
                        class="hidden"
                        :value="option"
                        v-model="answers[currentStep]"
                    />
                    {{ option }}
                </label>
            </div>

            <div class="flex justify-between">
                <button
                    class="px-4 py-2 border cursor-pointer border-gray-400 text-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
                    :disabled="currentStep === 0"
                    @click="prevStep"
                    type="button"
                >
                    Προηγούμενο
                </button>
                <button
                    class="px-4 py-2 bg-black cursor-pointer text-white disabled:opacity-50 disabled:cursor-not-allowed"
                    :disabled="!answers[currentStep]"
                    @click="nextStep"
                    type="button"
                >
                    {{ currentStep === questions.length - 1 ? 'Ολοκλήρωση' : 'Επόμενο' }}
                </button>
            </div>
        </div>

        <!-- Loading Spinner -->
        <div v-else-if="loading" class="flex justify-center items-center mt-20">
            <div class="w-12 h-12 border-4 border-black border-t-transparent rounded-full animate-spin"></div>
        </div>

        <!-- Results -->
        <div v-else class="bg-white shadow-md rounded-lg p-8 text-center mt-20">
            <h2 class="text-xl font-bold mb-4">Συγχαρητήρια! Ολοκληρώσατε το κουίζ.</h2>

            <div v-if="suggestedBikes.length" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6 text-left">
                <div v-for="bike in suggestedBikes" :key="bike.id">
                    <div class="overflow-hidden rounded-lg bg-white shadow-lg border-black">
                        <Link :href="`/bike/${bike.slug}`" class="block">
                            <img
                                :src="`/storage/${bike.image}`"
                                :alt="bike.name"
                                class="h-48 w-full object-contain bg-white"
                            />
                            <div class="p-4">
                                <h3 class="mt-2 mb-2 text-center text-xl font-semibold">
                                    {{ bike.name }}
                                </h3>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>

            <button
                class="mt-6 px-6 py-3 bg-green-600 text-white cursor-pointer hover:bg-green-700"
                @click="restartQuiz"
                type="button"
            >
                Ξεκίνα ξανά το κουίζ
            </button>
        </div>
    </div>
</template>

<style scoped>
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}
.animate-spin {
    animation: spin 1s linear infinite;
}
</style>
