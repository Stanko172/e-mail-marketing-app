<script lang="ts" setup>
import { AppLayout } from '@app/components/layouts';
import { PageNavigation } from '@app/components/partials/Broadcast';
import { Button, PageActions, PageActionsItem } from '@app/components/ui';
import * as Types from '@app/types/generated';
import { http } from '@app/services/';

type EditSequenceContentViewModel =
    Types.Domain.Mail.ViewModels.Sequence.EditSequenceContentViewModel;

const props = defineProps<{
    model: EditSequenceContentViewModel;
}>();

async function publish(): Promise<void> {
    const { status } = await http.patch<{ status: string }>(
        `/sequences/${props.model.sequence.id}/publish`
    );

    console.log('new status: ', status);

    // props.model.sequence.status = data.status;
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
            </PageActionsItem>
        </PageActions>
    </AppLayout>
</template>
