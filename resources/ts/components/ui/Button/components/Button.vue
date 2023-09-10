<script lang="ts" setup>
import { Spinner } from '@app/components/ui';
import { ButtonType, ButtonVariant } from '../types';
import { computed } from 'vue';

const props = withDefaults(
    defineProps<{
        loading?: boolean;
        disabled?: boolean;
        type?: ButtonType;
        variant?: ButtonVariant;
    }>(),
    {
        loading: false,
        disabled: false,
        type: ButtonType.Button,
        variant: ButtonVariant.Primary,
    }
);

const backgroundColor = computed(() => {
    return {
        'bg-red-600 hover:bg-red-700': props.variant === ButtonVariant.Critical,
        'bg-blue-600 hover:bg-blue-700':
            props.variant === ButtonVariant.Primary,
        'bg-green-600 hover:bg-green-700':
            props.variant === ButtonVariant.Success,
    };
});

const classList = computed(() => {
    return [
        { 'opacity-25': props.disabled || props.loading },
        backgroundColor.value,
    ];
});
</script>

<template>
    <button
        :class="classList"
        :disabled="disabled || loading"
        :type="type"
        class="w-full text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
    >
        <Spinner v-if="loading" class="mx-auto" />
        <slot v-else />
    </button>
</template>
