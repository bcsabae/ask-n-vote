<template>
    <div>
        <Card>
            <template #content>
                <div class="flex justify-between">
                    <div class="my-auto w-full pe-8">
                        <InputText
                            v-model="newQuestion"
                            :placeholder="active ? 'Ask a question' : 'This session does not accept questions at the moment'"
                            class="w-full"
                            :disabled="!active"
                        />
                    </div>
                    <div class="">
                        <Button label="Ask" @click="submit" severity="secondary" :disabled="!(newQuestion.length)"/>
                    </div>
                </div>
            </template>
        </Card>
    </div>
</template>

<script setup>
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Card from 'primevue/card';
import {ref} from "vue";

const props = defineProps({
    active: Boolean
})

const emit = defineEmits(['submit-question'])

const newQuestion = ref('')

function submit() {
    if (newQuestion.value.length !== 0)
    {
        emit('submit-question', newQuestion.value);
        newQuestion.value = '';
    }
}
</script>
