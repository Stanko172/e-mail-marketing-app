<script lang="ts" setup>
defineProps<{
    label: string;
}>();
</script>

<template>
    <label>
        <input type="checkbox" class="mr-1" />
        {{ label }}
    </label>
</template>
