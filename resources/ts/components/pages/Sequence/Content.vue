<script lang="ts" setup>
import { AppLayout } from '@app/components/layouts';
import { PageNavigation } from '@app/components/partials/Broadcast';
import {
    Button,
    Checkbox,
    DataTable,
    Form,
    FormLayout,
    Modal,
    MultiSelect,
    PageActions,
    PageActionsItem,
    Select,
    SelectOption,
    TextInput,
} from '@app/components/ui';
import * as Types from '@app/types/generated';
import { http } from '@app/services/';
import { computed, ref, watch } from 'vue';

type EditSequenceContentViewModel =
    Types.Domain.Mail.ViewModels.Sequence.EditSequenceContentViewModel;

const props = defineProps<{
    model: EditSequenceContentViewModel;
}>();

const mails = ref(props.model.sequence.mails);
const selectedMail = ref(null);

async function publish(): Promise<void> {
    const { status } = await http.patch<{ status: string }>(
        route('sequences.publish', { sequence: props.model.sequence.id })
    );

    console.log('new status: ', status);

    // props.model.sequence.status = data.status;
}

function addMail(): void {
    selectedMail.value = props.model.dummyMail;
    mails.value.push(selectedMail.value);
}

watch(selectedMail, async (newSelectedMail) => {
    if (!newSelectedMail.id) {
        const { id, schedule } = await http.post<{
            id: string;
            schedule: string;
        }>(
            `/sequences/${props.model.sequence.id}/mails`,
            props.model.dummyMail
        );

        selectedMail.value.id = id;
        selectedMail.value.schedule = schedule;
    }

    modal.value.show();
});

const modal = ref<HTMLDialogElement>(null);

const scheduleOptions: SelectOption[] = [
    {
        title: 'Day',
        value: 'day',
    },
    {
        title: 'Hour',
        value: 'hour',
    },
];

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
</script>

<template>
    <AppLayout>
        <template #page-navigation>
            <PageNavigation />
        </template>

        <PageActions>
            <PageActionsItem>
                <Button>See reports</Button>
            </PageActionsItem>
            <PageActionsItem>
                <Button
                    v-if="model.sequence.status === 'draft'"
                    @click="publish"
                >
                    Publish
                </Button>
                <Button @click="addMail"> Add e-mail </Button>
            </PageActionsItem>
        </PageActions>

        <DataTable
            :items="mails"
            :headings="[
                {
                    key: 'subject',
                    title: 'Subject',
                },
            ]"
        >
        </DataTable>

        <Modal ref="modal">
            <div class="flex space-x-2 mb-4">
                <Button> Preview </Button>
                <Button> Publish </Button>
                <Button> Unpublish </Button>
                <Button> Remove </Button>
            </div>

            <Form>
                <FormLayout>
                    <TextInput label="Subject" />
                </FormLayout>
                <FormLayout>
                    <TextInput label="Content" />
                </FormLayout>
                <FormLayout>
                    <Select :options="scheduleOptions" />
                </FormLayout>
                <FormLayout>
                    <div class="space-x-2">
                        <Checkbox label="Mon" />
                        <Checkbox label="Tue" />
                        <Checkbox label="Wed" />
                        <Checkbox label="Thur" />
                        <Checkbox label="Fri" />
                        <Checkbox label="Sat" />
                        <Checkbox label="Sun" />
                    </div>
                </FormLayout>
                <FormLayout>
                    <MultiSelect :options="formOptions" />
                </FormLayout>
                <FormLayout>
                    <MultiSelect :options="tagOptions" />
                </FormLayout>
            </Form>
        </Modal>
    </AppLayout>
</template>
