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
                            {{ discussion.topic?.name }}
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
                <template v-if="!showPage">
                    <div
                        class="flex flex-col items-center gap-y-1 text-xs font-thin text-gray-400"
                    >
                        <div class="flex items-center -space-x-2">
                            <div
                                v-for="user in particpants"
                                :key="user.id"
                                class="h-7 w-7 first-of-type:h-10 first-of-type:w-10"
                            >
                                <img
                                    class="rounded-full ring-2 ring-white"
                                    :src="user.avatar_url"
                                    alt=""
                                    :title="user.username"
                                />
                            </div>
                        </div>
                        <div v-if="discussion.particpants.length > avatarLimit">
                            +
                            {{ discussion.particpants.length - avatarLimit }}
                            more
                        </div>
                    </div>
                </template>
            </div>
            <template v-if="!showPage">
                <div class="mb-3 px-5 text-sm font-thin text-gray-500">
                    <div
                        class="markdown line-clamp-1"
                        v-html="discussion.post?.body_preview_markdown"
                    ></div>
                    <div class="mx-2 mt-1 flex justify-end text-xs">
                        <Link
                            :href="
                                route('discussions.show', {
                                    discussion: discussion.slug,
                                    post: discussion.latest_post?.id,
                                })
                            "
                            class="link link-hover"
                            >Last Post by
                            {{
                                discussion.latest_post?.user?.username ??
                                '[User Deleted]'
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
                            ><span v-if="discussion.replies_count">
                                |
                                {{
                                    pluralize(
                                        'reply',
                                        discussion.replies_count,
                                        true,
                                    )
                                }}</span
                            ></Link
                        >
                    </div>
                </div>
            </template>
            <template v-else>
                <div
                    v-if="discussion.replies_count"
                    class="flex w-full justify-end text-sm text-gray-500"
                >
                    <div>
                        {{ pluralize('reply', discussion.replies_count, true) }}
                    </div>
                </div>
            </template>
        </Link>
    </div>
</template>

<script setup lang="ts">
import { Discussion } from '@/types/types';
import { Link } from '@inertiajs/vue3';
import pluralize from 'pluralize';
import { computed } from 'vue';
const props = defineProps<{
    discussion: Discussion;
    showPage?: boolean | null;
}>();
const avatarLimit = 4;
const particpants = computed(() => {
    return props?.discussion?.particpants?.slice(0, avatarLimit);
});
</script>
