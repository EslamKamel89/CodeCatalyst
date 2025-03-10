<!-- eslint-disable vue/no-v-text-v-html-on-component -->
<template>
    <nav>
        <div class="mt-3 join" v-if="pagination.links.length > 3">
            <template v-for="link in pagination.links" :key="link.label">
                <Link
                    v-if="link.url"
                    class="btn join-item"
                    :class="{
                        'btn-active': link.active,
                    }"
                    :href="link.url"
                    v-html="link.label"
                ></Link>
            </template>
        </div>
    </nav>
</template>

<script setup lang="ts">
import { Meta } from '@/types/types';
import { Link } from '@inertiajs/vue3';

defineProps<{
    pagination: Meta;
}>();
</script>
