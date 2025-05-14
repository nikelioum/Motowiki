<script setup lang="ts">
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

const showModal = ref(false)
const successMessage = ref<string | null>(null)

const form = useForm({
    name: '',
    email: '',
    accepted_terms: false,
})

const submit = () => {
    form.post('/newsletter', {
        preserveScroll: true,
        onSuccess: () => {
            successMessage.value = 'Ευχαριστούμε για την εγγραφή σας!'
            form.reset()

            // After 4 seconds close the modal
            setTimeout(() => {
                showModal.value = false
                successMessage.value = null
            }, 4000)
        },
        onError: () => {
            successMessage.value = null
        },
    })
}
</script>

<template>
    <!-- Newsletter Section -->
    <section class="bg-gray-200 px-6 py-12">
        <div class="mx-auto max-w-[1720px] grid grid-cols-1 md:grid-cols-2 items-center gap-6 text-center md:text-left">
            <!-- Left Side -->
            <div class="flex flex-col items-center md:items-start">
                <h2 class="text-3xl font-bold text-gray-900">Newsletter</h2>
                <p class="mt-2 text-gray-700">Κάνε εγγραφή για να ενημερώνεσαι για νέα μοντέλα</p>
            </div>

            <!-- Right Side -->
            <div class="flex justify-center md:justify-end">
                <button
                    @click="showModal = true"
                    class="cursor-pointer border border-black px-6 py-3 font-semibold text-black transition hover:bg-black hover:text-white"
                >
                    Εγγραφή
                </button>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80" @click="showModal = false">
        <div class="relative w-full max-w-md rounded-lg bg-white p-6 pb-10 shadow-lg" @click.stop>
            <button @click="showModal = false" class="absolute top-3 right-3 text-xl text-gray-500 cursor-pointer hover:text-black">
                &times;
            </button>

            <img src="/images/logo.png" alt="MotoWiki" class="w-[170px] py-5 mx-auto" />

            <h3 class="mb-2 text-xl font-bold text-gray-800">Newsletter</h3>
            <p class="mb-4 text-sm text-gray-600">Συμπληρώστε την παρακάτω φόρμα</p>

            <form @submit.prevent="submit" class="space-y-4">
                <!-- Name Field -->
                <input
                    v-model="form.name"
                    type="text"
                    placeholder="Ονοματεπώνυμο"
                    class="w-full rounded border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-black focus:outline-none"
                    required
                />
                <div v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</div>

                <!-- Email Field -->
                <input
                    v-model="form.email"
                    type="email"
                    placeholder="Διεύθυνση email"
                    class="w-full rounded border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-black focus:outline-none"
                    required
                />
                <div v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</div>

                <!-- Accept Terms Checkbox -->
                <label class="flex items-start space-x-2 text-sm text-gray-600">
                    <input type="checkbox" v-model="form.accepted_terms" required class="mt-1 accent-black" />
                    <span>
                        Συμφωνώ με τους
                        <a href="/terms" target="_blank" class="underline hover:text-black">όρους χρήσης</a>.
                    </span>
                </label>
                <div v-if="form.errors.accepted_terms" class="text-red-500 text-sm">{{ form.errors.accepted_terms }}</div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full cursor-pointer bg-black px-4 py-2 font-semibold text-white transition hover:bg-gray-800"
                    :disabled="form.processing"
                >
                    Εγγραφή
                </button>

                <!-- Success Message -->
                <p v-if="successMessage" class="text-green-600 text-center mt-4">
                    {{ successMessage }}
                </p>
            </form>
        </div>
    </div>
</template>
