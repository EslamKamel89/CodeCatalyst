<template>
    <Head title="Home" />

    <FourmLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Home
            </h2>
        </template>

        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <TopicSelector :query />
            </div>
        </div>
        <div class="space-y-2">
            <Discussion
                v-for="discussion in discussions.data"
                :key="discussion.id"
                :discussion="discussion"
            />
        </div>
        <PaginationComp :pagination="discussions.meta" />
        <template #side>
            <button
                @click="toggleForm"
                class="btn btn-sm w-full text-sm text-white"
                :class="{ 'btn-success': !isVisible, 'btn-warning': isVisible }"
            >
                {{ isVisible ? 'Hide Form' : 'Show Form' }}
            </button>
            <Navigation :query />
        </template>
    </FourmLayout>
</template>

<script setup lang="ts">
import Discussion from '@/Components/Forum/Discussion.vue';
import Navigation from '@/Components/Forum/Navigation.vue';
import TopicSelector from '@/Components/Forum/TopicSelector.vue';
import PaginationComp from '@/Components/PaginationComp.vue';
import useCreateDiscussion from '@/Composables/useCreateDiscussion';
import FourmLayout from '@/Layouts/FourmLayout.vue';
import {
    DiscussionIndexQuery,
    Discussion as DiscussionType,
    Pagination,
} from '@/types/types';
import { Head } from '@inertiajs/vue3';

defineProps<{
    discussions: Pagination<DiscussionType>;
    query: DiscussionIndexQuery;
}>();

const { toggleForm, isVisible } = useCreateDiscussion();
</script>
