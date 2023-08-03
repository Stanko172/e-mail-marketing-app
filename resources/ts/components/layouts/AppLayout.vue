<script lang="ts" setup>
import { Link, router } from '@inertiajs/vue3';

interface NavigationLink {
    id: number;
    name: string;
    href: string;
    route: string;
}

const navigationLinks: NavigationLink[] = [
    {
        id: 1,
        name: 'Home',
        href: '/',
        route: 'home',
    },
    {
        id: 2,
        name: 'Subscribers',
        href: '/subscribers',
        route: 'subscribers.index',
    },
    {
        id: 3,
        name: 'Broadcast',
        href: '/broadcasts',
        route: 'broadcasts.index',
    },
];

function logout(): void {
    router.post(route('logout'));
}
</script>

<template>
    <div>
        <nav
            class="bg-white dark:bg-gray-900 w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600"
        >
            <div class="mx-6 flex flex-wrap items-center justify-between p-4">
                <div class="flex md:order-2">
                    <button
                        @click="logout"
                        type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
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
                        class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white mr-12"
                    >
                        E-mail marketing app
                    </span>

                    <ul
                        class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700"
                    >
                        <li v-for="link in navigationLinks" :key="link.id">
                            <a
                                :href="link.href"
                                class="py-2 pl-3 pr-4 text-white rounded md:bg-transparent md:p-0"
                                :class="
                                    route().current() === link.route
                                        ? 'text-blue-700'
                                        : 'text-gray-700'
                                "
                                >{{ link.name }}</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="mt-16 max-w-7xl mx-auto">
            <slot />
        </main>
    </div>
</template>
