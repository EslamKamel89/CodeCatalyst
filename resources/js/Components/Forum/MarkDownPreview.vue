<template>
    <div
        class="mt-4 h-20 w-full overflow-y-scroll rounded-xl border border-gray-400 p-3 align-top shadow-sm"
    >
        {{ markDownPreviewHtml }}
    </div>
</template>

<script setup lang="ts">
import useCreateDiscussion from '@/Composables/useCreateDiscussion';
import { ref, watch } from 'vue';
const { markDownPreview } = useCreateDiscussion();
const markDownPreviewHtml = ref('Loading......');
watch(markDownPreview, (isEnabled) => {
    if (!isEnabled) return;
});
</script>
