<template>
    <div
        :id="`post-${post.id}`"
        class="mt-4 bg-white p-6 text-gray-900 shadow-sm sm:rounded-lg"
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
                <div class="markdown mt-3" v-html="post.body_markdown"></div>
            </div>
        </div>
        <div class="flex justify-end gap-x-3">
            <button
                v-if="post.discussion.user_can.reply"
                @click="handleReply"
                class="btn btn-success btn-sm text-xs text-white"
            >
                Reply
            </button>
            <button
                @click="handleUpdate"
                v-if="post.user_can?.update"
                class="btn btn-warning btn-sm text-xs text-white"
            >
                Edit
            </button>
        </div>
    </div>
</template>

<script setup lang="ts">
import useCreatePost from '@/Composables/useCreatePost';
import { Post } from '@/types/types';

const props = defineProps<{
    post: Post;
}>();
const { showForm, setDiscussion } = useCreatePost();
const handleReply = () => {
    showForm();
    setDiscussion(props.post.discussion);
};
const handleUpdate = () => {};
</script>
