<script setup lang="ts">
import {
    Button,
    ButtonType,
    TextInput,
    TextInputType,
} from '@app/components/ui';
import { Head, useForm } from '@inertiajs/inertia-vue3';

defineProps<{
    canResetPassword: boolean;
    status: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <section class="bg-gray-50">
        <Head title="Register" />
        <div
            class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0"
        >
            <div
                class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0"
            >
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl"
                    >
                        Login
                    </h1>
                    <form
                        class="space-y-4 md:space-y-6"
                        @submit.prevent="submit"
                    >
                        <div>
                            <TextInput
                                label="Email"
                                :type="TextInputType.Text"
                                placeholder="name@company.com"
                                v-model="form.email"
                                required
                                autocomplete="email"
                                name="email"
                                id="email"
                            />
                        </div>
                        <div>
                            <TextInput
                                label="Password"
                                :type="TextInputType.Password"
                                v-model="form.password"
                                required
                                autocomplete="password"
                                name="password"
                                id="password"
                                placeholder="••••••••"
                            />
                        </div>
                        <Button
                            :disabled="form.processing"
                            :loading="form.processing"
                            :type="ButtonType.Submit"
                        >
                            Login
                        </Button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
