<template>
    <div>{{ post.body }}</div>
</template>

<script setup lang="ts">
import { Post } from '@/types/types';

defineProps<{
    post: Post;
}>();
</script>
