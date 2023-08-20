<script lang="ts" setup>
import {
    Button,
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
    Types.Domain.Mail.ViewModels.Broadcast.GetBroadcastsViewModel;

defineProps<{
    model: GetBroadcastsViewModel;
}>();
</script>

<template>
    <AppLayout>
        <template #page-navigation>
            <PageNavigation />
        </template>

        <PageActions>
            <PageActionsItem>
                <Button @click="router.get(route('broadcasts.create'))">
                    Create broadcast
                </Button>
            </PageActionsItem>
        </PageActions>

        <ResourceList>
            <ResourceItem
                v-for="broadcast in model.broadcasts"
                :key="broadcast.id"
                :title="broadcast.subject"
                :description="broadcast.sent_at"
                :href="route('broadcasts.edit', broadcast.id)"
            />
        </ResourceList>
    </AppLayout>
</template>
