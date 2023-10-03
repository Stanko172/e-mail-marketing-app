<script lang="ts" setup>
import { AppLayout } from '@app/components/layouts';
import { PageNavigation } from '@app/components/partials/Broadcast';
import {
    Button,
    ButtonType,
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

async function updateMail(mail: { id: string }): Promise<void> {
    await http.patch(
        `/sequences/${props.model.sequence.id}/mails/${mail.id}`,
        mail
    );
}

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

function changeSelectedMail(mail: object): void {
    selectedMail.value = mail;
}
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

        <!--TODO: Create new PerformanceLine component-->
        <div class="text-sm text-gray-900 my-6">
            {{ model.performance.total }} Subscribers •
            {{ model.performance.open_rate.formatted }} Open rate •
            {{ model.performance.click_rate.formatted }} Click rate
        </div>

        <DataTable
            :items="mails"
            :headings="[
                {
                    key: 'subject',
                    title: 'Subject',
                },
            ]"
            @selected="changeSelectedMail"
        >
            <template #actions="{ item }">
                <button @click="changeSelectedMail(item)">Edit</button>
            </template>
        </DataTable>

        <Modal ref="modal">
            <template v-if="selectedMail">
                <div class="flex space-x-2 mb-4">
                    <Button> Preview </Button>
                    <Button
                        v-if="selectedMail.status === 'draft'"
                        @click="selectedMail.status = 'published'"
                    >
                        Publish
                    </Button>
                    <Button
                        v-if="selectedMail.status === 'published'"
                        @click="selectedMail.status = 'draft'"
                    >
                        Unpublish
                    </Button>
                    <Button> Remove </Button>
                </div>
                <Form @submit.prevent="updateMail(selectedMail)">
                    <FormLayout>
                        <TextInput
                            label="Subject"
                            v-model="selectedMail.subject"
                        />
                    </FormLayout>
                    <FormLayout>
                        <TextInput
                            label="Content"
                            v-model="selectedMail.content"
                        />
                    </FormLayout>
                    <FormLayout>
                        <TextInput
                            label="Delay"
                            v-model="selectedMail.schedule.delay"
                        />
                    </FormLayout>
                    <FormLayout>
                        <Select
                            :options="scheduleOptions"
                            v-model="selectedMail.schedule.unit"
                        />
                    </FormLayout>
                    <FormLayout>
                        <div class="space-x-2">
                            <Checkbox
                                label="Mon"
                                v-model="
                                    selectedMail.schedule.allowed_days.monday
                                "
                            />
                            <Checkbox
                                label="Tue"
                                v-model="
                                    selectedMail.schedule.allowed_days.tuesday
                                "
                            />
                            <Checkbox
                                label="Wed"
                                v-model="
                                    selectedMail.schedule.allowed_days.wednesday
                                "
                            />
                            <Checkbox
                                label="Thur"
                                v-model="
                                    selectedMail.schedule.allowed_days.thursday
                                "
                            />
                            <Checkbox
                                label="Fri"
                                v-model="
                                    selectedMail.schedule.allowed_days.friday
                                "
                            />
                            <Checkbox
                                label="Sat"
                                v-model="
                                    selectedMail.schedule.allowed_days.saturday
                                "
                            />
                            <Checkbox
                                label="Sun"
                                v-model="
                                    selectedMail.schedule.allowed_days.sunday
                                "
                            />
                        </div>
                    </FormLayout>
                    <FormLayout>
                        <MultiSelect
                            :options="formOptions"
                            v-model="selectedMail.filters.form_ids"
                        />
                    </FormLayout>
                    <FormLayout>
                        <MultiSelect
                            :options="tagOptions"
                            v-model="selectedMail.filters.tag_ids"
                        />
                    </FormLayout>
                    <FormLayout>
                        <Button :type="ButtonType.Submit">Submit</Button>
                    </FormLayout>
                </Form>
            </template>
        </Modal>
    </AppLayout>
</template>
