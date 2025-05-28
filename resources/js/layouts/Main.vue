<script setup lang="ts">
import { ref, onMounted } from 'vue'
import Navbar from '@/components/header/Navbar.vue'
import Footer from '@/components/footer/Footer.vue'
import Newsletter from '@/components/main/Newsletter.vue'
import Consent from '@/components/main/Consents.vue'
import ReviewPrompt from '@/components/main/ReviewPrompt.vue'
import GoTop from '@/components/main/GoTop.vue'
import SocialShare from '@/components/main/SocialShare.vue';

const cookieAccepted = ref(false)

onMounted(() => {
    const cookies = document.cookie
    cookieAccepted.value = cookies.includes('cookie_accepted=true') || cookies.includes('cookie_accepted=false')
})

const acceptCookies = () => {
    const date = new Date()
    date.setFullYear(date.getFullYear() + 1)
    document.cookie = `cookie_accepted=true; expires=${date.toUTCString()}; path=/`
    cookieAccepted.value = true
}

const rejectCookies = () => {
    const date = new Date()
    date.setFullYear(date.getFullYear() + 1)
    document.cookie = `cookie_accepted=false; expires=${date.toUTCString()}; path=/`
    cookieAccepted.value = true
}
</script>



<template>
    <!--Navbar -->
    <Navbar />
    <div class="bg-gray-100">
        <!-- Main content -->
        <main class="max-w-[1720px] mx-auto px-6 sm:px-12 min-h-screen">
            <slot />
            <!-- Consent -->
            <Consent v-if="!cookieAccepted"@accepted="acceptCookies"@rejected="rejectCookies"/>
            <ReviewPrompt />
        </main>
    </div>
    <!--Newsletter-->
    <Newsletter />
    <!--Footer-->
    <Footer />
    <GoTop />
    <SocialShare />
</template>
