<template>
    <AppLayout title="Sessions">
        <template #header>
            Sessions
        </template>

        <div class="flex flex-row justify-end mb-8">
            <Button type="button" label="Create new session" icon="pi pi-plus" severity="secondary" @click="newSession" />
        </div>

        <p v-for="session_code in session_codes" :key="session_code.id">
            <SessionCode :code="session_code.session_code"
                         :is-active="!!session_code.is_active"
                         :id="session_code.id"
                         @update:isActive="handleIsActiveUpdate"
            />
        </p>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SessionCode from "@/Components/SessionCode.vue";
import {router} from "@inertiajs/vue3";
import Button from 'primevue/button';


const props = defineProps(['session_codes'])

function handleIsActiveUpdate(data) {
    router.patch(route('sessions.update', data.id), {
        'is_active': data.is_active,
    }, {
        preserveScroll: true
    })
}

function newSession() {
    router.post(route('sessions.new'), {}, { preserveScroll: true })
}

</script>
