<template>
    <div><component :is="icon" /></div>
</template>

<script setup lang="ts">
import { defineAsyncComponent } from 'vue';

const props = defineProps<{
    name: string;
}>();
const icon = defineAsyncComponent(() => import(`../../svg/${props.name}.svg`));
</script>
