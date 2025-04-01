<template>
    <div
        :id="`post-${post.id}`"
        class="relative mt-4 rounded-lg border p-6 text-gray-900 shadow-sm"
        :class="{
            'my-6 border-4 border-green-600 bg-green-50': isSolution,
            'bg-white': !isSolution,
        }"
    >
        <div class="flex items-start space-x-3 overflow-hidden">
            <div class="w-10 flex-shrink-0" v-if="post.user?.avatar_url">
                <img
                    :src="post.user.avatar_url"
                    alt="User Avatar"
                    class="h-10 w-10 rounded-full"
                />
            </div>
            <div class="w-full">
                <div class="">
                    <div class="">
                        {{ post?.user?.username ?? '[User Deleted]' }}
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ post.created_at.human }}
                    </div>
                </div>
                <div v-if="editing">
                    <AtTa :members="usernames">
                        <template #item="itemProps">
                            <div class="my-1 cursor-pointer px-2 text-sm">
                                {{ itemProps.item }}
                            </div>
                        </template>
                        <textarea
                            v-model="form.body"
                            class="markdown mt-3 w-full rounded-lg"
                        ></textarea>
                    </AtTa>
                    <div
                        class="px-3 text-xs text-red-500"
                        v-if="form.errors.body"
                    >
                        {{ form.errors.body }}
                    </div>
                </div>
                <div
                    v-else
                    class="markdown mt-3"
                    v-html="post.body_markdown"
                ></div>
            </div>
        </div>
        <div v-if="editing" class="flex justify-end gap-x-3">
            <button
                @click="editPost"
                class="btn btn-info btn-sm text-xs text-white"
            >
                Save
            </button>
            <button
                type="button"
                @click="editing = false"
                v-if="post.user_can?.update"
                class="btn btn-error btn-sm text-xs text-white"
                title="Cancel"
            >
                <XMarkIcon class="size-5" />
            </button>
        </div>
        <div class="flex justify-end gap-x-3" v-else>
            <button
                v-if="post.discussion.user_can.reply"
                @click="handleReply"
                class="btn btn-success btn-sm text-xs text-white"
                title="Reply"
            >
                <ChatBubbleBottomCenterTextIcon class="size-5" />
            </button>
            <button
                type="button"
                @click="editing = true"
                v-if="post.user_can?.update"
                class="btn btn-warning btn-sm text-xs text-white"
                title="Edit"
            >
                <PencilSquareIcon class="size-5" />
            </button>
            <button
                type="button"
                v-if="post.user_can?.delete"
                @click="deletePost"
                class="btn btn-error btn-sm text-xs text-white"
                title="Delete"
            >
                <TrashIcon class="size-5" />
            </button>
            <button
                type="button"
                v-if="post.discussion.user_can.solve"
                @click="toggleDiscussionSolution(isSolution)"
                class="btn btn-info btn-sm text-xs text-white"
                :title="`${isSolution ? 'Unmark' : 'Mark'} This Post As Solution`"
            >
                <BookmarkIcon class="size-5" />
                <span class="text-sm font-bold text-white"
                    >{{ isSolution ? 'Unmark' : 'Mark' }}
                    <span class="font-gray-500 text-xs">As Solution</span></span
                >
            </button>
        </div>
        <div
            class="absolute -bottom-5 right-0 rounded-lg bg-green-100 px-3 py-1 font-bold uppercase tracking-tighter text-green-900 shadow-lg"
            v-if="isSolution"
        >
            Best Solution
        </div>
    </div>
</template>

<script setup lang="ts">
import { useAxios } from '@/Composables/useAxios';
import useCreatePost from '@/Composables/useCreatePost';
import useDeletePost from '@/Composables/useDeletePost';
import useEditPost from '@/Composables/useEditPost';
import useToggleDiscussionSolution from '@/Composables/useToggleDiscussionSolution';
import { Post } from '@/types/types';
import {
    BookmarkIcon,
    ChatBubbleBottomCenterTextIcon,
    PencilSquareIcon,
    TrashIcon,
    XMarkIcon,
} from '@heroicons/vue/16/solid';
import { onMounted } from 'vue';
import AtTa from 'vue-at/dist/vue-at-textarea';

const props = defineProps<{
    post: Post;
    isSolution: boolean;
}>();
const { editing, form, editPost } = useEditPost(props.post);
const { showForm, setDiscussion } = useCreatePost();
const { deletePost } = useDeletePost(props.post);
const handleReply = () => {
    showForm();
    setDiscussion(props.post.discussion);
};
const { toggleDiscussionSolution } = useToggleDiscussionSolution(
    props.post.discussion,
    props.post.id,
);
const { data: usernames, execute } = useAxios<string[]>({
    url: route('usernames.index'),
});
onMounted(() => {
    execute();
});
</script>
