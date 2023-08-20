<script lang="ts" setup>
import { uniqueId } from '@app/utils';
import type { SelectOption } from '../types';

const props = defineProps<{
    id?: string;
    options: SelectOption[];
}>();

const modelValue = defineModel();
const elementId = props.id || uniqueId('select');
</script>

<template>
    <div>
        <label
            :for="elementId"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        >
            Select an option
        </label>

        <select
            :id="elementId"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
        >
            <option
                v-for="option in options"
                :key="option.value"
                :value="option.value"
                :selected="option.value === modelValue"
                @click="modelValue = option.value"
            >
                {{ option.title }}
            </option>
        </select>
    </div>
</template>
