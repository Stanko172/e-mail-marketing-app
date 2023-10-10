<script lang="ts" setup>
import {
    Button,
    Page,
    PageActions,
    PageActionsItem,
    ResourceItem,
    ResourceList,
} from '@app/components/ui';
import { PageNavigation } from '@app/components/partials/Broadcast';
import { AppLayout } from '@app/components/layouts';
import * as Types from '@app/types/generated';
import { router } from '@inertiajs/vue3';

type GetBroadcastsViewModel =
    Types.Domain.Mail.ViewModels.Sequence.GetSequencesViewModel;

defineProps<{
    model: GetBroadcastsViewModel;
}>();
</script>

<template>
    <AppLayout>
        <template #page-navigation>
            <PageNavigation />
        </template>

        <Page title="Sequences">
            <template #page-actions>
                <PageActions>
                    <PageActionsItem>
                        <Button @click="router.get(route('sequences.create'))">
                            Create sequence
                        </Button>
                    </PageActionsItem>
                </PageActions>
            </template>

            <ResourceList>
                <ResourceItem
                    v-for="sequence in model.sequences"
                    :key="sequence.id"
                    :title="sequence.title"
                    :description="sequence.sent_at"
                    :href="route('sequences.edit', sequence.id)"
                />
            </ResourceList>
        </Page>
    </AppLayout>
</template>
