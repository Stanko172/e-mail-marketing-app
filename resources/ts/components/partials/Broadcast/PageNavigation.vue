<script lang="ts" setup>
import { PageNavigation, PageNavigationItem } from '@app/components/ui';
</script>

<template>
    <PageNavigation>
        <PageNavigationItem
            title="Broadcasts"
            :href="route('broadcasts.index')"
            :active="
                route().current() === 'broadcasts.index' ||
                route().current() === 'broadcasts.edit' ||
                route().current() === 'broadcasts.create'
            "
        />
        <PageNavigationItem title="Sequences" />
    </PageNavigation>
</template>
