<template>
    <AuthenticatedLayout>
        <template #header v-if="$slots.header">
            <slot name="header"
        /></template>
        <div
            class="mx-auto max-w-7xl gap-2 space-y-6 px-6 py-12 md:grid md:grid-cols-7 md:space-y-0 md:px-8"
        >
            <div class="col-span-2"><slot name="side" /></div>
            <div class="col-span-5"><slot /></div>
        </div>
    </AuthenticatedLayout>

    <CreateDiscussionForm />
    <CreatePostForm />
</template>

<script setup lang="ts">
import CreateDiscussionForm from '@/Components/Forum/CreateDiscussionForm.vue';
import CreatePostForm from '@/Components/Forum/CreatePostForm.vue';
import AuthenticatedLayout from './AuthenticatedLayout.vue';
</script>
