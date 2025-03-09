<template>
    <div class="mt-4 overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div>{{ discussion }}</div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Discussion } from '@/types/types';

defineProps<{
    discussion: Discussion;
}>();
</script>
