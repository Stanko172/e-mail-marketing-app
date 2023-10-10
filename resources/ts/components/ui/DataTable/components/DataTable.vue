<script lang="ts" setup>
import { computed } from 'vue';
import { chain } from 'lodash';
import type { DataTableHeading } from '../types';
import PaginationButton from './PaginationButton.vue';
import { map, pick } from 'lodash';

const props = defineProps<{
    headings: Array<DataTableHeading>;
    items: Array<object>;
}>();

defineEmits<{
    (e: 'paginate-previous'): void;
    (e: 'paginate-next'): void;
}>();

const hasActions = computed<boolean>(() => {
    return chain(props.headings)
        .find(({ key }) => key === 'actions')
        .isEmpty();
});

const itemsByHeadings = computed(() => {
    return props.items.map((item) => {
        return pick(item, map(props.headings, 'key'));
    });
});
</script>

<template>
    <div class="border border-slate-200 shadow-sm overflow-x-auto rounded-md">
        <div class="flex justify-end">
            <PaginationButton
                icon="material-symbols:chevron-left"
                href="#"
                sr-only="Previous"
                @click="$emit('paginate-previous')"
            />
            <PaginationButton
                icon="material-symbols:chevron-right-rounded"
                href="#"
                sr-only="Next"
                @click="$emit('paginate-next')"
            />
        </div>

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
                    v-for="(item, index) in itemsByHeadings"
                    :key="index"
                    class="border-b border-slate-200"
                >
                    <td
                        v-for="(value, key) in item"
                        :key="key"
                        class="px-6 py-4"
                    >
                        <slot :name="key" :item="items[index]">
                            {{ value }}
                        </slot>
                    </td>

                    <td v-if="hasActions" class="px-6 py-4">
                        <slot name="actions" :item="items[index]"></slot>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
