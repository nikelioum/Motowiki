<script setup lang="ts">
import MainLayout from '@/layouts/Main.vue';
import { Link, useForm, Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
    breadcrumb: Array,
});

const form = useForm({
    fullname: '',
    email: '',
    phone: '',
    message: '',
    terms: false,
});

const submitForm = () => {
    form.post('/contact');
};

const page = usePage();

const flashSuccess = computed(() => page.props.flash?.success ?? null);
const flashError = computed(() => page.props.flash?.error ?? null);


defineOptions({
    layout: MainLayout,
});
</script>

<template>
    <Head>
        <title>Επικοινωνία</title>
        <meta name="description" content="Στείλτε μας το μήνυμά σας μέσω της φόρμας επικοινωνίας.">
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://example.com/my-page" />
        <meta property="og:title" content="My Awesome Page" />
        <meta property="og:description" content="This is the description of my awesome page." />
        <meta property="og:image" content="https://example.com/images/social-image.jpg" />
    </Head>

    <div class="py-20">
        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-600 mb-6" aria-label="Breadcrumb">
            <ol class="list-reset flex items-center">
                <li v-for="(crumb, index) in props.breadcrumb" :key="index" class="flex items-center">
                    <Link :href="crumb.url" class="hover:underline px-2">{{ crumb.label }}</Link>
                    <span v-if="index < props.breadcrumb.length - 1">/</span>
                </li>
            </ol>
        </nav>

        <h1 class="mb-4 text-2xl font-bold">Επικοινωνία</h1>
        <p class="max-w-[1200px]">
            Ανακαλύψτε όλες τις κατηγορίες των μοτοσυκλετών και τις τελευταίες καινοτομίες που προσφέρουν οι κορυφαίοι κατασκευαστές στον κόσμο. Εδώ
            μπορείτε να μάθετε για τις νέες μοτοσυκλέτες, τις εξελιγμένες τεχνολογίες και τα μοναδικά χαρακτηριστικά τους, χωρίς να χρειάζεται να
            κάνετε κάποια αγορά.
        </p>

        <!-- 2-Column Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 pt-12">
            <!-- Left: Contact Form -->
            <div class="space-y-6">
            <form @submit.prevent="submitForm" class="space-y-6">
                <div>
                    <label for="fullname" class="block mb-1 font-medium">Ονοματεπώνυμο *</label>
                    <input v-model="form.fullname" id="fullname" type="text" required
                           class="w-full border border-gray-300 rounded px-3 py-2" />
                    <p v-if="form.errors.fullname" class="text-red-500 text-sm">{{ form.errors.fullname }}</p>
                </div>

                <div>
                    <label for="email" class="block mb-1 font-medium">Email *</label>
                    <input v-model="form.email" id="email" type="email" required
                           class="w-full border border-gray-300 rounded px-3 py-2" />
                    <p v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</p>
                </div>

                <div>
                    <label for="phone" class="block mb-1 font-medium">Τηλέφωνο</label>
                    <input v-model="form.phone" id="phone" type="text"
                           class="w-full border border-gray-300 rounded px-3 py-2" />
                </div>

                <div>
                    <label for="message" class="block mb-1 font-medium">Μήνυμα</label>
                    <textarea v-model="form.message" id="message" rows="5"
                              class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
                </div>

                <div class="mb-4 flex items-start space-x-2">
                    <input
                        v-model="form.terms"
                        id="terms"
                        name="terms"
                        type="checkbox"
                        class="mt-1 h-4 w-4 text-black border-gray-300 rounded focus:ring-black"
                    />
                    <label for="terms" class="text-sm text-gray-700">
                        Αποδέχομαι τους <Link href="/terms" class="underline text-black hover:text-gray-800">όρους χρήσης</Link>
                    </label>
                </div>

                <button type="submit"
                        class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800 transition cursor-pointer">Αποστολή</button>

            </form>

                <div v-if="flashSuccess" class="mb-6 p-4 bg-green-900 text-white rounded text-sm">
                    {{ flashSuccess }}
                </div>
                <div v-if="flashError" class="mb-6 p-4 bg-red-900 text-white rounded text-sm">
                    {{ flashError }}
                </div>

            </div>

            <!-- Right: General Contact Info -->
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-semibold mb-1">Email</h3>
                    <p>info@example.com</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-1">Τηλέφωνο</h3>
                    <p>+30 210 1234567</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-1">Διεύθυνση</h3>
                    <p>Λεωφόρος Κηφισίας 100, Αθήνα</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-1">Ώρες Λειτουργίας</h3>
                    <p>Δευτέρα - Παρασκευή: 09:00 - 17:00</p>
                </div>
            </div>
        </div>
    </div>
</template>
