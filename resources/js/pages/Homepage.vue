<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/layouts/Main.vue'
import Intro from '@/components/homepage/Header.vue'
import TopBrands from '@/components/homepage/TopBrands.vue'
import NewBikes from '@/components/homepage/NewBikes.vue'
import Faq from '@/components/homepage/Faq.vue'

defineProps({
    brands: Array,
    newBikes: Array,
    faqs: Array,
    slider: Array,
    banner: Array,
})

defineOptions({
    layout: MainLayout
});

const jsonLd = {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "Moto Wiki",
    "url": "http://127.0.0.1:8000/",
    "description": "Η πληρέστερη ελληνική βάση δεδομένων για μοτοσυκλέτες - τεχνικά χαρακτηριστικά, ιστορία και κοινότητα αναβατών.",
    "publisher": {
        "@type": "Organization",
        "name": "Moto Wiki",
        "logo": {
            "@type": "ImageObject",
            "url": "http://127.0.0.1:8000/storage/01JVP9B00RW79DKVAJBKPPE535.webp"
        }
    }
}
</script>

<template>
    <Head>
        <title>Moto Wiki - Ελληνική Βάση Δεδομένων για Μοτοσυκλέτες</title>
        <meta name="description" content="Ανακάλυψε τεχνικά χαρακτηριστικά, ιστορικά δεδομένα και αξιολογήσεις για όλες τις μοτοσυκλέτες στην ελληνική βάση δεδομένων Moto Wiki." />
        <link rel="canonical" href="/" />

        <!-- Open Graph -->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="http://127.0.0.1:8000/" />
        <meta property="og:title" content="Moto Wiki - Ελληνική Βάση Δεδομένων για Μοτοσυκλέτες" />
        <meta property="og:description" content="Αναλυτικές πληροφορίες για μοτοσυκλέτες, τεχνικά χαρακτηριστικά και κοινότητα." />
        <meta property="og:image" content="http://127.0.0.1:8000/storage/01JVP9B00RW79DKVAJBKPPE535.webp" />

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="Moto Wiki - Ελληνική Βάση Δεδομένων για Μοτοσυκλέτες" />
        <meta name="twitter:description" content="Αναλυτικές πληροφορίες για μοτοσυκλέτες, τεχνικά χαρακτηριστικά και κοινότητα." />
        <meta name="twitter:image" content="http://127.0.0.1:8000/storage/01JVP9B00RW79DKVAJBKPPE535.webp" />

        <!-- JSON-LD Structured Data -->
        <template v-html="`<script type='application/ld+json'>${JSON.stringify(jsonLd)}</script>`" />
    </Head>
    <Intro :slider="slider" :banner="banner"/>
    <TopBrands :brands="brands" />
    <NewBikes :newBikes="newBikes"/>
    <Faq :faqs="faqs"/>
</template>
