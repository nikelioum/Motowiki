<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'

const props = defineProps({
    slider: Array,
    banner: Array,
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

            <!-- Right banners (dynamic, max 2 banners) -->
            <div class="flex flex-col gap-6">
                <div
                    v-for="(b, index) in banner.slice(0,2)"
                    :key="b.id || index"
                    class="relative h-80 overflow-hidden group shadow-lg"
                    :style="`background-image: url('/storage/${b.image}'); background-size: cover; background-position: center;`"
                >
                    <Link :href="b.button_link || '#'">
                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/60 transition duration-300 z-0"></div>
                        <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                            <h3 class="text-xl font-bold mb-2">{{ b.title }}</h3>
                            <p class="text-sm mb-4">{{ b.description }}</p>
                            <div
                                v-if="b.button_text"
                                class="opacity-0 group-hover:opacity-100 bg-white text-black font-semibold px-4 py-2 rounded transition duration-300 w-fit"
                            >
                                {{ b.button_text }}
                            </div>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
