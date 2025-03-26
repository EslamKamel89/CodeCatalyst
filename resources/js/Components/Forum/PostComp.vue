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
                <div v-if="editing">
                    <textarea
                        v-model="form.body"
                        class="markdown mt-3 w-full rounded-lg"
                    ></textarea>
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
            >
                Cancel
            </button>
        </div>
        <div class="flex justify-end gap-x-3" v-else>
            <button
                v-if="post.discussion.user_can.reply"
                @click="handleReply"
                class="btn btn-success btn-sm text-xs text-white"
            >
                Reply
            </button>
            <button
                type="button"
                @click="editing = true"
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
import useEditPost from '@/Composables/useEditPost';
import { Post } from '@/types/types';
const props = defineProps<{
    post: Post;
}>();
const { editing, form, editPost } = useEditPost(props.post);
const { showForm, setDiscussion } = useCreatePost();
const handleReply = () => {
    showForm();
    setDiscussion(props.post.discussion);
};
</script>
