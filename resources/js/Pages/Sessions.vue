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
                         :title="session_code.title"
                         @update:isActive="handleIsActiveUpdate"
                         @delete-session="showDeleteConfirmation"
                         @update:title="handleTitleUpdate"
            />
        </p>
        <ConfirmDialog group="templating">
            <template #message="slotProps">
                <div class="flex flex-row items-center text-gray-800 dark:text-gray-200">
                    <i :class="slotProps.message.icon" class="py-2 px-4"></i>
                    <p>{{ slotProps.message.message }}</p>
                </div>
            </template>
        </ConfirmDialog>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SessionCode from "@/Components/SessionCode.vue";
import {router} from "@inertiajs/vue3";
import Button from 'primevue/button';
import ConfirmDialog from "primevue/confirmdialog";

import { useConfirm } from "primevue/useconfirm";

const confirm = useConfirm();

const props = defineProps(['session_codes'])

function handleIsActiveUpdate(data) {
    router.patch(route('sessions.update', data.id), {
        'is_active': data.is_active,
    }, {
        preserveScroll: true
    })
}

function handleTitleUpdate(data) {
    router.patch(route('sessions.update', data.id), {
        'title': data.title
    }, {
        preserveScroll: true
    })
}

function newSession() {
    router.post(route('sessions.new'), {}, { preserveScroll: true })
}

function deleteSession(sessionId) {
    router.delete(route('sessions.destroy', sessionId), { preserveScroll:true })
}

const showDeleteConfirmation = (sessionId) => {
    confirm.require({
        group: 'templating',
        header: 'Are you sure?',
        message: 'You are going to delete this session. This cannot be undone.',
        icon: 'pi pi-exclamation-circle',
        rejectProps: {
            label: 'Cancel',
            outlined: true,
            size: 'small',
            severity: 'secondary',
        },
        acceptProps: {
            label: 'Delete',
            icon: 'pi pi-times',
            size: 'small',
            severity: 'danger',
        },
        accept: () => {
            deleteSession(sessionId)
        },
    });
};

</script>
