<template>
    <Head title="Discussion" />

    <FourmLayout> {{ discussion }} </FourmLayout>
</template>

<script setup lang="ts">
import FourmLayout from '@/Layouts/FourmLayout.vue';
import { Discussion as DiscussionType } from '@/types/types';
import { Head, usePage } from '@inertiajs/vue3';

const page = usePage();
defineProps<{
    discussion: DiscussionType;
}>();
</script>
