<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css'; // basic styles
import 'swiper/css/navigation';
import 'swiper/css/pagination';
</script>

<template>
    <div class="py-10">
        <!-- Two-column responsive layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Left Column (Swiper Slider) -->
            <div class="relative w-full h-[300px] md:h-full overflow-hidden shadow-lg group">
                <Swiper
                    :slides-per-view="1"
                    :loop="true"
                    class="h-full w-full"
                >
                    <!-- Slide 1 -->
                    <SwiperSlide>
                        <Link href="/category/scooters" class="block h-full w-full">
                            <div
                                class="relative h-full w-full bg-cover bg-center"
                                style="background-image: url('https://www.bikeit.gr/media/k2/items/cache/9fbb86c385aa373362468cd250f61ec1_XL.jpg?t=20231004_103421');"
                            >
                                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/60 transition duration-300 z-0"></div>

                                <div class="absolute inset-0 p-6 flex flex-col justify-end text-white z-10">
                                    <h3 class="text-xl font-bold mb-2">Featured Ride</h3>
                                    <p class="text-sm mb-4">Check out this powerful street machine.</p>
                                    <div class="opacity-0 group-hover:opacity-100 bg-white text-black font-semibold px-4 py-2 rounded transition duration-300 w-fit">
                                        Περισσότερα
                                    </div>
                                </div>
                            </div>
                        </Link>
                    </SwiperSlide>

                    <!-- Slide 2 -->
                    <SwiperSlide>
                        <Link href="/category/scooters" class="block h-full w-full">
                            <div
                                class="relative h-full w-full bg-cover bg-center"
                                style="background-image: url('https://www.bikeit.gr/media/k2/items/cache/9fbb86c385aa373362468cd250f61ec1_XL.jpg?t=20231004_103421');"
                            >
                                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/60 transition duration-300 z-0"></div>

                                <div class="absolute inset-0 p-6 flex flex-col justify-end text-white z-10">
                                    <h3 class="text-xl font-bold mb-2">Urban Beast</h3>
                                    <p class="text-sm mb-4">Perfect for fast-paced city rides.</p>
                                    <div class="opacity-0 group-hover:opacity-100 bg-white text-black font-semibold px-4 py-2 rounded transition duration-300 w-fit">
                                        Περισσότερα
                                    </div>
                                </div>
                            </div>
                        </Link>
                    </SwiperSlide>
                </Swiper>
            </div>

            <!-- Right Column with stacked banners -->
            <div class="flex flex-col gap-6">
                <!-- Banner 1 -->
                <div
                    class="relative h-80 overflow-hidden group shadow-lg"
                    style="background-image: url('https://mrwallpaper.com/images/hd/high-speed-adventure-awaits-with-the-ktm-390-adventure-bike-k4o29faqcb27l9po.jpg'); background-size: cover; background-position: cover;"
                >
                    <Link href="/category/adventure">
                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/60 transition duration-300 z-0"></div>

                        <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                            <h3 class="text-xl font-bold mb-2">Explore Adventure Bikes</h3>
                            <p class="text-sm mb-4">Discover our latest motorcycle models.</p>

                            <Link href="/category/adventure"
                                  class="opacity-0 group-hover:opacity-100 bg-white text-black font-semibold px-4 py-2 rounded transition duration-300 w-fit"
                            >
                                Περισσότερα
                            </Link>
                        </div>
                    </Link>
                </div>

                <!-- Banner 2 -->
                <div
                    class="relative h-80 overflow-hidden group shadow-lg"
                    style="background-image: url('https://cloudfront-us-east-1.images.arcpublishing.com/octane/J5RKG5O455GMPGQRF2OG6LRT7A.jpg'); background-size: cover; background-position: cover;"
                >
                    <Link href="/category/adventure">
                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/60 transition duration-300 z-0"></div>

                        <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                            <h3 class="text-xl font-bold mb-2">Gear Up</h3>
                            <p class="text-sm mb-4">Safety meets style in our gear collection.</p>

                            <Link href="/category/adventure"
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

<style scoped>
/* Ensure Swiper container takes up full width and height on mobile */
.swiper {
    width: 100%;
    height: 100%;
}

@media (max-width: 768px) {
    .swiper {
        height: 300px; /* Set height on smaller screens for mobile */
    }
}
</style>
