<template>
    <div class="mt-4 overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <Link
            :href="route('discussions.show', { discussion: discussion.slug })"
        >
            <div class="flex items-center space-x-6 p-6 text-gray-900">
                <div class="flex-grow">
                    <div class="flex items-center space-x-3">
                        <div
                            class="inline-flex items-center rounded-lg bg-gray-100 px-3 py-1 text-sm text-gray-600"
                        >
                            {{ discussion.topic.name }}
                        </div>
                        <h2 class="text-lg font-medium">
                            <template v-if="discussion.is_pinned"
                                ><span class="me-1 font-bold text-gray-500"
                                    >[Pinned]</span
                                ></template
                            >
                            {{ discussion.title }}
                        </h2>
                    </div>
                </div>
                <div v-if="!hideAvatar" class="flex flex-wrap -space-x-2">
                    <div v-for="user in discussion.particpants" :key="user.id">
                        <img
                            class="h-7 w-7 rounded-full ring-2 ring-white"
                            :src="user.avatar_url"
                            alt=""
                            :title="user.username"
                        />
                    </div>
                </div>
            </div>
            <template v-if="!hideAvatar">
                <div class="mb-3 px-5 text-sm font-thin text-gray-500">
                    <div class="line-clamp-1">
                        {{ discussion.post?.body_preview }}
                    </div>
                    <div class="mx-2 mt-1 flex justify-end text-xs">
                        <Link
                            :href="
                                route('discussions.show', {
                                    discussion: discussion.slug,
                                })
                            "
                            class="link link-hover"
                            >Last Post by
                            {{
                                discussion.latest_post?.user?.username ??
                                'Unknown'
                            }}
                            <time
                                :title="
                                    discussion.latest_post?.created_at.datetime
                                "
                                :datetime="
                                    discussion.latest_post?.created_at.datetime
                                "
                            >
                                {{
                                    discussion.latest_post?.created_at.human
                                }}</time
                            ></Link
                        >
                    </div>
                </div>
            </template>
        </Link>
    </div>
</template>

<script setup lang="ts">
import { Discussion } from '@/types/types';
import { Link } from '@inertiajs/vue3';

defineProps<{
    discussion: Discussion;
    hideAvatar?: boolean | null;
}>();
</script>
