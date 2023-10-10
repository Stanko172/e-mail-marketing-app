<script lang="ts" setup>
import { onMounted, onUnmounted, ref } from 'vue';

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
onUnmounted(() => dialog.value.removeEventListener('close', close));
</script>

<template>
    <dialog ref="dialog">
        <slot />
    </dialog>
</template>
