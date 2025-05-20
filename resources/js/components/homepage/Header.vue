<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'

const props = defineProps({
    slider: Array
})
</script>

<template>
    <div class="py-10" v-if="slider.length && slider[0].slides.length">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left: Swiper Slider -->
            <div class="relative w-full h-[300px] md:h-full overflow-hidden shadow-lg group">
                <Swiper :slides-per-view="1" :loop="true" class="h-full w-full">
                    <SwiperSlide v-for="slide in slider[0].slides" :key="slide.id">
                        <Link :href="slide.button_link || '#'" class="block h-full w-full">
                            <div
                                class="relative h-full w-full bg-cover bg-center"
                                :style="`background-image: url('/storage/${slide.image}')`"
                            >
                                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/60 transition duration-300 z-0"></div>

                                <div class="absolute inset-0 p-6 flex flex-col justify-end text-white z-10">
                                    <h3 class="text-xl font-bold mb-2">{{ slide.title }}</h3>
                                    <p class="text-sm mb-4">{{ slide.description }}</p>
                                    <div
                                        v-if="slide.button_text"
                                        class="opacity-0 group-hover:opacity-100 bg-white text-black font-semibold px-4 py-2 rounded transition duration-300 w-fit"
                                    >
                                        {{ slide.button_text }}
                                    </div>
                                </div>
                            </div>
                        </Link>
                    </SwiperSlide>
                </Swiper>
            </div>

            <!-- Right banners (static or later dynamic) -->
            <div class="flex flex-col gap-6">
                <div
                    class="relative h-80 overflow-hidden group shadow-lg"
                    style="background-image: url('https://mrwallpaper.com/images/hd/high-speed-adventure-awaits-with-the-ktm-390-adventure-bike-k4o29faqcb27l9po.jpg'); background-size: cover; background-position: center;"
                >
                    <Link href="/category/adventure">
                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/60 transition duration-300 z-0"></div>
                        <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                            <h3 class="text-xl font-bold mb-2">Explore Adventure Bikes</h3>
                            <p class="text-sm mb-4">Discover our latest motorcycle models.</p>
                            <Link
                                href="/category/adventure"
                                class="opacity-0 group-hover:opacity-100 bg-white text-black font-semibold px-4 py-2 rounded transition duration-300 w-fit"
                            >
                                Περισσότερα
                            </Link>
                        </div>
                    </Link>
                </div>

                <div
                    class="relative h-80 overflow-hidden group shadow-lg"
                    style="background-image: url('https://cloudfront-us-east-1.images.arcpublishing.com/octane/J5RKG5O455GMPGQRF2OG6LRT7A.jpg'); background-size: cover; background-position: center;"
                >
                    <Link href="/category/gear">
                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/60 transition duration-300 z-0"></div>
                        <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                            <h3 class="text-xl font-bold mb-2">Gear Up</h3>
                            <p class="text-sm mb-4">Safety meets style in our gear collection.</p>
                            <Link
                                href="/category/gear"
                                class="opacity-0 group-hover:opacity-100 bg-white text-black font-semibold px-4 py-2 rounded transition duration-300 w-fit"
                            >
                                Περισσότερα
                            </Link>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
