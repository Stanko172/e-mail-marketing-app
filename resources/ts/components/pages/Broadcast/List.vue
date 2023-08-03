<script lang="ts" setup>
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
        <pre>{{ model }}</pre>
    </AppLayout>
</template>
