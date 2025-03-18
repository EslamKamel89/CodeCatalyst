<template>
    <div
        class="fixed bottom-0 w-full space-y-3 border-t-4 border-gray-100 bg-white p-6 text-black"
    >
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                <slot name="header" />
            </div>
            <div>
                <slot name="main" />
                <div>
                    <slot name="button" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts"></script>
