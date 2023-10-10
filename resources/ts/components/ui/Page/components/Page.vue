<script lang="ts" setup>
defineProps<{
    title?: string;
}>();
</script>

<template>
    <div>
        <div class="flex items-center justify-between">
            <div class="flex flex-col space-y-1">
                <h2
                    v-if="title"
                    class="text-2xl font-bold leading-7 text-gray-900"
                >
                    {{ title }}
                </h2>
                <p
                    v-if="$slots['description']"
                    class="text-sm text-gray-500 my-6"
                >
                    <slot name="description" />
                </p>
            </div>
            <slot v-if="$slots['page-actions']" name="page-actions" />
        </div>
        <slot />
    </div>
</template>
