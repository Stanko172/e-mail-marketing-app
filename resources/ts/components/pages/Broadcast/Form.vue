<script lang="ts" setup>
import { AppLayout } from '@app/components/layouts';
import {
    Button,
    ButtonType,
    Form,
    FormLayout,
    MultiSelect,
    type SelectOption,
    Textarea,
    TextInput,
} from '@app/components/ui';
import { PageNavigation } from '@app/components/partials/Broadcast';
import * as Types from '@app/types/generated';
import { useForm } from '@inertiajs/vue3';
import { computed, onMounted } from 'vue';

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

const formOptions = computed<SelectOption[]>(() => {
    //@ts-ignore
    //TODO: update type transformer to recognize types from traits
    return props.model.forms.map((form) => ({
        title: form.title,
        value: form.id,
    }));
});

const tagOptions = computed<SelectOption[]>(() => {
    //@ts-ignore
    //TODO: update type transformer to recognize types from traits
    return props.model.tags.map((tag) => ({
        title: tag.title,
        value: tag.id,
    }));
});

function submit(): void {
    if (!props.model.broadcast) {
        form.post(route('broadcasts.store'));
    } else {
        form.put(
            route('broadcasts.update', { broadcast: props.model.broadcast })
        );
    }
}
</script>

<template>
    <AppLayout>
        <template #page-navigation>
            <PageNavigation />
        </template>

        <Form @submit.prevent="submit">
            <FormLayout>
                <TextInput label="Subject" v-model="form.subject" />
            </FormLayout>
            <FormLayout>
                <Textarea label="Content" v-model="form.content" />
            </FormLayout>
            <FormLayout>
                <MultiSelect
                    :options="formOptions"
                    v-model="form.filters.form_ids"
                />
            </FormLayout>
            <FormLayout>
                <MultiSelect
                    :options="tagOptions"
                    v-model="form.filters.tag_ids"
                />
            </FormLayout>
            <FormLayout>
                <Button :type="ButtonType.Submit">Submit</Button>
            </FormLayout>
        </Form>
    </AppLayout>
</template>
