<template>
    <Head title="Home" />

    <FourmLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Home
            </h2>
        </template>

        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <select id="topics">
                    <option>All Topics</option>
                    <option
                        v-for="topic in $page.props.topics"
                        :key="topic.id"
                        value="topic.slug"
                    >
                        {{ topic.name }}
                    </option>
                </select>
            </div>
        </div>
        <template #side>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">Side Slot</div>
            </div>
        </template>
    </FourmLayout>
</template>

<script setup lang="ts">
import FourmLayout from '@/Layouts/FourmLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';

const page = usePage();
</script>
