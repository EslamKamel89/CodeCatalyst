<template>
    <Head title="Home" />

    <component
        :is="pr(page.props.auth.user) ? AuthenticatedLayout : GuestLayout"
    >
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Home
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Fourm Index</div>
                </div>
            </div>
        </div>
    </component>
</template>

<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { pr } from '@/Utils/pr';
import { Head, usePage } from '@inertiajs/vue3';

const page = usePage();
</script>
