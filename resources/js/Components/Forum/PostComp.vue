<template>
    <div
        class="mt-4 flex items-start space-x-3 overflow-hidden bg-white p-6 text-gray-900 shadow-sm sm:rounded-lg"
    >
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
            <div class="mt-3">
                {{ post.body }}
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Post } from '@/types/types';

defineProps<{
    post: Post;
}>();
</script>
