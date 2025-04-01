<template>
    <FixedFormWrapper v-if="isVisible">
        <template #header>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-lg font-medium text-gray-500">
                        Leave a Post to
                    </p>
                    <p class="font-medium">
                        {{ discussion?.title ?? 'this discussion' }}
                    </p>
                </div>

                <div class="cursor-pointer" @click="hideForm">
                    <Svg name="close"></Svg>
                </div>
            </div>
        </template>
        <template #main>
            <form @submit.prevent="submit">
                <div>
                    <AtTa v-if="!markDownPreview" :members="usernames">
                        <template #item="itemProps">
                            <div class="my-1 cursor-pointer px-2 text-sm">
                                {{ itemProps.item }}
                            </div>
                        </template>
                        <textarea
                            class="mt-4 h-20 w-full rounded-xl align-top placeholder:text-gray-400"
                            placeholder="Enter Your Post"
                            v-model="form.body"
                            id="comment-textarea"
                        ></textarea>
                    </AtTa>
                    <MarkDownPreview :body="form.body ?? ''" v-else />
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
                        Create Post
                    </button>
                </div>
            </form>
        </template>
        <template #button> </template>
    </FixedFormWrapper>
</template>

<script setup lang="ts">
import { useAxios } from '@/Composables/useAxios';
import useCreatePost from '@/Composables/useCreatePost';
import { usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import AtTa from 'vue-at/dist/vue-at-textarea';
import Svg from '../Svg.vue';
import FixedFormWrapper from './FixedFormWrapper.vue';
import MarkDownPreview from './MarkDownPreview.vue';
import MarkDownToolBar from './MarkDownToolBar.vue';
const page = usePage();
const { isVisible, hideForm, form, markDownPreview, discussion } =
    useCreatePost();
const submit = async () => {
    form.post(route('posts.store', { discussion: discussion.value?.slug }), {
        onSuccess() {
            form.reset();
            hideForm();
        },
    });
};
const { data: usernames, execute } = useAxios<string[]>({
    url: route('usernames.index'),
});
onMounted(() => {
    execute();
});
</script>
