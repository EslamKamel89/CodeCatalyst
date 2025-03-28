<template>
    <div class="w-full">
        <label class="input w-full">
            <svg
                class="h-[1em] opacity-50"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
            >
                <g
                    stroke-linejoin="round"
                    stroke-linecap="round"
                    stroke-width="2.5"
                    fill="none"
                    stroke="currentColor"
                >
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </g>
            </svg>
            <input
                v-model="searchQuery"
                type="search"
                required
                placeholder="Search"
                class="w-full"
            />
        </label>
    </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { debounce } from 'lodash';
import { ref, watch } from 'vue';
const searchQuery = ref('');
watch(
    searchQuery,
    debounce(
        () =>
            router.get(
                route('home'),
                { 'filter[title]': searchQuery.value },
                {
                    preserveScroll: true,
                    preserveState: true,
                },
            ),
        1000,
    ),
);
</script>
