<template>
    <div class="flex justify-between">
        <div>markdown toolbar</div>
        <button
            @click="handlePreviewToggle"
            class="btn btn-ghost btn-sm font-bold"
            type="button"
        >
            MarkDown Preview
            <span
                class="btn btn-sm text-white"
                :class="{
                    'btn-success': !markDownPreview,
                    'btn-error': markDownPreview,
                }"
            >
                {{ markDownPreview ? 'OFF' : 'ON' }}</span
            >
        </button>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';

const markDownPreview = ref(false);
const emit = defineEmits<{
    (e: 'toggleMarkDownPreview', markDownPreview: boolean): void;
}>();
const handlePreviewToggle = () => {
    markDownPreview.value = !markDownPreview.value;
    emit('toggleMarkDownPreview', markDownPreview.value);
};
</script>
