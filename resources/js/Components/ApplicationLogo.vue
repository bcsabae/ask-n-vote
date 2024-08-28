<script setup>
import { ref } from 'vue';

const logoUrl = ref('images/logo.png');
const altText = ref('AskNVote');
</script>

<template>
    <div class="flex">
        <img
            :src="logoUrl"
            :alt="altText"
            class="w-16 h-auto"
        />
    </div>
</template>
