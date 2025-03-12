<template>
    <div
        class="mt-4 flex items-center overflow-hidden bg-white p-6 text-gray-900 shadow-sm sm:rounded-lg"
    >
        {{ post.body }}
    </div>
</template>

<script setup lang="ts">
import { Post } from '@/types/types';

defineProps<{
    post: Post;
}>();
</script>
