<script lang="ts" setup>
import { AppLayout } from '@app/components/layouts';
import {
    Button,
    ButtonType,
    ButtonVariant,
    Form,
    FormLayout,
    MultiSelect,
    Page,
    PageActions,
    PageActionsItem,
    Textarea,
    TextInput,
    type SelectOption,
} from '@app/components/ui';
import { PageNavigation } from '@app/components/partials/Broadcast';
import * as Types from '@app/types/generated';
import { useForm } from '@inertiajs/vue3';
import { computed, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';

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

function send(): void {
    router.patch(
        route('broadcasts.send', { broadcast: props.model.broadcast })
    );
}
</script>

<template>
    <AppLayout>
        <template #page-navigation>
            <PageNavigation />
        </template>

        <Page title="Edit Broadcast">
            <template #page-actions>
                <PageActions>
                    <PageActionsItem>
                        <Button>Preview</Button>
                    </PageActionsItem>
                    <PageActionsItem>
                        <Button @click="send" :variant="ButtonVariant.Success"
                            >Send</Button
                        >
                    </PageActionsItem>
                    <PageActionsItem>
                        <Button :variant="ButtonVariant.Critical"
                            >Remove</Button
                        >
                    </PageActionsItem>
                </PageActions>
            </template>

            <Form @submit.prevent="submit">
                <FormLayout>
                    <TextInput
                        label="Subject"
                        v-model="form.subject"
                        :error="form.errors['subject']"
                    />
                </FormLayout>
                <FormLayout>
                    <Textarea
                        label="Content"
                        v-model="form.content"
                        :error="form.errors['content']"
                    />
                </FormLayout>
                <FormLayout>
                    <MultiSelect
                        :options="formOptions"
                        v-model="form.filters.form_ids"
                        :error="form.errors['filters.form_ids']"
                    />
                </FormLayout>
                <FormLayout>
                    <MultiSelect
                        :options="tagOptions"
                        v-model="form.filters.tag_ids"
                        :error="form.errors['filters.tag_ids']"
                    />
                </FormLayout>
                <FormLayout>
                    <Button :type="ButtonType.Submit">Submit</Button>
                </FormLayout>
            </Form>
        </Page>
    </AppLayout>
</template>
