<script lang="ts" setup>
import { ErrorMessage } from '../../ErrorMessage';
import { TextInputType } from '../types';

withDefaults(
    defineProps<{
        label: string;
        type?: TextInputType;
        name?: string;
        id?: string;
        placeholder?: string;
        required?: boolean;
        autofocus?: boolean;
        autocomplete?: string;
        error?: string;
    }>(),
    {
        autocomplete: 'off',
        autofocus: false,
        error: null,
        id: null,
        name: null,
        placeholder: null,
        type: TextInputType.Text,
    }
);

const modelValue = defineModel();
</script>

<template>
    <div>
        <label :for="id" class="block mb-2 text-sm font-medium text-gray-900">{{
            label
        }}</label>

        <input
            :type="type"
            :name="name"
            :id="id"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
            :placeholder="placeholder"
            v-model="modelValue"
            required
            autofocus
            :autocomplete="autocomplete"
        />

        <ErrorMessage v-if="error" :message="error" />
    </div>
</template>
