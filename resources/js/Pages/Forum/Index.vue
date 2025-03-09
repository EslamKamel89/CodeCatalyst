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
                <div>
                    <InputLabel class="sr-only" value="Topics" for="topics" />
                    <Select id="topics">
                        <option>All Topics</option>
                        <option
                            v-for="topic in page.props.topics"
                            :key="topic.id"
                            value="topic.slug"
                        >
                            {{ topic.name }}
                        </option>
                    </Select>
                </div>
            </div>
        </div>
        <div class="space-y-2">
            <Discussion
                v-for="discussion in discussions.data"
                :key="discussion.id"
                :discussion="discussion"
            />
        </div>
        <template #side>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">Side Slot</div>
            </div>
        </template>
    </FourmLayout>
</template>

<script setup lang="ts">
import Discussion from '@/Components/Forum/Discussion.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Select from '@/Components/Select.vue';
import FourmLayout from '@/Layouts/FourmLayout.vue';
import { Discussion as DiscussionType, Pagination } from '@/types/types';
import { Head, usePage } from '@inertiajs/vue3';

const page = usePage();
defineProps<{
    discussions: Pagination<DiscussionType>;
}>();
</script>
