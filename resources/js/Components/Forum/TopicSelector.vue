<template>
    <div>
        <InputLabel class="sr-only" value="Topics" for="topics" />
        <select id="topics" v-model="selectedTopic" class="rounded-xl py-2">
            <option :value="0">All Topics</option>
            <option
                v-for="topic in page.props.topics"
                :key="topic.id"
                :value="topic.id"
            >
                {{ topic.name }}
            </option>
        </select>
    </div>
</template>

<script setup lang="ts">
import { DiscussionIndexQuery } from '@/types/types';
import { router, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import InputLabel from '../InputLabel.vue';
const props = defineProps<{
    query: DiscussionIndexQuery;
}>();
const page = usePage();
const selectedTopic = ref<number>(props.query.filter?.topic_id ?? 0);
watch(selectedTopic, () => {
    filterByTopicRequest();
});
const filterByTopicRequest = () => {
    if (selectedTopic.value != 0) {
        router.get(
            route('home', {
                _query: {
                    'filter[topic_id]': selectedTopic.value,
                },
            }),
        );
    } else {
        router.get(route('home'));
    }
};
</script>
