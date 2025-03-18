<template>
    <FixedFormWrapper v-if="isVisible">
        <template #header>
            <div class="flex items-center justify-between">
                <div class="text-lg font-medium">New Discussion</div>
                <div class="cursor-pointer" @click="hideForm">X</div>
            </div>
        </template>
        <template #main>
            <div class="mt-4 flex items-start space-x-3">
                <div class="flex-grow">
                    <input
                        type="text"
                        class="w-full rounded-xl px-4 py-2 placeholder:text-gray-400"
                        placeholder="Enter the duscussion title"
                    />
                </div>
                <div>
                    <select class="rounded-xl py-2">
                        <option :value="0" disabled>Choose a topic</option>
                        <option
                            v-for="topic in page.props.topics"
                            :key="topic.id"
                            :value="topic.id"
                        >
                            {{ topic.name }}
                        </option>
                    </select>
                </div>
            </div>
            <textarea
                class="mt-4 w-full rounded-xl placeholder:text-gray-400"
                placeholder="Enter Your Post"
            ></textarea>
        </template>
        <template #button>
            <div class="my-4">
                <button
                    class="btn btn-success btn-sm text-sm text-white"
                    type="submit"
                >
                    Create Discussion
                </button>
            </div>
        </template>
    </FixedFormWrapper>
</template>

<script setup lang="ts">
import useCreateDiscussion from '@/Composables/useCreateDiscussion';
import { usePage } from '@inertiajs/vue3';
import FixedFormWrapper from './FixedFormWrapper.vue';
const page = usePage();
const { isVisible, hideForm } = useCreateDiscussion();
</script>
