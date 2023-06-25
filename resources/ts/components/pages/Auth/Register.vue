<script setup lang="ts">
import {
    Button,
    ButtonType,
    TextInput,
    TextInputType,
} from '@app/components/ui';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
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
                        Create an account
                    </h1>
                    <form
                        class="space-y-4 md:space-y-6"
                        @submit.prevent="submit"
                    >
                        <div>
                            <TextInput
                                label="Name"
                                :type="TextInputType.Text"
                                name="name"
                                id="name"
                                placeholder="Your name"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />
                        </div>
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
                                autocomplete="new-password"
                                name="new-password"
                                id="new-password"
                                placeholder="••••••••"
                            />
                        </div>
                        <div>
                            <TextInput
                                label="Confirm password"
                                v-model="form.password_confirmation"
                                required
                                autocomplete="new-password"
                                :type="TextInputType.Password"
                                name="new-password"
                                id="password_confirmation"
                                placeholder="••••••••"
                            />
                        </div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input
                                    id="terms"
                                    aria-describedby="terms"
                                    type="checkbox"
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300"
                                    required
                                />
                            </div>
                            <div class="ml-3 text-sm">
                                <label
                                    for="terms"
                                    class="font-light text-gray-500"
                                    >I accept the
                                    <a
                                        class="font-medium text-blue-600 hover:underline"
                                        href="#"
                                        >Terms and Conditions</a
                                    ></label
                                >
                            </div>
                        </div>
                        <Button
                            :disabled="form.processing"
                            :loading="form.processing"
                            :type="ButtonType.Submit"
                        >
                            Create an account
                        </Button>
                        <p class="text-sm font-light text-gray-500">
                            <Link
                                :href="route('login')"
                                class="underline text-sm text-gray-600 hover:text-gray-900"
                            >
                                Already registered?
                            </Link>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
