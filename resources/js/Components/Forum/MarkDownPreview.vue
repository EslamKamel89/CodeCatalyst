<template>
    <div
        class="mt-4 max-h-40 min-h-20 w-full overflow-y-scroll rounded-xl border border-gray-400 p-3 align-top shadow-sm"
        v-html="
            loading
                ? 'Please wait until loading your preview...'
                : error
                  ? error
                  : markDownPreviewHtml?.html
        "
    ></div>
</template>

<script setup lang="ts">
import { useAxios } from '@/Composables/useAxios';
import { onMounted } from 'vue';
// const { form } = useCreateDiscussion();
const props = defineProps<{
    body: string;
}>();
const {
    loading,
    error,
    execute,
    data: markDownPreviewHtml,
} = useAxios<{ html: string }>({
    url: '/markdown',
    method: 'POST',
    data: { body: props.body },
});
onMounted(async () => {
    execute();
});

// d
</script>
