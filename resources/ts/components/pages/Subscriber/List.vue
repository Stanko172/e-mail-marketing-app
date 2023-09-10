<script lang="ts" setup>
import { AppLayout } from '@app/components/layouts';
import { useGenericDataTable, type DataTableHeading } from '@app/components/ui';
import * as Types from '@app/types/generated';
import { router } from '@inertiajs/vue3';

type SubscriberData =
    Types.Domain.Subscriber.DataTransferObjects.SubscriberData;
type GetSubscribersViewModel =
    Types.Domain.Subscriber.ViewModels.GetSubscribersViewModel;

const props = defineProps<{ model: GetSubscribersViewModel }>();

const SubscribersDataTable = useGenericDataTable<SubscriberData>();

const headings: Array<DataTableHeading> = [
    {
        title: 'First name',
        key: 'first_name',
    },
    {
        title: 'Last name',
        key: 'last_name',
    },
    {
        title: 'Email',
        key: 'email',
    },
    {
        title: 'Actions',
        key: 'actions',
    },
];

function previousPage(): void {
    if (!props.model.subscribers.prev_page_url) {
        return;
    }

    router.get(props.model.subscribers.prev_page_url);
}

function nextPage(): void {
    if (!props.model.subscribers.next_page_url) {
        return;
    }

    router.get(props.model.subscribers.next_page_url);
}
</script>

<template>
    <AppLayout>
        <SubscribersDataTable
            :headings="headings"
            :items="model.subscribers.data"
            @paginate-previous="previousPage"
            @paginate-next="nextPage"
        >
            <template #actions="{ item }">edit</template>
        </SubscribersDataTable>
    </AppLayout>
</template>
