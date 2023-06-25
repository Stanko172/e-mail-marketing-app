<script lang="ts" setup>
import { Spinner } from '@app/components/ui';

withDefaults(
    defineProps<{
        loading?: boolean;
        disabled?: boolean;
    }>(),
    {
        loading: false,
        disabled: false,
    }
);
</script>

<template>
    <button
        :class="{ 'opacity-25': disabled || loading }"
        :disabled="disabled || loading"
        type="submit"
        class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    >
        <Spinner v-if="loading" class="mx-auto" />
        <slot v-else />
    </button>
</template>
