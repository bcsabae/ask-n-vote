<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Button from "primevue/button";
import ToggleButton from "primevue/togglebutton";
import ConfirmDialog from "primevue/confirmdialog";
import {router} from "@inertiajs/vue3";
import {onBeforeUnmount, onMounted, ref, watch} from 'vue';
import {useConfirm} from "primevue/useconfirm";

const props = defineProps([
    'session_code',
    'active_questions',
    'answered_questions',
    'guest_count',
    'banned_guests'
])
const confirm = useConfirm()

let localIsActive = ref(props.session_code.is_active === 1)
let updateInterval = ref()

watch(
    () => props.session_code.is_active,
    (newVal) => {
        console.log("changed to " + newVal)
        localIsActive = (newVal === 1)
    }
)

onMounted(() => {
    updateInterval = setInterval(() => {
        updateData();
    }, 3000);
})

onBeforeUnmount(() => {
    clearInterval(updateInterval);
})

function toggleActive() {
    router.patch(route('sessions.update', props.session_code.id), {
        'is_active': !props.session_code.is_active,
    }, {
        preserveScroll: true
    })
}

function deleteSession() {
    router.delete(route('sessions.destroy', props.session_code.id), {
        preserveScroll:true,
        onSuccess: () => {
            router.visit(route('sessions'));
        }
    })
}

function banUser(userId) {
    console.log("banning " + userId)
    router.patch(route('guest.ban', userId), {
        ban: true
    }, {
        preserveScroll: true
    })
}

function enableUser(userId) {
    router.patch(route('guest.ban', userId), {
        ban: false
    }, {
        preserveScroll: true
    })
}

function answerQuestion(questionId) {
    router.patch(route('questions.update', questionId), {
        'is_answered': true
    }, {
        preserveScroll: true
    })
}

function deleteQuestion(questionId) {
    router.delete(route('questions.destroy', questionId), {
        preserveScroll: true
    })
}

function reopenQuestion(questionId) {
    router.patch(route('questions.update', questionId), {
        'is_answered': false
    }, {
        preserveScroll: true
    })
}

function updateData() {
    router.reload({
        preserveState: true ,
        preserveScroll: true }
    )
}

const showDeleteConfirmation = () => {
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
            deleteSession()
        },
    });
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            Session: {{ session_code.title }}
        </template>

        <div class="flex flex-row gap-x-6 items-center justify-between">
            <p class="font-bold text-xl">
                Code: {{ session_code.session_code }}
            </p>
            <div class="flex flex-row gap-x-4 items-center">
                <div class="text-sm">
                    <ToggleButton
                        v-model="localIsActive" onLabel="Active" offLabel="Inactive" @change="toggleActive" />
                </div>
                <Button icon="pi pi-times" severity="secondary" text rounded aria-label="Delete" @click="showDeleteConfirmation"/>
            </div>
        </div>
        <p class="font-bold text-xl">
            Guests in session: {{ guest_count }}
        </p>

        <div class="mt-12">
            <div class="w-full border-b-gray-800 border-b py-4 mb-8 text-2xl">
                <h3>Active questions</h3>
            </div>
            <table class="table-auto w-full text-left">
                <thead class="uppercase">
                <tr>
                    <th class="px-6 py-4">Upvotes</th>
                    <th class="px-6 py-4">Text</th>
                    <th class="px-6 py-4">Asked by</th>
                    <th class="px-6 py-4">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="question in active_questions" :key="question.id" class="dark:hover:bg-gray-700 hover:bg-gray-100">
                    <td class="px-6 py-2">{{ question.upvotes }}</td>
                    <td class="px-6 py-2">{{ question.question_text }}</td>
                    <td class="px-6 py-2">
                        {{ question.guest.name }}
                        <Button icon="pi pi-ban" v-tooltip.top="'ban user'" severity="secondary" text aria-label="Ban user" @click="banUser(question.guest.id)"/>
                    </td>
                    <td class="px-6 py-2">
                        <Button icon="pi pi-check" v-tooltip.top="'answer'" severity="secondary" text aria-label="Answer question" @click="answerQuestion(question.id)"/>
                        <Button icon="pi pi-times" v-tooltip.top="'delete'" severity="secondary" text aria-label="Delete question" @click="deleteQuestion(question.id)"/>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-12">
            <div class="w-full border-b-gray-800 border-b py-4 mb-8 text-2xl">
                <h3>Answered questions</h3>
            </div>

            <table class="table-auto w-full text-left text-gray-500">
                <thead class="uppercase">
                <tr>
                    <th class="px-6 py-4">Upvotes</th>
                    <th class="px-6 py-4">Text</th>
                    <th class="px-6 py-4">Asked by</th>
                    <th class="px-6 py-4">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="question in answered_questions" :key="question.id" class="dark:hover:bg-gray-700 hover:bg-gray-100">
                    <td class="px-6 py-2">{{ question.upvotes }}</td>
                    <td class="px-6 py-2">{{ question.question_text }}</td>
                    <td class="px-6 py-2">
                        {{ question.guest.name }}
                        <Button icon="pi pi-ban" v-tooltip.top="'ban user'" severity="secondary" text aria-label="Ban user" @click="banUser(question.guest.id)"/>
                    </td>
                    <td class="px-6 py-2">
                        <Button icon="pi pi-undo" v-tooltip.top="'reopen'" severity="secondary" text aria-label="Reopen question" @click="reopenQuestion(question.id)"/>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-12">
            <div class="w-full border-b-gray-800 border-b py-4 mb-8 text-2xl">
                <h3>Banned guests</h3>
            </div>

            <table class="table-auto w-full text-left text-gray-500">
                <thead class="uppercase">
                <tr>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="guest in banned_guests" :key="guest.id" class="dark:hover:bg-gray-700 hover:bg-gray-100">
                    <td class="px-6 py-2">{{ guest.name }}</td>
                    <td class="px-6 py-2">
                        <Button icon="pi pi-undo" v-tooltip.top="'enable'" severity="secondary" text aria-label="Enable guest" @click="enableGuest(guest.id)"/>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <ConfirmDialog group="templating">
            <template #message="slotProps">
                <div class="flex flex-row items-center text-gray-200">
                    <i :class="slotProps.message.icon" class="py-2 px-4"></i>
                    <p>{{ slotProps.message.message }}</p>
                </div>
            </template>
        </ConfirmDialog>
    </AppLayout>

</template>
