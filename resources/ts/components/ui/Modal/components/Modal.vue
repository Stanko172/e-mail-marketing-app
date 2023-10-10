<script lang="ts" setup>
import { Icon } from '@iconify/vue';
import { onMounted, ref } from 'vue';

defineProps<{
    title?: string;
}>();

const emit = defineEmits<{
    close: [];
}>();

const dialog = ref<HTMLDialogElement | null>(null);

function show(): void {
    dialog.value?.showModal();
}

function close(): void {
    dialog.value?.close();
    emit('close');
}

defineExpose({
    close,
    show,
});

onMounted(() => dialog.value.addEventListener('close', close));
</script>

<template>
    <dialog ref="dialog" class="w-full max-w-3xl rounded-lg">
        <div class="flex items-center my-2">
            <h3 v-if="title" class="text-xl font-semibold text-gray-900">
                {{ title }}
            </h3>
            <Icon icon="heroicons-solid:x" class="ml-auto" />
        </div>
        <div class="my-6">
            <slot />
        </div>
        <div>
            <slot name="actions" />
        </div>
    </dialog>
</template>
