<script lang="ts" setup>
import { PageNavigation, PageNavigationItem } from '@app/components/ui';
import { AppLayout } from '@app/components/layouts';
import * as Types from '@app/types/generated';

type GetBroadcastsViewModel =
    Types.Domain.Mail.ViewModels.Broadcast.GetBroadcastsViewModel;

defineProps<{
    model: GetBroadcastsViewModel;
}>();
</script>

<template>
    <AppLayout>
        <template #page-navigation>
            <PageNavigation>
                <PageNavigationItem
                    title="Broadcasts"
                    :href="route('broadcasts.index')"
                    :active="route().current() === 'broadcasts.index'"
                />
                <PageNavigationItem title="Sequences" />
            </PageNavigation>
        </template>

        <pre>{{ model }}</pre>
    </AppLayout>
</template>
