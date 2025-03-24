<template>
    <div class="mt-2 flex items-center justify-between">
        <MarkDownToolbarComp for="comment-textarea" />
        <button
            @click="handleToggle"
            class="btn btn-ghost btn-sm font-bold"
            type="button"
        >
            MarkDown Preview
            <span
                class="btn btn-sm text-white"
                :class="{
                    'btn-success': showPreview,
                    'btn-error': !showPreview,
                }"
            >
                {{ showPreview ? 'ON' : 'OFF' }}</span
            >
        </button>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import MarkDownToolbarComp from './MarkDownToolbarComp.vue';
const showPreview = ref(false);
const emit = defineEmits<{
    togglePreview: [showPreview: boolean];
}>();
const handleToggle = () => {
    showPreview.value = !showPreview.value;
    emit('togglePreview', showPreview.value);
};
</script>
