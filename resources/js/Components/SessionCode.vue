<template>
    <div class="border-gray-200 rounded-xl px-2 py-4 bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 my-2">
        <div class="flex flex-row justify-between">
            <h3 class="text-xl font-bold">{{ code }}</h3>
            <div class="text-sm">
                <ToggleButton
                    v-model="localIsActive" onLabel="Active" offLabel="Inactive" @change="toggle" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import ToggleButton from 'primevue/togglebutton';

const props = defineProps(['id', 'code', 'isActive'])
const emit = defineEmits(['update:isActive']);

const localIsActive = ref(props.isActive);

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

</script>
