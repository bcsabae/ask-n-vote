<script setup>
import {useForm} from '@inertiajs/vue3';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import FloatLabel from 'primevue/floatlabel';

const form = useForm({
    name: '',
    session_code: '',
});

function submit() {
    form.post('/start');
}
</script>

<template>
    <div class="flex items-center justify-center min-h-screen">
        <div class="mx-auto lg:w-1/4 px-12">
            <h2 class="mb-12 font-black text-3xl text-center">Enter Q&A Session</h2>
            <form @submit.prevent="submit">
                <div class="mb-8">
                    <FloatLabel>
                        <InputText id="name" v-model="form.name" class="w-full"/>
                        <label for="username">Name</label>
                    </FloatLabel>
                </div>
                <div class="mb-8">
                    <FloatLabel>
                        <InputText id="session_code" v-model="form.session_code" class="w-full" />
                        <label for="username">Session code</label>
                    </FloatLabel>
                    <div class="text-sm px-2 pt-2">
                        <span v-if="form.errors.session_code" class="text-red-500">{{ form.errors.session_code }}</span>
                    </div>
                </div>
                <div class="flex justify-center">
                    <Button class="px-48" label="Let's go!" type="submit" :disabled="form.processing"/>
                </div>

            </form>
        </div>
    </div>
</template>
