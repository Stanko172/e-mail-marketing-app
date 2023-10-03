<script lang="ts" setup>
import { ref } from 'vue';

const dialog = ref<HTMLDialogElement | null>(null);

function show(): void {
    dialog.value?.showModal();
}

function close(): void {
    dialog.value?.close();
}

defineExpose({
    close,
    show,
});
</script>

<template>
    <dialog ref="dialog">
        <slot />
    </dialog>
</template>
