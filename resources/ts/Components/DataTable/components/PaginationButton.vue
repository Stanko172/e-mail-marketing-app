<script lang="ts" setup>
import { Icon } from '@iconify/vue';

defineProps<{
    icon: string;
    href: string | null;
    srOnly: string;
}>();
</script>

<template>
    <button class="px-3 py-2" :disabled="!href">
        <span class="sr-only">{{ srOnly }}</span>
        <Icon
            :icon="icon"
            class="w-7 h-7 text-slate-500 hover:text-slate-700"
        />
    </button>
</template>
