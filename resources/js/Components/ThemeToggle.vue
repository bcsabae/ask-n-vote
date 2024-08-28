<template>
    <div class="flex gap-x-4 px-4" :class="{ 'flex-row-reverse': reverse }">
        <div class="text-gray-900 dark:text-gray-100 text-sm">
            <p v-if="dark">dark</p>
            <p v-else>light</p>
        </div>
        <ToggleSwitch v-model="dark" @click="toggleTheme"/>
    </div>
</template>

<script>
import ToggleSwitch from 'primevue/toggleswitch';

export default {
    data() {
        return {
            dark: false
        }
    },
    props: {
        reverse: Boolean
    },
    components: {
        ToggleSwitch,
    },
    methods: {
        toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        },
    },
    mounted() {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.documentElement.classList.add('dark');
            this.dark = true;
        }
    },
};
</script>
