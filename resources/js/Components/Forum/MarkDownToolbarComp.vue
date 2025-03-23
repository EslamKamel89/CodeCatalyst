<template>
    <markdown-toolbar>
        <div class="flex items-center gap-x-3">
            <md-bold class="toolbar-button" title="bold"
                ><Svg class="h-7 w-7 object-fill" name="bold"
            /></md-bold>
            <md-header class="toolbar-button" title="header">
                <Svg class="h-7 w-7 object-fill" name="header"
            /></md-header>
            <md-italic class="toolbar-button" title="italic"
                ><Svg class="h-7 w-7 object-fill" name="italic"
            /></md-italic>
            <md-quote class="toolbar-button" title="quote"
                ><Svg class="h-7 w-7 object-fill" name="quote"
            /></md-quote>
            <md-code class="toolbar-button" title="code"
                ><Svg class="h-7 w-7 object-fill" name="code"
            /></md-code>
            <md-link class="toolbar-button" title="link"
                ><Svg class="h-7 w-7 object-fill" name="link"
            /></md-link>
        </div>
    </markdown-toolbar>
</template>

<script setup lang="ts">
import Svg from '../Svg.vue';
</script>

<style scoped>
.toolbar-button {
    @apply flex cursor-pointer items-center justify-center rounded-full bg-slate-600 pl-1 pt-1 text-center text-white;
}
</style>
