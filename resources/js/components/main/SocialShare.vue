<script lang="ts" setup>
import { ref } from 'vue'
import { ChevronRightIcon, ClipboardIcon } from '@heroicons/vue/24/solid'

const url = window.location.href
const text = encodeURIComponent(document.title || 'Check this out!')

const isOpen = ref(false)
const copied = ref(false)

function toggleOpen() {
    isOpen.value = !isOpen.value
    copied.value = false // reset copy status when toggling
}

function shareFacebook(): void {
    const fbUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`
    window.open(fbUrl, '_blank', 'width=600,height=400')
}

function shareTwitter(): void {
    const twitterUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${text}`
    window.open(twitterUrl, '_blank', 'width=600,height=400')
}

async function copyUrl() {
    try {
        await navigator.clipboard.writeText(url)
        copied.value = true
        setTimeout(() => {
            copied.value = false
        }, 2000)
    } catch (err) {
        console.error('Failed to copy!', err)
    }
}
</script>

<template>
    <div
        class="fixed top-1/2 right-0 transform -translate-y-1/2 bg-white rounded-l-lg shadow-md p-3 flex flex-col items-center select-none z-50 font-sans"
        :class="{ 'w-12': !isOpen, 'w-24': isOpen }"
    >
        <button
            @click="toggleOpen"
            aria-label="Toggle share bar"
            class="text-gray-700 hover:text-gray-900 focus:outline-none transition-transform duration-300 cursor-pointer"
        >
            <ChevronRightIcon
                :class="[{ 'rotate-180': !isOpen, 'm-5': isOpen }, 'w-6 h-6']"
                aria-hidden="true"
            />
        </button>

        <template v-if="isOpen">
            <div class="flex flex-col gap-2">
                <button
                    @click="shareFacebook"
                    aria-label="Share on Facebook"
                    class="w-9 h-9 rounded-md bg-[#3b5998] hover:bg-[#2d4373] text-white flex items-center justify-center cursor-pointer"
                >
                    F
                </button>

                <button
                    @click="shareTwitter"
                    aria-label="Share on Twitter"
                    class="w-9 h-9 rounded-md bg-[#1DA1F2] hover:bg-[#0d95e8] text-white flex items-center justify-center cursor-pointer"
                >
                    T
                </button>

                <button
                    @click="copyUrl"
                    :aria-label="copied ? 'URL copied' : 'Copy URL to clipboard'"
                    class="w-9 h-9 rounded-md bg-gray-700 hover:bg-gray-900 text-white flex items-center justify-center cursor-pointer relative"
                >
                    <ClipboardIcon class="w-5 h-5" />
                    <span
                        v-if="copied"
                        class="absolute -top-6 left-1/2 -translate-x-1/2 bg-black text-white text-xs rounded px-1"
                    >
            Copied!
          </span>
                </button>
            </div>
        </template>
    </div>
</template>
