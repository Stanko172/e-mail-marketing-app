<script lang="ts" setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { useGenericDataTable, type DataTableHeading } from '@app/Components';
import * as Types from '@app/types/generated';
import { router } from '@inertiajs/vue3';

type GetSubscribersViewModel =
    Types.Domain.Subscriber.ViewModels.GetSubscribersViewModel;

const props = defineProps<{ model: GetSubscribersViewModel }>();

interface User {
    first_name: string;
    last_name: string;
    email: string;
}

const UserDataTable = useGenericDataTable<User>();

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
        title: 'First name',
        key: 'email',
    },
    {
        title: 'Actions',
        key: 'actions',
    },
];

const items: Array<User> = [
    {
        first_name: 'Stanko',
        last_name: 'Bebek',
        email: 'stanko.bebek82@gmail.com',
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
        <pre>{{ model.subscribers }}</pre>
        <UserDataTable
            :headings="headings"
            :items="items"
            @paginate-previous="previousPage"
            @paginate-next="nextPage"
        >
            <template #email="{ item }"> test: {{ item.email }} </template>
            <template #actions="{ item }">edit {{ item.first_name }}</template>
        </UserDataTable>
    </AppLayout>
</template>
