<script lang="ts" setup>
import { Spinner } from '@app/components/ui';
import { ButtonType, ButtonVariant } from '../types';
import { computed } from 'vue';

const props = withDefaults(
    defineProps<{
        disabled?: boolean;
        form?: string;
        loading?: boolean;
        plain?: boolean;
        type?: ButtonType;
        variant?: ButtonVariant;
    }>(),
    {
        disabled: false,
        form: null,
        loading: false,
        plain: false,
        type: ButtonType.Button,
        variant: ButtonVariant.Primary,
    }
);

const backgroundColor = computed(() => {
    if (props.plain) {
        return {};
    }

    return {
        'bg-red-600 hover:bg-red-700': props.variant === ButtonVariant.Critical,
        'bg-blue-600 hover:bg-blue-700':
            props.variant === ButtonVariant.Primary,
        'bg-green-600 hover:bg-green-700':
            props.variant === ButtonVariant.Success,
    };
});

const textColor = computed(() => {
    if (!props.plain) {
        return 'text-white';
    }

    return {
        'text-red-600 hover:text-red-700':
            props.variant === ButtonVariant.Critical,
        'text-blue-600 hover:text-blue-700':
            props.variant === ButtonVariant.Primary,
        'text-green-600 hover:text-green-700':
            props.variant === ButtonVariant.Success,
    };
});

const classList = computed(() => {
    return [
        { 'opacity-25': props.disabled || props.loading },
        { 'w-full px-5 py-2.5': !props.plain },
        { 'hover:underline': props.plain },
        backgroundColor.value,
        textColor.value,
    ];
});
</script>

<template>
    <button
        :class="classList"
        :disabled="disabled || loading"
        :form="form"
        :type="type"
        class="focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center whitespace-nowrap"
    >
        <Spinner v-if="loading" class="mx-auto" />
        <slot v-else />
    </button>
</template>
