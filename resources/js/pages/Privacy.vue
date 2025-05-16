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

        <h1 class="mb-4 text-2xl font-bold">Privacy</h1>
        <p class="max-w-[1200px]">
            Ανακαλύψτε όλες τις κατηγορίες των μοτοσυκλετών και τις τελευταίες καινοτομίες που προσφέρουν οι κορυφαίοι κατασκευαστές στον κόσμο. Εδώ
            μπορείτε να μάθετε για τις νέες μοτοσυκλέτες, τις εξελιγμένες τεχνολογίες και τα μοναδικά χαρακτηριστικά τους, χωρίς να χρειάζεται να
            κάνετε κάποια αγορά.
        </p>

        <div class="py-15 px-6 my-6 bg-white rounded-md text-gray-800 space-y-4">
            <p><strong>1. Εισαγωγή:</strong> Καλώς ήρθατε στην ιστοσελίδα μας. Με την πρόσβασή σας σε αυτήν την ιστοσελίδα, αποδέχεστε τους παρακάτω όρους χρήσης.</p>

            <p><strong>2. Πνευματική Ιδιοκτησία:</strong> Όλο το περιεχόμενο αυτής της ιστοσελίδας, συμπεριλαμβανομένων εικόνων, κειμένων και λογοτύπων, προστατεύεται από πνευματικά δικαιώματα.</p>

            <p><strong>3. Χρήση Υπηρεσιών:</strong> Απαγορεύεται η κακόβουλη χρήση της πλατφόρμας ή η προσπάθεια παραβίασης της ασφάλειας του συστήματος.</p>

            <p><strong>4. Περιορισμός Ευθύνης:</strong> Δεν φέρουμε ευθύνη για οποιαδήποτε ζημία προκύψει από τη χρήση των πληροφοριών αυτής της ιστοσελίδας.</p>

            <p><strong>5. Τροποποιήσεις Όρων:</strong> Διατηρούμε το δικαίωμα να τροποποιήσουμε τους όρους χρήσης οποιαδήποτε στιγμή χωρίς προειδοποίηση.</p>

            <p><strong>6. Επικοινωνία:</strong> Για οποιαδήποτε ερώτηση σχετικά με τους όρους χρήσης, παρακαλούμε επικοινωνήστε μαζί μας.</p>
        </div>


    </div>


</template>
