<template>
    <div class="mt-2 flex items-center justify-between">
        <MarkDownToolbarComp for="comment-textarea" />
        <button
            @click="markDownPreview = !markDownPreview"
            class="btn btn-ghost btn-sm font-bold"
            type="button"
        >
            MarkDown Preview
            <span
                class="btn btn-sm text-white"
                :class="{
                    'btn-success': markDownPreview,
                    'btn-error': !markDownPreview,
                }"
            >
                {{ markDownPreview ? 'ON' : 'OFF' }}</span
            >
        </button>
    </div>
</template>

<script setup lang="ts">
import useCreateDiscussion from '@/Composables/useCreateDiscussion';
import MarkDownToolbarComp from './MarkDownToolbarComp.vue';

const { markDownPreview } = useCreateDiscussion();
</script>
