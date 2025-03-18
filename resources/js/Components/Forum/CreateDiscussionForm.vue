<template>
    <FixedFormWrapper>
        <template #header>
            <div class="text-lg font-medium">New Discussion</div>
        </template>
        <template #main>
            <div class="flex items-start space-x-3">
                <div><input type="text" class="rounded-xl px-4 py-2" /></div>
                <div>
                    <select class="rounded-xl py-2">
                        <option :value="0">All Topics</option>
                        <option
                            v-for="topic in page.props.topics"
                            :key="topic.id"
                            :value="topic.id"
                        >
                            {{ topic.name }}
                        </option>
                    </select>
                </div>
            </div>
        </template>
        <template #button>
            <div>Button</div>
        </template>
    </FixedFormWrapper>
</template>

<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import FixedFormWrapper from './FixedFormWrapper.vue';
const page = usePage();
</script>
