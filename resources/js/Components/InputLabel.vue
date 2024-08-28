<script setup>
defineProps({
    value: String,
});
</script>

<template>
    <label class="block text-gray-800 dark:text-gray-500">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
