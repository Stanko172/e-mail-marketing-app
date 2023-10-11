<script lang="ts" setup>
defineProps<{
    id?: string;
}>();
</script>

<template>
    <form :id="id" class="grid grid-cols-12 gap-6">
        <slot />
    </form>
</template>
