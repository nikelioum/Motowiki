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
            Το Moto Wiki είναι η απόλυτη ψηφιακή εγκυκλοπαίδεια για τον κόσμο των μοτοσυκλετών. Εξερευνήστε μάρκες, μοντέλα, τεχνικά χαρακτηριστικά, συγκρίσεις και μάθετε τα πάντα γύρω από τη μοτοσυκλέτα που σας ενδιαφέρει. Η γνώση είναι ελευθερία — και η ελευθερία είναι πάνω σε δύο τροχούς.
        </p>




        <div class="mx-auto mt-12 space-y-16">
            <!-- Row 1: Image Left, Text Right -->
            <div class="flex flex-col md:flex-row items-center gap-8">
                <img
                    src="/images/about/about.jpg"
                    alt="Image description"
                    class="w-full md:w-1/2 rounded-lg shadow"
                />
                <div class="md:w-1/2">
                    <h2 class="text-xl font-semibold mb-2">Γιατί δημιουργήθηκε το Moto Wiki</h2>
                    <p class="text-gray-700">
                        Δημιουργήσαμε το Moto Wiki για να προσφέρουμε μια ενιαία, αξιόπιστη πηγή πληροφορίας για κάθε αναβάτη, χομπίστα ή επαγγελματία που θέλει να γνωρίσει καλύτερα τον κόσμο των μοτοσυκλετών. Χωρίς διαφημίσεις, χωρίς παραπληροφόρηση — μόνο καθαρά δεδομένα και αντικειμενικές συγκρίσεις.
                    </p>
                </div>
            </div>

            <!-- Row 2: Text Left, Image Right -->
            <div class="flex flex-col-reverse md:flex-row items-center gap-8">
                <div class="md:w-1/2">
                    <h2 class="text-xl font-semibold mb-2">Συγκρίνετε, ανακαλύψτε, αποφασίστε</h2>
                    <p class="text-gray-700">
                        Με το εργαλείο σύγκρισης του Moto Wiki μπορείτε να συγκρίνετε τεχνικά χαρακτηριστικά, επιδόσεις και τιμές ανάμεσα σε δεκάδες μοντέλα μοτοσυκλετών από διαφορετικούς κατασκευαστές. Κάντε την επιλογή σας πιο εύκολη και πιο τεκμηριωμένη.
                    </p>
                </div>
                <img
                    src="/images/about/about2.jpg"
                    alt="Image description"
                    class="w-full md:w-1/2 rounded-lg shadow"
                />
            </div>
        </div>


        <!-- Four Columns Section -->
        <div class="max-w-[1200px] mx-auto mt-20">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 text-center">
                <div>
                    <h3 class="text-lg font-semibold mb-2">Πλήρης Βάση Δεδομένων</h3>
                    <p class="text-gray-600 text-sm">
                        Πάνω από 500+ μοντέλα μοτοσυκλετών με λεπτομερή χαρακτηριστικά και φωτογραφίες.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Σύγκριση Μοντέλων</h3>
                    <p class="text-gray-600 text-sm">
                        Δυναμική σύγκριση μοντέλων με βάση επιδόσεις, κατηγορία και τιμή.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Κατηγορίες & Μάρκες</h3>
                    <p class="text-gray-600 text-sm">
                        Εξερευνήστε μοτοσυκλέτες ανά κατηγορία (street, enduro, touring) και ανά μάρκα.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Ανεξάρτητο Περιεχόμενο</h3>
                    <p class="text-gray-600 text-sm">
                        Όλες οι πληροφορίες βασίζονται σε επίσημα δεδομένα — χωρίς χορηγίες, χωρίς ψευδείς ισχυρισμούς.
                    </p>
                </div>
            </div>
        </div>


        <!-- Background Image Section -->
        <div
            class="relative bg-cover bg-center bg-no-repeat py-20  mt-20 text-white text-center rounded-4xl"
            style="background-image: url('/images/about/about3.jpg');"
        >
            <div class="bg-black/60 bg-opacity-60 absolute inset-0 rounded-4xl"></div>
            <div class="relative z-10 max-w-3xl mx-auto px-4">
                <h2 class="text-3xl font-bold mb-4">Οδηγούμε το Πάθος για Μοτοσυκλέτες</h2>
                <p class="text-lg">
                    Στο Moto Wiki δεν είμαστε απλώς λάτρεις των μηχανών — είμαστε αφοσιωμένοι στην αλήθεια και την πληροφόρηση. Κάθε μοντέλο, κάθε λεπτομέρεια, κάθε σύγκριση έχει σημασία. Γι’ αυτό είμαστε εδώ.
                </p>
            </div>
        </div>





    </div>
</template>
