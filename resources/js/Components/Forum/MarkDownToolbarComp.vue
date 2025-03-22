<template>
    <markdown-toolbar>
        <div class="flex items-center gap-x-3">
            <md-bold class="toolbar-button">bold</md-bold>
            <md-header class="toolbar-button">header</md-header>
            <md-italic class="toolbar-button">italic</md-italic>
            <md-quote class="toolbar-button">quote</md-quote>
            <md-code class="toolbar-button">code</md-code>
            <md-link class="toolbar-button">link</md-link>
        </div>
    </markdown-toolbar>
</template>

<script setup lang="ts"></script>

<style scoped>
.toolbar-button {
    @apply cursor-pointer rounded-lg bg-slate-600 px-3 py-2 text-white;
}
</style>
