<script setup lang="ts">
import MainLayout from '@/layouts/Main.vue';
import { Link, Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    breadcrumb: Array,
});


defineOptions({
    layout: MainLayout,
});
</script>

<template>
    <Head>
        <title>Σχετικά</title>
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

        <h1 class="mb-4 text-2xl font-bold">Σχετικά</h1>
        <p class="max-w-[1200px]">
            Ανακαλύψτε όλες τις κατηγορίες των μοτοσυκλετών και τις τελευταίες καινοτομίες που προσφέρουν οι κορυφαίοι κατασκευαστές στον κόσμο. Εδώ
            μπορείτε να μάθετε για τις νέες μοτοσυκλέτες, τις εξελιγμένες τεχνολογίες και τα μοναδικά χαρακτηριστικά τους, χωρίς να χρειάζεται να
            κάνετε κάποια αγορά.
        </p>



        <div class="mx-auto mt-12 space-y-16">
            <!-- Row 1: Image Left, Text Right -->
            <div class="flex flex-col md:flex-row items-center gap-8">
                <img
                    src="https://placehold.co/600x400"
                    alt="Image description"
                    class="w-full md:w-1/2 rounded-lg shadow"
                />
                <div class="md:w-1/2">
                    <h2 class="text-xl font-semibold mb-2">Τίτλος Ενότητας 1</h2>
                    <p class="text-gray-700">
                        Αυτό είναι ένα παράδειγμα παραγράφου που εξηγεί περισσότερα για το περιεχόμενο αυτής της ενότητας. Εδώ μπορείτε να γράψετε πληροφορίες ή
                        περιγραφή σχετική με την εικόνα.
                    </p>
                </div>
            </div>

            <!-- Row 2: Text Left, Image Right -->
            <div class="flex flex-col-reverse md:flex-row items-center gap-8">
                <div class="md:w-1/2">
                    <h2 class="text-xl font-semibold mb-2">Τίτλος Ενότητας 2</h2>
                    <p class="text-gray-700">
                        Μια άλλη παράγραφος για να δώσετε περιεχόμενο και πληροφόρηση στους επισκέπτες σας, αυτή τη φορά με την εικόνα να εμφανίζεται δεξιά στην
                        οθόνη.
                    </p>
                </div>
                <img
                    src="https://placehold.co/600x400"
                    alt="Image description"
                    class="w-full md:w-1/2 rounded-lg shadow"
                />
            </div>
        </div>


        <!-- Four Columns Section -->
        <div class="max-w-[1200px] mx-auto mt-20">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 text-center">
                <div>
                    <h3 class="text-lg font-semibold mb-2">Τίτλος 1</h3>
                    <p class="text-gray-600 text-sm">
                        Μικρή περιγραφή για το πρώτο χαρακτηριστικό ή υπηρεσία.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Τίτλος 2</h3>
                    <p class="text-gray-600 text-sm">
                        Μια σύντομη περιγραφή για το δεύτερο στοιχείο της ενότητας.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Τίτλος 3</h3>
                    <p class="text-gray-600 text-sm">
                        Ενημέρωση ή πληροφόρηση που σχετίζεται με το τρίτο θέμα.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Τίτλος 4</h3>
                    <p class="text-gray-600 text-sm">
                        Περιγραφή για το τέταρτο σημείο, προσφέροντας αξία στον χρήστη.
                    </p>
                </div>
            </div>
        </div>


        <!-- Background Image Section -->
        <div
            class="relative bg-cover bg-center bg-no-repeat py-15  mt-20 text-white text-center"
            style="background-image: url('https://placeholder.co/1600x600');"
        >
            <div class="bg-black/60 bg-opacity-60 absolute inset-0 rounded-4xl"></div>
            <div class="relative z-10 max-w-3xl mx-auto px-4">
                <h2 class="text-3xl font-bold mb-4">Εντυπωσιακός Τίτλος</h2>
                <p class="text-lg">
                    Αυτή η ενότητα χρησιμοποιεί εικόνα φόντου και περιέχει έναν τίτλο και μια παράγραφο που μπορεί να περιγράψει κάτι σημαντικό ή εμπνευσμένο για
                    τον επισκέπτη.
                </p>
            </div>
        </div>





    </div>
</template>
