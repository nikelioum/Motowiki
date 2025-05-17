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

const maxBikes = 3;
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
      isFullscreen ? 'top-0 bottom-0 h-screen flex-col overflow-auto' : 'h-20 items-center space-x-4'
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

        <!-- Bikes list -->
        <div
            :class="[
        'flex',
        isFullscreen ? 'flex-row justify-around w-full flex-wrap gap-8' : 'items-center space-x-4 flex-grow overflow-x-auto'
      ]"
            style="min-width: 0;"
        >
            <div
                v-for="bike in bikes"
                :key="bike.id"
                :class="[
          'flex flex-col items-center border rounded p-2',
          isFullscreen ? 'w-1/4' : 'w-auto'
        ]"
            >
                <img
                    :src="`/storage/${bike.image}`"
                    :alt="bike.name"
                    :class="isFullscreen ? 'h-40 w-full object-contain mb-2' : 'h-12 w-16 object-contain'"
                />
                <div class="text-center font-semibold">{{ bike.name }}</div>

                <!-- Show brand, category and price ONLY in fullscreen mode -->
                <template v-if="isFullscreen">
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
                </template>

                <!-- Remove button always visible -->
                <button
                    @click="removeBike(bike.id)"
                    class="text-red-500 hover:text-red-700 mt-2 cursor-pointer"
                    aria-label="Remove bike"
                >
                    &times;
                </button>
            </div>
        </div>

        <!-- Show compare button only if not fullscreen and enough bikes -->
        <button
            v-if="canCompare && !isFullscreen"
            @click="openFullscreen"
            class="ml-auto bg-black text-white px-6 py-2 shadow transition cursor-pointer"
            aria-label="Compare selected bikes"
        >
            Σύγκριση ({{ bikes.length }})
        </button>

        <!-- Remove All & Close button -->
        <button
            v-if="bikes.length > 1 && canCompare && !isFullscreen"
            @click="removeAllAndClose"
            class="ml-4 bg-red-600 hover:bg-red-700 text-white px-4 py-2 cursor-pointer shadow transition"
            aria-label="Remove all bikes and close compare bar"
        >
            Αφαίρεση όλων
        </button>
    </div>
</template>
