<script lang="ts" setup>
import { ref, defineEmits, defineExpose, computed, watch, onMounted } from 'vue';

interface Brand {
    id: number;
    name: string;
}

interface Category {
    id: number;
    name: string;
}

interface Bike {
    id: number;
    name: string;
    image: string;
    brand?: Brand;
    category?: Category;
    price?: number;
    year: string;
}

const STORAGE_KEY = 'compare_bikes';

const maxBikes = 4;
const bikes = ref<Bike[]>([]);

const emit = defineEmits<{
    (e: 'compare-add', bike: Bike): void;
    (e: 'compare-remove', id: number): void;
}>();

function addBike(bike: Bike) {
    if (bikes.value.length >= maxBikes) {
        alert(`You can only compare up to ${maxBikes} bikes.`);
        return;
    }
    if (bikes.value.find(b => b.id === bike.id)) {
        alert('This bike is already in the compare list.');
        return;
    }
    bikes.value.push(bike);
    emit('compare-add', bike);
}

function removeBike(id: number) {
    bikes.value = bikes.value.filter(b => b.id !== id);
    emit('compare-remove', id);
}

defineExpose({ addBike });

const canCompare = computed(() => bikes.value.length > 1);

const isFullscreen = ref(false);

function openFullscreen() {
    isFullscreen.value = true;
}

function closeFullscreen() {
    isFullscreen.value = false;
}

function removeAllAndClose() {
    bikes.value = [];
    isFullscreen.value = false;
}

// Load from localStorage on mount
onMounted(() => {
    const saved = localStorage.getItem(STORAGE_KEY);
    if (saved) {
        try {
            bikes.value = JSON.parse(saved);
        } catch {
            // ignore corrupt data
        }
    }
});

// Save to localStorage whenever bikes change
watch(
    bikes,
    (newBikes) => {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(newBikes));
    },
    { deep: true }
);
</script>

<template>
    <div
        v-if="bikes.length > 0"
        :class="[
          'fixed bottom-0 left-0 right-0 bg-white shadow-lg p-4 py-20 flex z-50 transition-all duration-300',
          isFullscreen
            ? 'top-0 bottom-0 h-screen flex-col overflow-auto'
            : 'sm:h-20 items-center space-x-4'
        ]"
    >
        <!-- Close fullscreen button -->
        <button
            v-if="isFullscreen"
            @click="closeFullscreen"
            class="self-end text-gray-600 hover:text-gray-900 text-3xl font-bold p-2 cursor-pointer"
            aria-label="Close compare fullscreen"
        >
            &times;
        </button>

        <!-- Fullscreen bikes grid -->
        <div
            v-if="isFullscreen"
            class="grid grid-cols-2 md:grid-cols-4 gap-6 w-full px-4"
            style="min-width: 0;"
        >
            <div
                v-for="bike in bikes"
                :key="bike.id"
                class="flex flex-col items-center border rounded p-2 w-full"
            >
                <img
                    :src="`/storage/${bike.image}`"
                    :alt="bike.name"
                    class="h-40 w-full object-contain mb-2"
                />
                <div class="text-center font-semibold truncate w-full">{{ bike.name }}</div>

                <div class="text-sm text-gray-600 mt-1">
                    Brand: {{ bike.brand?.name || 'Άγνωστη Μάρκα' }}
                </div>
                <div class="text-sm text-gray-600 mt-1">
                    Category: {{ bike.category?.name || 'Άγνωστη Κατηγορία' }}
                </div>
                <div class="text-sm font-bold text-black">
                    Από {{ bike.price ? Math.floor(bike.price) + ' €' : '-' }}
                </div>
                <div class="text-sm font-bold text-black">
                    Έτος: {{ bike.year }}
                </div>

                <!-- Render ALL specs in spec_values, no filtering -->
                <div v-if="bike.spec_values && bike.spec_values.length" class="mt-2 w-full text-left px-2">
                    <div
                        v-for="specVal in bike.spec_values"
                        :key="specVal.id"
                        class="text-sm text-gray-700 mt-1"
                    >
                        <strong>{{ specVal.spec.label }}:</strong> {{ specVal.value }}
                    </div>
                </div>

                <button
                    @click="removeBike(bike.id)"
                    class="text-red-500 hover:text-red-700 mt-4 cursor-pointer"
                    aria-label="Remove bike"
                >
                    &times;
                </button>
            </div>
        </div>


        <!-- Non-fullscreen: mobile bikes grid + buttons stacked -->
        <div v-else class="flex flex-col sm:flex-row sm:items-center w-full gap-4 px-2">

            <!-- Bikes grid on mobile + tablets -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 w-full">
                <div
                    v-for="bike in bikes"
                    :key="bike.id"
                    class="flex flex-col items-center border rounded p-2"
                >
                    <img
                        :src="`/storage/${bike.image}`"
                        :alt="bike.name"
                        class="h-12 w-16 object-contain"
                    />
                    <div class="text-center font-semibold truncate w-full max-w-[80px]">{{ bike.name }}</div>
                    <button
                        @click="removeBike(bike.id)"
                        class="text-red-500 hover:text-red-700 mt-2 cursor-pointer"
                        aria-label="Remove bike"
                    >
                        &times;
                    </button>
                </div>
            </div>

            <!-- Buttons stacked full-width on mobile, inline on sm+ -->
            <div
                class="flex flex-col sm:flex-row sm:items-center sm:ml-auto sm:space-x-4 space-y-2 sm:space-y-0 w-full sm:w-auto"
            >
                <button
                    v-if="canCompare && !isFullscreen"
                    @click="openFullscreen"
                    class="bg-black text-white px-6 py-2 shadow transition cursor-pointer whitespace-nowrap w-full sm:w-auto"
                    aria-label="Compare selected bikes"
                >
                    Σύγκριση ({{ bikes.length }})
                </button>

                <button
                    v-if="bikes.length > 1 && canCompare && !isFullscreen"
                    @click="removeAllAndClose"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 cursor-pointer shadow transition whitespace-nowrap w-full sm:w-auto"
                    aria-label="Remove all bikes and close compare bar"
                >
                    Αφαίρεση όλων
                </button>
            </div>
        </div>
    </div>
</template>
