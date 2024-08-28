<script setup>
import { ref } from 'vue';

const logoUrl = ref('images/logo.png');
const altText = ref('AskNVote');
</script>

<template>
    <img
        :src="logoUrl"
        :alt="altText"
        class="w-6 h-auto"
    />
</template>
