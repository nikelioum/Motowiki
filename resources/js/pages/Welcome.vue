<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    categories: Array,
});
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <div class="min-h-screen bg-white p-8 text-gray-900">
        <div class="max-w-xl mx-auto">
            <h1 class="text-2xl font-bold mb-4">Categories</h1>
            <ul class="space-y-2">
                <li
                    v-for="category in categories"
                    :key="category.id"
                    class="rounded border p-3 shadow hover:bg-gray-100 flex items-center space-x-4"
                >
                    <Link
                        :href="`/category/${category.slug}`"
                        class="flex items-center space-x-4"
                    >
                        <div>
                    <img
                        v-if="category.image"
                        :src="`/storage/${category.image}`"
                        alt="Category Image"
                        class="w-300 h-130 rounded object-cover"
                    />
                    <span>{{ category.title }}</span>
                        </div>
                    </Link>
                </li>
            </ul>
        </div>
    </div>
    <div class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] dark:bg-[#0a0a0a] lg:justify-center lg:p-8">
        <header class="not-has-[nav]:hidden mb-6 w-full max-w-[335px] text-sm lg:max-w-4xl">
            <nav class="flex items-center justify-end gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="route('login')"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                    >
                        Log in
                    </Link>
                    <Link
                        :href="route('register')"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        Register
                    </Link>
                </template>
            </nav>
        </header>
        <div class="duration-750 starting:opacity-0 flex w-full items-center justify-center opacity-100 transition-opacity lg:grow">
            <main class="flex w-full max-w-[335px] flex-col-reverse overflow-hidden rounded-lg lg:max-w-4xl lg:flex-row">

            </main>
        </div>
        <div class="h-14.5 hidden lg:block"></div>
    </div>
</template>
