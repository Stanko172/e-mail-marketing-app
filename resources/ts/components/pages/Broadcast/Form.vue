<script lang="ts" setup>
import { AppLayout } from '@app/components/layouts';
import { Textarea, TextInput } from '@app/components/ui';
import * as Types from '@app/types/generated';
import { useForm } from '@inertiajs/inertia-vue3';
import { onMounted } from 'vue';

type UpsertBroadcastViewModel =
    Types.Domain.Mail.ViewModels.Broadcast.UpsertBroadcastViewModel;

const props = defineProps<{
    model: UpsertBroadcastViewModel;
}>();

const form = useForm({
    id: null,
    subject: null,
    content: null,
    filters: {
        tag_ids: [],
        form_ids: [],
    },
});

onMounted(() => {
    if (!props.model.broadcast) {
        return;
    }

    form.id = props.model.broadcast.id;
    form.subject = props.model.broadcast.subject;
    form.content = props.model.broadcast.content;
    form.filters.form_ids = props.model.broadcast.filters.form_ids;
    form.filters.tag_ids = props.model.broadcast.filters.tag_ids;
});
</script>

<template>
    <AppLayout>
        <form>
            <div>
                <TextInput label="Subject" />
            </div>
            <div>
                <Textarea label="Content" />
            </div>
        </form>
    </AppLayout>
</template>
