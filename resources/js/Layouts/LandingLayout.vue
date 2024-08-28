<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
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

        <div class="flex flex-col min-h-screen mx-auto bg-white dark:bg-gray-900">
            <nav class="lg:w-4/5 w-full px-2 mx-auto mt-4">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('sessions')">
                                    <ApplicationMark class="block w-12 h-auto" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px md:ms-10 md:flex">
                                <Link :href="route('home')" class="text-gray-700 hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400 font-black tracking-wider uppercase">
                                    Product
                                </Link>
                                <Link :href="route('home')" class="text-gray-700 hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400 font-black tracking-wider uppercase">
                                    Features
                                </Link>
                                <Link :href="route('home')" class="text-gray-700 hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400 font-black tracking-wider uppercase">
                                    Resources
                                </Link>
                            </div>
                        </div>

                        <div class="hidden space-x-8 md:-my-px sm:ms-10 md:flex items-center">
                            <div class="inline-flex items-center px-1 pt-1">
                                <ThemeToggle />
                            </div>

                            <Link :href="route('home')" class="ms-auto rounded-full bg-secondary hover:bg-primary hover:shadow transition ease-in-out duration-300 px-4 py-2 text-black font-black tracking-wider uppercase">
                                Get started
                            </Link>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center md:hidden">
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
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="md:hidden">
                    <div class="pt-2 px-4 pb-3 space-y-1 flex flex-col gap-y-4 mt-8 border-b border-b-gray-200">
                        <Link :href="route('home')" class="text-gray-700 hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400 font-black tracking-wider uppercase">
                            Product
                        </Link>
                        <Link :href="route('home')" class="text-gray-700 hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400 font-black tracking-wider uppercase">
                            Features
                        </Link>
                        <Link :href="route('home')" class="text-gray-700 hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400 font-black tracking-wider uppercase">
                            Resources
                        </Link>
                        <div class="py-4 flex flex-row justify-between">
                            <Link :href="route('home')" class="rounded-full bg-secondary hover:bg-primary hover:shadow transition ease-in-out duration-300 px-4 py-2 text-black font-black tracking-wider uppercase">
                                Get started
                            </Link>
                            <div class="inline-flex items-center px-1 pt-1">
                                <ThemeToggle :reverse="true" />
                            </div>
                        </div>

                    </div>
                </div>
            </nav>

            <div class="lg:w-4/5 w-full px-2 mx-auto flex-grow lg:my-8 my-4 rounded-xl bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-200">
                <div class="px-4 py-2">

                    <!-- Page Content -->
                    <main>
                        <slot />
                    </main>
                </div>
            </div>
        </div>
    </div>
</template>
