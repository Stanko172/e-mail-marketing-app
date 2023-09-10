<script lang="ts" setup>
import { Spinner } from '@app/components/ui';
import { ButtonType } from '../types';

withDefaults(
    defineProps<{
        loading?: boolean;
        disabled?: boolean;
        type?: ButtonType;
    }>(),
    {
        loading: false,
        disabled: false,
        type: ButtonType.Button,
    }
);
</script>

<template>
    <button
        :class="{ 'opacity-25': disabled || loading }"
        :disabled="disabled || loading"
        :type="type"
        class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
    >
        <Spinner v-if="loading" class="mx-auto" />
        <slot v-else />
    </button>
</template>
