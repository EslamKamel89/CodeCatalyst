<template>
    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <nav class="space-y-2">
                <ul class="space-y-2">
                    <li>
                        <Link
                            :href="route('home')"
                            :class="{
                                'bg-blue-50 font-bold text-blue-700':
                                    !query?.filter &&
                                    $page.component === 'Forum/Index',
                            }"
                            >All Discussions</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('home', { 'filter[noreplies]': 1 })"
                            :class="{
                                'bg-blue-50 font-bold text-blue-700':
                                    query?.filter?.noreplies,
                            }"
                            >No Repiies</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('home', { 'filter[solved]': 1 })"
                            :class="{
                                'bg-blue-50 font-bold text-blue-700':
                                    query?.filter?.solved,
                            }"
                            >Solved</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('home', { 'filter[notsolved]': 1 })"
                            :class="{
                                'bg-blue-50 font-bold text-blue-700':
                                    query?.filter?.notsolved,
                            }"
                            >Not Solved</Link
                        >
                    </li>
                </ul>
                <ul
                    class="space-y-2 border-t border-gray-400 pt-2"
                    v-if="$page.props.auth.user"
                >
                    <li>
                        <Link
                            :href="route('home', { 'filter[mine]': 1 })"
                            :class="{
                                'bg-blue-50 font-bold text-blue-700':
                                    query?.filter?.mine &&
                                    $page.component === 'Forum/Index',
                            }"
                            >My Discussions</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="
                                route('home', { 'filter[participating]': 1 })
                            "
                            :class="{
                                'bg-blue-50 font-bold text-blue-700':
                                    query?.filter?.participating,
                            }"
                            >Participating</Link
                        >
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script setup lang="ts">
import { DiscussionIndexQuery } from '@/types/types';
import { Link } from '@inertiajs/vue3';
defineProps<{
    query?: DiscussionIndexQuery;
}>();
</script>
