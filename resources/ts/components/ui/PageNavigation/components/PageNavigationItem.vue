<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';

withDefaults(
    defineProps<{
        active?: boolean;
        title: string;
        href?: string;
    }>(),
    {
        href: '#',
        boolean: false,
    }
);
</script>

<template>
    <li>
        <Link
            :href="href"
            class="p-2 my-1 inline-block w-full"
            :class="
                active
                    ? 'text-blue-700 bg-blue-50'
                    : 'text-gray-700 hover:bg-gray-50 '
            "
        >
            {{ title }}
        </Link>
    </li>
</template>
