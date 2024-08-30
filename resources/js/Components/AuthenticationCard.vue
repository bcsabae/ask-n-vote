<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-800">
        <div>
            <slot name="logo" />
        </div>

        <div class="text-gray-300 text-center pt-16">
            <p class="mb-2">Want to join an existing session?</p>
            <a :href="route('q-and-a.login.form')" class="hover:underline italic">Log in as attendee</a>
        </div>

        <div class="w-full sm:max-w-lg px-16 py-16 overflow-hidden">
            <slot />
        </div>
    </div>
</template>
