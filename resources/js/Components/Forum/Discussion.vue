<template>
    <div class="mt-4 overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="flex items-center space-x-6 p-6 text-gray-900">
            <div class="flex-grow">
                <div class="flex items-center space-x-3">
                    <div
                        class="inline-flex items-center rounded-lg bg-gray-100 px-3 py-1 text-sm text-gray-600"
                    >
                        {{ discussion.topic.name }}
                    </div>
                    <h2 class="text-lg font-medium">
                        <template v-if="discussion.is_pinned"
                            ><span class="me-1 font-bold text-gray-500"
                                >[Pinned]</span
                            ></template
                        >
                        {{ discussion.title }}
                    </h2>
                </div>
            </div>
            <div>Avatars</div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Discussion } from '@/types/types';

defineProps<{
    discussion: Discussion;
}>();
</script>
