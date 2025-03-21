<template>
    <div class="mt-2 flex justify-between">
        <div>markdown toolbar</div>
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

const { markDownPreview } = useCreateDiscussion();
</script>
