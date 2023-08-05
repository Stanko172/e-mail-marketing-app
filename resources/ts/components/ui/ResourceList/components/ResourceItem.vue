<script lang="ts" setup>
import { Icon } from '@iconify/vue';
import { router } from '@inertiajs/vue3';

const props = defineProps<{
    title: string;
    description?: string;
    href: string;
}>();

function visit(): void {
    router.get(props.href);
}
</script>

<template>
    <li
        @click="visit"
        class="p-4 hover:bg-gray-50 cursor-pointer flex justify-between"
    >
        {{ href }}
        <div class="flex flex-col">
            <span class="text-sm font-semibold leading-6 text-gray-900">
                {{ title }}
            </span>
            <span
                v-if="description"
                class="mt-1 truncate text-xs leading-5 text-gray-500"
            >
                {{ description }}
            </span>
        </div>
        <div class="flex items-center">
            <Icon
                icon="heroicons:chevron-right-20-solid"
                style="font-size: 24px"
            />
        </div>
    </li>
</template>
