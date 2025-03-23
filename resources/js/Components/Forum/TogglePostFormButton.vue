<template>
    <button
        @click="handleToggle"
        class="btn btn-sm w-full text-sm text-white"
        :class="{ 'btn-success': !isVisible, 'btn-warning': isVisible }"
        v-if="page.props.auth.user"
    >
        {{ isVisible ? 'Hide Form' : 'Leave A Post' }}
    </button>
</template>

<script setup lang="ts">
import useCreatePost from '@/Composables/useCreatePost';
import { Discussion } from '@/types/types';
import { usePage } from '@inertiajs/vue3';
const props = defineProps<{
    discussion: Discussion;
}>();
const { toggleForm, isVisible, setDiscussion } = useCreatePost();
const page = usePage();
const handleToggle = () => {
    toggleForm();
    setDiscussion(props.discussion);
};
</script>
