<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import ThemeToggle from "@/Components/ThemeToggle.vue";

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen flex flex-col bg-gray-100 dark:bg-gray-800">
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('sessions')">
                                    <ApplicationMark class="block h-9 w-auto" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink :href="route('sessions')" :active="route().current('sessions')">
                                    Sessions
                                </NavLink>
                                <NavLink :href="route('profile.show')" :active="route().current('profile.show')">
                                    Profile
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <div class="inline-flex items-center px-1 pt-1">
                                <ThemeToggle />
                            </div>

                            <form @submit.prevent="logout" class="items-center flex">
                                <button type="submit" class="'inline-flex items-center text-sm pt-1 ps-8 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition duration-150 ease-in-out">
                                    Log out
                                </button>
                            </form>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out" @click="showingNavigationDropdown = ! showingNavigationDropdown">
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('sessions')" :active="route().current('sessions')">
                            Sessions
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')">
                            Profile
                        </ResponsiveNavLink>
                        <form @submit.prevent="logout" class="items-center flex">
                            <button type="submit" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 transition duration-150 ease-in-out">
                                Log out
                            </button>
                        </form>
                        <div class="inline-flex items-center px-1 pt-1">
                            <ThemeToggle :reverse="true" />
                        </div>
                    </div>
                </div>
            </nav>

            <div class="flex-grow lg:mx-16 lg:my-8 my-4 mx-6 rounded-xl bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-200 shadow">
                <div class="rounded-xl px-4 py-2">
                    <!-- Page Heading -->
                    <header v-if="$slots.header" class="">
                        <div class="mx-auto py-6 text-3xl mb-8 border-b border-gray-200 dark:border-gray-800">
                            <h2 class="font-bold text-2xl">
                                <slot name="header" />
                            </h2>
                        </div>
                    </header>

                    <!-- Page Content -->
                    <main>
                        <slot />
                    </main>
                </div>
            </div>
        </div>
    </div>
</template>
