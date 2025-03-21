<template>
    <button
        @click="toggleForm"
        class="btn btn-sm w-full text-sm text-white"
        :class="{ 'btn-success': !isVisible, 'btn-warning': isVisible }"
        v-if="page.props.auth.user"
    >
        {{ isVisible ? 'Hide Form' : 'Start A Conversation' }}
    </button>
</template>

<script setup lang="ts">
import useCreateDiscussion from '@/Composables/useCreateDiscussion';
import { usePage } from '@inertiajs/vue3';

const { toggleForm, isVisible } = useCreateDiscussion();
const page = usePage();
</script>
