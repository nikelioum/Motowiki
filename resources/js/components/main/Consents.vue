<script setup lang="ts">
import { ref } from 'vue'
</script>

<template>
    <div class="fixed bottom-0 left-0 right-0 border-t border-black bg-white p-4 z-50 shadow-md">
        <div class="max-w-[1720px] mx-auto flex flex-col md:flex-row justify-between items-start gap-12">
            <!-- Left Column -->
            <div class="text-sm text-gray-800 md:w-2/3">
                <p class="font-semibold text-base mb-2">Στο MotoWiki χρησιμοποιούμε Cookies!</p>
                <p class="mb-2">
                    Χρησιμοποιούμε cookies, για να σου προσφέρουμε προσωποποιημένη εμπειρία περιήγησης.
                </p>
                <p class="mb-4">
                    Κάνε «κλικ» στο κουμπί <strong>«Αποδοχή όλων»</strong> και βοήθησέ μας να προσαρμόσουμε τις προτάσεις μας
                    αποκλειστικά στο περιεχόμενο που σε ενδιαφέρει.
                    Εναλλακτικά, κλίκαρε αυτά που θες και πάτα <strong>«Αποδοχή επιλογών»</strong>!
                    <a href="/cookie-policy" class="underline text-blue-600 hover:text-blue-800">Εδώ</a> θα βρεις όλες τις πληροφορίες που χρειάζεσαι.
                </p>
            </div>

            <!-- Right Column (buttons) -->
            <div class="flex flex-col gap-2 w-full md:w-1/3">
                <button
                    @click="$emit('accepted')"
                    class="bg-black text-white px-4 py-2 rounded hover:bg-gray-900 transition cursor-pointer"
                >
                    Αποδοχή όλων
                </button>
                <button
                    @click="$emit('rejected')"
                    class="bg-white text-black border border-black px-4 py-2 rounded hover:bg-gray-100 transition cursor-pointer"
                >
                    Απόρριψη
                </button>
            </div>
        </div>
    </div>
</template>




