<template>
    <FixedFormWrapper v-if="isVisible">
        <template #header>
            <div class="flex items-center justify-between">
                <div class="text-lg font-medium">New Discussion</div>
                <div class="cursor-pointer" @click="hideForm">
                    <Svg name="close"></Svg>
                </div>
            </div>
        </template>
        <template #main>
            <form @submit.prevent="submit">
                <div>
                    <div class="mt-4 flex items-start space-x-3">
                        <div class="flex-grow">
                            <input
                                type="text"
                                class="w-full rounded-xl px-4 py-2 placeholder:text-gray-400"
                                placeholder="Enter the duscussion title"
                                v-model="form.title"
                            />
                            <div
                                class="text-sm text-red-500"
                                v-if="form.errors.title"
                            >
                                {{ form.errors.title }}
                            </div>
                        </div>

                        <div>
                            <select
                                class="rounded-xl py-2"
                                v-model="form.topic_id"
                            >
                                <option :value="0" disabled>
                                    Choose a topic
                                </option>
                                <option
                                    v-for="topic in page.props.topics"
                                    :key="topic.id"
                                    :value="topic.id"
                                >
                                    {{ topic.name }}
                                </option>
                            </select>
                            <div
                                class="text-sm text-red-500"
                                v-if="form.errors.topic_id"
                            >
                                {{ form.errors.topic_id }}
                            </div>
                        </div>
                    </div>

                    <textarea
                        v-if="!markDownPreview"
                        class="mt-4 h-20 w-full rounded-xl align-top placeholder:text-gray-400"
                        placeholder="Enter Your Post"
                        v-model="form.body"
                        id="comment-textarea"
                    ></textarea>
                    <MarkDownPreview v-else />
                    <div class="text-sm text-red-500" v-if="form.errors.body">
                        {{ form.errors.body }}
                    </div>
                </div>
                <MarkDownToolBar
                    @toggle-preview="(e) => (markDownPreview = e)"
                />
                <div class="my-4">
                    <button
                        class="btn btn-success btn-sm text-sm text-white"
                        type="submit"
                    >
                        Create Discussion
                    </button>
                </div>
            </form>
        </template>
        <template #button> </template>
    </FixedFormWrapper>
</template>

<script setup lang="ts">
import useCreateDiscussion from '@/Composables/useCreateDiscussion';
import { usePage } from '@inertiajs/vue3';
import Svg from '../Svg.vue';
import FixedFormWrapper from './FixedFormWrapper.vue';
import MarkDownPreview from './MarkDownPreview.vue';
import MarkDownToolBar from './MarkDownToolBar.vue';
const page = usePage();
const { isVisible, hideForm, form, markDownPreview } = useCreateDiscussion();
const submit = async () => {
    form.post(route('discussions.store'), {
        onSuccess() {
            form.reset();
            hideForm();
        },
    });
};
</script>
