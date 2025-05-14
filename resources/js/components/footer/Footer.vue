<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <footer class="bg-black text-white">
        <div class="mx-auto max-w-[1720px] px-4 py-8 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center justify-between space-y-4 md:flex-row md:space-y-0">
                <!-- Left Side -->
                <div class="text-center text-sm md:text-left">
                    &copy; {{ new Date().getFullYear() }} MotoWiki. All rights reserved.
                    <div class="mt-2 flex items-center text-xs">
                        Design and development by
                        <span class="mx-1 inline-flex items-center justify-center text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="inline-block h-4 w-4">
                                <path
                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                                />
                            </svg>
                        </span>
                        Dimitris Liaropoulos
                    </div>
                </div>

                <!-- Right Side Links -->
                <div class="flex space-x-4 text-sm">
                    <Link href="/contact" class="hover:underline">Επικοινωνία</Link>
                    <Link href="/about" class="hover:underline">Σχετικά</Link>
                    <Link href="/privacy" class="hover:underline">Απόρρητο</Link>
                    <Link href="/terms" class="hover:underline">Όροι</Link>
                </div>
            </div>
        </div>
    </footer>
</template>
