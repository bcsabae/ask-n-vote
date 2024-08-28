<script setup>
import { ref, watch } from 'vue';
import ToggleButton from 'primevue/togglebutton';
import Button from "primevue/button";

const props = defineProps(['id', 'code', 'isActive', 'title'])
const emit = defineEmits(['update:isActive', 'deleteSession', 'update:title']);

const localIsActive = ref(props.isActive);
const titleToEdit = ref(props.title);

watch(() => props.isActive, (newVal) => {
    localIsActive.value = newVal;
});

function toggle() {
    localIsActive.value = !localIsActive.value;
    emit('update:isActive', {
        id: props.id,
        is_active: !props.isActive
    });
}

function deleteSession() {
    emit('deleteSession', props.id)
}

function emitUpdateTitle() {
    if (props.title !== titleToEdit.value) {
        console.log("original: " + props.title + " modified: " + titleToEdit.value)
        emit('update:title', {
            id: props.id,
            title: titleToEdit.value,
        })
    }
}

</script>

<template>
    <div class="border-gray-200 rounded-xl px-2 py-4 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 my-2">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="md:px-4 flex flex-row items-center justify-between w-full md:w-fit">
                <div class="px-4">
                    <input
                        class="text-xl font-bold bg-inherit dark:hover:border-gray-800 hover:border-gray-300 rounded dark:border-gray-800 border-gray-100 focus:ring-0 focus-visible:ring-0"
                        type="text"
                        v-model="titleToEdit"
                        @blur="emitUpdateTitle"
                    >
                </div>
                <div class="px-2 text-sm flex flex-row items-center dark:text-gray-400 dark:hover:text-gray-200 text-gray-600 hover:text-black">
                    <span class="pi pi-sliders-h px-2"></span>
                    <a :href="route('sessions.dashboard', id)">Show dashboard</a>
                </div>
            </div>

            <div class="flex flex-row gap-x-6 items-center md:w-fit w-full ps-4 md:ps-0 mt-4 md:mt-0">
                <div class="font-bold">{{ code }}</div>
                <div class="flex justify-end w-full">
                    <div class="text-sm">
                        <ToggleButton
                            v-model="localIsActive" onLabel="Active" offLabel="Inactive" @change="toggle" />
                    </div>
                    <Button icon="pi pi-times" severity="secondary" text rounded aria-label="Delete" @click="deleteSession"/>
                </div>
            </div>
        </div>
    </div>
</template>
