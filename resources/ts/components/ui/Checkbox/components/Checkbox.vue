<script lang="ts" setup>
defineProps<{
    label: string;
}>();

const modelValue = defineModel();
</script>

<template>
    <label>
        <input type="checkbox" class="mr-1" v-model="modelValue" />
        {{ label }}
    </label>
</template>
