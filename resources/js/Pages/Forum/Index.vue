<template>
    <Head title="Home" />

    <FourmLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Home
            </h2>
        </template>

        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="flex w-full items-center space-x-3 p-6 text-gray-900">
                <TopicSelector :query />
                <SearchDiscussionFilter class="flex-grow-1" :query />
            </div>
        </div>
        <div class="space-y-2" v-if="discussions.data.length">
            <Discussion
                v-for="discussion in discussions.data"
                :key="discussion.id"
                :discussion="discussion"
            />
        </div>
        <div
            class="mt-4 flex w-full items-center justify-center rounded-xl bg-white py-4 text-xs uppercase tracking-tight text-gray-500"
            v-else
        >
            <div>No Discussions Found</div>
        </div>
        <PaginationComp :pagination="discussions.meta" />
        <template #side>
            <ToggleFormButton />
            <Navigation :query />
        </template>
    </FourmLayout>
</template>

<script setup lang="ts">
import Discussion from '@/Components/Forum/Discussion.vue';
import Navigation from '@/Components/Forum/Navigation.vue';
import SearchDiscussionFilter from '@/Components/Forum/SearchDiscussionFilter.vue';
import ToggleFormButton from '@/Components/Forum/ToggleFormButton.vue';
import TopicSelector from '@/Components/Forum/TopicSelector.vue';
import PaginationComp from '@/Components/PaginationComp.vue';
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
</script>
