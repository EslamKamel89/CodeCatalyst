<template>
    <div
        class="mt-4 h-20 w-full overflow-y-scroll rounded-xl border border-gray-400 p-3 align-top shadow-sm"
        v-html="markDownPreviewHtml?.html"
    ></div>
</template>

<script setup lang="ts">
import { useAxios } from '@/Composables/useAxios';
import useCreateDiscussion from '@/Composables/useCreateDiscussion';
import { onMounted } from 'vue';
const { form } = useCreateDiscussion();
const {
    loading,
    error,
    execute,
    data: markDownPreviewHtml,
} = useAxios<{ html: string }>({
    url: '/markdown',
    method: 'POST',
    data: { body: form.body },
});
onMounted(async () => {
    execute();
});

// d
</script>
