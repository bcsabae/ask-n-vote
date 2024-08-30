<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import ThemeToggle from "@/Components/ThemeToggle.vue";
import CTA from "@/Components/CTA.vue";

defineProps({
    title: String,
    hasWaves: Boolean,
});

const showingNavigationDropdown = ref(false);
const year = new Date().getFullYear()

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="flex flex-col min-h-screen mx-auto bg-white dark:bg-gray-900">

            <div v-if="hasWaves" class="absolute z-0">
                <div class="overflow-hidden w-screen h-96 bg-primary bg-gradient-to-b from-gray-200 dark:from-gray-800 to-primary"></div>
                <div class="overflow-hidden w-screen">
                    <svg class="waves z-0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                        <defs>
                            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                        </defs>
                        <g class="parallax">
                            <use xlink:href="#gentle-wave" x="48" y="0" fill="#4deee8" />
                            <use xlink:href="#gentle-wave" x="48" y="3" fill="#4deee860" />
                            <use xlink:href="#gentle-wave" x="48" y="5" fill="#4deee880" />
                            <use xlink:href="#gentle-wave" x="48" y="7" fill="#4deee8a0" />
                        </g>
                    </svg>
                </div>
            </div>


            <nav class="lg:w-4/5 w-full px-2 mx-auto mt-4 z-10">
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
                                <Link href="#product" class="text-gray-700 hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400 font-black tracking-wider uppercase">
                                    Product
                                </Link>
                                <Link href="#features" class="text-gray-700 hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400 font-black tracking-wider uppercase">
                                    Features
                                </Link>
                                <Link href="#pricing" class="text-gray-700 hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400 font-black tracking-wider uppercase">
                                    Pricing
                                </Link>
                            </div>
                        </div>

                        <div class="hidden space-x-8 md:-my-px sm:ms-10 md:flex items-center">
                            <div class="inline-flex items-center px-1 pt-1">
                                <ThemeToggle />
                            </div>

                            <CTA :href="route('register')" text="Get started" />
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
                        <Link href="#product" class="text-gray-700 hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400 font-black tracking-wider uppercase">
                            Product
                        </Link>
                        <Link href="#features" class="text-gray-700 hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400 font-black tracking-wider uppercase">
                            Features
                        </Link>
                        <Link href="#pricing" class="text-gray-700 hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400 font-black tracking-wider uppercase">
                            Pricing
                        </Link>
                        <div class="py-4 flex flex-row justify-between">
                            <CTA :href="route('register')" text="Get started" />
                            <div class="inline-flex items-center px-1 pt-1">
                                <ThemeToggle :reverse="true" />
                            </div>
                        </div>

                    </div>
                </div>
            </nav>

            <div class="lg:w-4/5 w-full px-2 mx-auto flex-grow lg:my-8 my-4 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200">
                <div class="px-4 py-2">

                    <!-- Page Content -->
                    <main>
                        <slot />
                    </main>
                </div>
            </div>

            <div class="bg-gray-600 px-24 py-8 text-center">
                © {{ year }} AskNVote | <a class="hover:underline cursor-pointer">Privacy Policy</a> | <a class="hover:underline cursor-pointer">Terms of Use</a>
            </div>
        </div>
    </div>
</template>

<style>
.waves {
    position:relative;
    width: 100%;
    height:15vh;
    margin-bottom:-7px;
    min-height:100px;
    max-height:150px;
    transform: scaleY(-1);
}

.parallax > use {
    animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite;
}
.parallax > use:nth-child(1) {
    animation-delay: -2s;
    animation-duration: 18s;
}
.parallax > use:nth-child(2) {
    animation-delay: -3s;
    animation-duration: 15s;
}
.parallax > use:nth-child(3) {
    animation-delay: -4s;
    animation-duration: 25s;
}
.parallax > use:nth-child(4) {
    animation-delay: -5s;
    animation-duration: 40s;
}
@keyframes move-forever {
    0% {
        transform: translate3d(-90px,0,0);
    }
    100% {
        transform: translate3d(85px,0,0);
    }
}
@media (max-width: 768px) {
    .waves {
        height:40px;
        min-height:40px;
    }
}
@keyframes blink {
    from, to { border-color: transparent; }
    50% { border-color: black; }
}
</style>
