<template>
    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <nav>
                <ul class="space-y-2">
                    <li>
                        <Link :href="route('home')">All Discussions</Link>
                    </li>
                    <li>
                        <Link :href="route('home')">No Repiies</Link>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>
