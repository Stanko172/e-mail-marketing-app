<script lang="ts" setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { useGenericDataTable, type DataTableHeading } from '@app/Components';

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
</script>

<template>
    <AppLayout>
        <UserDataTable :headings="headings" :items="items">
            <template #email="{ item }"> test: {{ item.email }} </template>
            <template #actions="{ item }">edit {{ item.first_name }}</template>
        </UserDataTable>
    </AppLayout>
</template>
