<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    href: String,
    text: String
})
</script>

<template>
    <Link :href="href" class="rounded-full bg-secondary hover:bg-primary hover:shadow transition ease-in-out duration-300 px-4 py-2 text-black font-black tracking-wider uppercase">
        {{ text }}
    </Link>
</template>
