<template>
    <Head :title="discussion.title" />

    <FourmLayout>
        <!-- <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ discussion.title }}
            </h2>
        </template> -->
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="relative p-6 text-gray-900">
                <Discussion :discussion="discussion" :showPage="true" />
                <div class="absolute bottom-2 right-5">
                    <button
                        v-if="discussion.user_can.delete"
                        class="btn btn-error btn-sm text-white"
                        title="Delete"
                        @click="deleteDiscussion"
                    >
                        <TrashIcon class="size-5" />
                    </button>
                </div>
            </div>
        </div>
        <template v-if="posts.data.length">
            <div>
                <PostComp
                    v-for="post in posts.data"
                    :key="post.id"
                    :post="post"
                />
                <PaginationComp :pagination="posts.meta" />
            </div>
        </template>
        <template v-else>
            <div class="mt-5 w-full text-center text-lg text-gray-500">
                Thre are no posts yet
            </div>
        </template>
        <template #side>
            <!-- <ToggleFormButton />-->
            <TogglePostFormButton :discussion />
            <Navigation />
        </template>
    </FourmLayout>
</template>

<script setup lang="ts">
import Discussion from '@/Components/Forum/Discussion.vue';
import Navigation from '@/Components/Forum/Navigation.vue';
import PostComp from '@/Components/Forum/PostComp.vue';
import TogglePostFormButton from '@/Components/Forum/TogglePostFormButton.vue';
import PaginationComp from '@/Components/PaginationComp.vue';
import useDeleteDiscussion from '@/Composables/useDeleteDiscussion';
import useScroll from '@/Composables/useScroll';
import FourmLayout from '@/Layouts/FourmLayout.vue';
import {
    Discussion as DiscussionType,
    Pagination as PaginationType,
    Post,
} from '@/types/types';
import { TrashIcon } from '@heroicons/vue/16/solid';
import { Head } from '@inertiajs/vue3';
import { onMounted, onUpdated } from 'vue';
const props = defineProps<{
    discussion: DiscussionType;
    posts: PaginationType<Post>;
    postId?: number | null;
}>();

onMounted(() => {
    if (!props.postId) return;
    useScroll().scrollTo(`#post-${props.postId}`);
});
onUpdated(() => {
    if (!props.postId) return;
    useScroll().scrollTo(`#post-${props.postId}`);
});
const { deleteDiscussion } = useDeleteDiscussion(props.discussion);
</script>
