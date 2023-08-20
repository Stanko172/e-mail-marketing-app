<script lang="ts" setup>
defineProps<{
    message: string;
}>();
</script>

<template>
    <div class="mt-2 text-red-500 text-xs">{{ message }}</div>
</template>
