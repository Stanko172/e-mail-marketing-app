<script lang="ts" setup>
import { AppLayout } from '@app/components/layouts';
import {
    Button,
    ButtonType,
    Form,
    FormLayout,
    TextInput,
} from '@app/components/ui';
import { PageNavigation } from '@app/components/partials/Broadcast';
import * as Types from '@app/types/generated';
import { useForm } from '@inertiajs/vue3';

type CreateSequenceViewModel =
    Types.Domain.Mail.ViewModels.Sequence.CreateSequenceViewModel;

defineProps<{
    model: CreateSequenceViewModel;
}>();

const form = useForm({
    title: null,
});

function store(): void {
    form.post(route('sequences.store'));
}
</script>

<template>
    <AppLayout>
        <template #page-navigation>
            <PageNavigation />
        </template>

        <Form @submit.prevent="store">
            <FormLayout>
                <TextInput
                    label="Title"
                    v-model="form.title"
                    :error="form.errors['title']"
                />
            </FormLayout>
            <FormLayout>
                <Button :type="ButtonType.Submit">Submit</Button>
            </FormLayout>
        </Form>
    </AppLayout>
</template>
