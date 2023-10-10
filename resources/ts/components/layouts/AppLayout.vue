<script lang="ts" setup>
import { Link, router } from '@inertiajs/vue3';
import { useToastNotifications } from './composables';
import { NavigationLink } from './types';

useToastNotifications();

const navigationLinks: NavigationLink[] = [
    { id: 1, name: 'Home', route: 'home', group: 'home' },
    {
        id: 2,
        name: 'Subscribers',
        route: 'subscribers.index',
        group: 'subscribers',
    },
    {
        id: 3,
        name: 'Mails',
        route: 'broadcasts.index',
        group: ['broadcasts', 'sequences'],
    },
];

function logout(): void {
    router.post(route('logout'));
}

function isActive(group: NavigationLink['group']): boolean {
    const currentRoute: string = route().current();

    if (typeof group === 'string') {
        return currentRoute.includes(group);
    }

    if (typeof group === 'object') {
        return group
            .map((item) => currentRoute.includes(item))
            .some((item) => item === true);
    }

    return false;
}
</script>

<template>
    <div class="h-screen">
        <div class="h-full flex flex-col">
            <nav
                class="bg-white w-full z-20 top-0 left-0 border-b border-gray-200"
            >
                <div
                    class="mx-6 flex flex-wrap items-center justify-between p-4"
                >
                    <div class="flex md:order-2">
                        <button
                            @click="logout"
                            type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            logout
                        </button>
                        <button
                            data-collapse-toggle="navbar-sticky"
                            type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                            aria-controls="navbar-sticky"
                            aria-expanded="false"
                        >
                            <span class="sr-only">Open main menu</span>
                            <svg
                                class="w-6 h-6"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </button>
                    </div>
                    <div
                        class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1"
                        id="navbar-sticky"
                    >
                        <span
                            class="self-center text-2xl font-semibold whitespace-nowrap mr-12"
                        >
                            E-mail marketing app
                        </span>

                        <ul
                            class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white"
                        >
                            <li v-for="link in navigationLinks" :key="link.id">
                                <Link
                                    :href="route(link.route)"
                                    class="py-2 pl-3 pr-4"
                                    :class="
                                        isActive(link.group)
                                            ? 'text-blue-700'
                                            : 'text-gray-700'
                                    "
                                    >{{ link.name }}</Link
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <main
                class="grid mt-16 max-w-7xl w-full mx-auto flex-1 justify-stretch"
                :class="$slots['page-navigation'] ? 'grid-cols-4' : ''"
            >
                <div v-if="$slots['page-navigation']">
                    <slot name="page-navigation" />
                </div>
                <div class="col-span-3 w-full">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
