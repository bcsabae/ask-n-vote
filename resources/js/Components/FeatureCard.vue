<script setup>
    const props = defineProps({
        text: String,
        icon: String
    })
</script>

<template>
    <div class="flex flex-col justify-center my-4 gap-y-8 text-center items-center text-3xl shadow-md hover:bg-gray-50 dark:hover:bg-gray-700 dark:bg-gray-800 h-full rounded-2xl px-8 py-12">
        <span :class="`pi ${icon}`" style="font-size: 1.8rem" />
        <p>{{ text }}</p>
    </div>
</template>
