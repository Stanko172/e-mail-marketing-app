<script lang="ts" setup>
import { computed } from 'vue';
import type { DataTableHeading } from '../types';
import { chain } from 'lodash';

const props = defineProps<{
    headings: Array<DataTableHeading>;
    items: Array<object>;
}>();

const hasActions = computed<boolean>(() => {
    return chain(props.headings)
        .find(({ key }) => key === 'actions')
        .isEmpty();
});
</script>

<template>
    <div class="border border-slate-200 shadow-sm overflow-x-auto rounded-md">
        <table class="table-auto w-full text-sm text-left text-slate-500">
            <thead class="bg-slate-50 text-xs uppercase text-slate-700">
                <tr>
                    <th
                        v-for="{ key, title } in headings"
                        :key="key"
                        class="px-6 py-3"
                    >
                        {{ title }}
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr
                    v-for="(item, index) in items"
                    :key="index"
                    class="border-b border-slate-200"
                >
                    <td
                        v-for="(value, key) in item"
                        :key="key"
                        class="px-6 py-4"
                    >
                        <slot :name="key" :item="item">
                            {{ value }}
                        </slot>
                    </td>

                    <td v-if="hasActions">
                        <slot name="actions" :item="item"></slot>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
