<script lang="ts" setup>
import { AppLayout } from '@app/components/layouts';
import { PageNavigation } from '@app/components/partials/Broadcast';
import {
    Button,
    DataTable,
    PageActions,
    PageActionsItem,
} from '@app/components/ui';
import * as Types from '@app/types/generated';
import { http } from '@app/services/';
import { ref, watch } from 'vue';

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
    </AppLayout>
</template>
