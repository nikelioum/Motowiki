<script setup lang="ts">
import MainLayout from '@/layouts/Main.vue';
import { Head, Link } from '@inertiajs/vue3';
import mapboxgl from 'mapbox-gl';
import { defineProps, onMounted, ref, computed, watch } from 'vue';

const props = defineProps({
    breadcrumb: Array,
    vendors: Array,
});

defineOptions({
    layout: MainLayout,
});

const map = ref<mapboxgl.Map | null>(null);
const markers = ref<Record<number, mapboxgl.Marker>>({});
let currentPopup: mapboxgl.Popup | null = null; // Track the current popup

// State for the filtered vendors and selected brand
const selectedBrand = ref<string>('');

// Computed vendors to filter based on the selected brand
const filteredVendors = computed(() => {
    if (!selectedBrand.value) {
        return props.vendors; // If no brand selected, show all vendors
    }
    return props.vendors.filter((vendor) => vendor.brand.name === selectedBrand.value);
});

onMounted(() => {
    mapboxgl.accessToken = 'pk.eyJ1IjoibmlrZWxpb3VtIiwiYSI6ImNrN3lvM3QzYTAyMXgzZW82dHhoNHk3NmkifQ.MxmU4-kVKWleTsy5n8210w'; // Your original token

    map.value = new mapboxgl.Map({
        container: 'map', // ID of the container element
        style: 'mapbox://styles/mapbox/light-v10', // Map style (light theme)
        center: [23.7275, 37.9838], // Initial center (Athens, Greece)
        zoom: 8, // Initial zoom level
        attributionControl: false,
    });

    map.value.on('load', () => {
        props.vendors.forEach((vendor) => {
            const lat = parseFloat(vendor.lat);
            const lng = parseFloat(vendor.lng);
            if (isNaN(lat) || isNaN(lng)) return;

            // Create marker for each vendor
            const marker = new mapboxgl.Marker({ color: '#f97316' })
                .setLngLat([lng, lat])
                .setPopup(
                    new mapboxgl.Popup({ offset: 25 }).setHTML(`
                        <div style="padding: 10px;">
                            <strong>${vendor.name}</strong>
                            <p><strong>Email:</strong> ${vendor.email}</p>
                            <p><strong>Τηλέφωνο:</strong> ${vendor.phone}</p>
                            <p><strong>Ιστοσελίδα:</strong> <a href="${vendor.website}" target="_blank">${vendor.website}</a></p>
                        </div>
                    `)
                )
                .addTo(map.value!);

            markers.value[vendor.id] = marker;
        });
    });
});

function zoomToVendor(vendor: any) {
    const lat = parseFloat(vendor.lat);
    const lng = parseFloat(vendor.lng);

    if (map.value && !isNaN(lat) && !isNaN(lng)) {
        // Zoom to vendor's location
        map.value.flyTo({
            center: [lng, lat],
            zoom: 10,
            speed: 1.2,
        });

        // Close the previous popup if it's open
        if (currentPopup) {
            currentPopup.remove(); // Remove the previous popup
        }

        // Get the new popup from the marker and open it
        const newPopup = markers.value[vendor.id]?.getPopup();
        if (newPopup) {
            newPopup.addTo(map.value!); // Add the new popup to the map
            currentPopup = newPopup; // Set the current popup to the new one
        }
    }
}

// Reset filters
function resetFilters() {
    selectedBrand.value = ''; // Reset the selected brand to show all vendors
}

// Watch for changes in the filtered vendors and hide/show markers accordingly
watch(filteredVendors, (newFilteredVendors) => {
    // Hide markers that are not in the filtered list
    props.vendors.forEach((vendor) => {
        const marker = markers.value[vendor.id];
        if (marker) {
            if (newFilteredVendors.some((v) => v.id === vendor.id)) {
                marker.addTo(map.value!); // Add marker to map if it's in the filtered list
            } else {
                marker.remove(); // Remove marker from map if it's not in the filtered list
            }
        }
    });
});
</script>

<template>
    <Head>
        <title>Αντιπροσωπίες Μοτοσυκλέτας</title>
    </Head>

    <div class="mx-auto py-20">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm text-gray-600" aria-label="Breadcrumb">
            <ol class="list-reset flex flex-wrap items-center">
                <li v-for="(crumb, index) in props.breadcrumb" :key="index" class="flex items-center">
                    <Link :href="crumb.url" class="px-2 hover:underline">{{ crumb.label }}</Link>
                    <span v-if="index < props.breadcrumb.length - 1">/</span>
                </li>
            </ol>
        </nav>

        <h1 class="mb-4 text-2xl font-bold">Αντιπροσωπίες Μοτοσυκλέτας</h1>
        <p class="mb-8 max-w-[1200px] text-gray-700">
            Ανακαλύψτε όλες τις κατηγορίες των μοτοσυκλετών και τις τελευταίες καινοτομίες που προσφέρουν οι κορυφαίοι κατασκευαστές στον κόσμο.
        </p>

        <!-- Filters -->
        <div class="mb-6">
            <label for="brandFilter" class="block text-gray-700 font-medium">Φίλτρο ανά Μάρκα</label>
            <select
                id="brandFilter"
                v-model="selectedBrand"
                class="mt-2 block w-50 p-2 border-gray-600 border focus:black-500 focus:black-500"
            >
                <option value="">Όλες οι Μάρκες</option>
                <option v-for="brand in [...new Set(props.vendors.map(vendor => vendor.brand.name))]" :key="brand" :value="brand">
                    {{ brand }}
                </option>
            </select>
        </div>

        <button
            @click="resetFilters"
            class="mb-6 py-1 px-4 text-sm cursor-pointer text-black border border-black bg-transparent hover:bg-black hover:text-white transition"
        >
            Επαναφορά Φίλτρων
        </button>


        <!-- Layout -->
        <div class="flex h-[600px] flex-col gap-8 lg:flex-row">
            <!-- Scrollable Vendor List -->
            <div class="max-h-full w-full space-y-4 overflow-y-auto rounded-xl border bg-white p-4 shadow lg:w-1/3">
                <div
                    v-for="vendor in filteredVendors"
                    :key="vendor.id"
                    class="cursor-pointer rounded-lg border bg-gray-50 p-4 transition hover:bg-gray-100"
                    @click="zoomToVendor(vendor)"
                >
                    <h2 class="text-lg font-semibold text-dark-600">{{ vendor.name }}</h2>
                    <div class="vendor-brand">{{ vendor.brand.name }}</div>
                </div>
            </div>

            <!-- Map -->
            <div class="w-full overflow-hidden rounded-xl shadow lg:w-2/3" id="map" />
        </div>
    </div>
</template>

<style scoped>
#map {
    width: 100%;
    height: 100%;
}
</style>
