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

<script>
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Card from 'primevue/card';

export default {
    props: {
        active: Boolean
    },
    data() {
        return {
            newQuestion: ''
        };
    },
    components: {
        InputText,
        Button,
        Card,
    },
    methods: {
        submit() {
            if (this.newQuestion.length !== 0)
            {
                this.$emit('submit-question', this.newQuestion);
                this.newQuestion = '';
            }
        }
    }
};
</script>
