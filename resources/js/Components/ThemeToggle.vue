<script setup>
import ToggleSwitch from 'primevue/toggleswitch';
import {onMounted, ref} from "vue";

const props = defineProps({
    reverse: Boolean
})

const dark = ref(false)

function toggleTheme() {
    if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    }
}

onMounted( () => {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.documentElement.classList.add('dark');
        dark.value = true;
    }
})
</script>

<template>
    <div class="flex gap-x-4" :class="{ 'flex-row-reverse': props.reverse }">
        <div class="text-gray-900 dark:text-gray-100 text-sm">
            <p v-if="dark">dark</p>
            <p v-else>light</p>
        </div>
        <ToggleSwitch v-model="dark" @click="toggleTheme"/>
    </div>
</template>
