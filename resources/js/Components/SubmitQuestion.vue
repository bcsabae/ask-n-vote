<template>
    <div>
        <InputText v-model="newQuestion" placeholder="Ask a question" />
        <Button label="Submit" @click="submit" />
    </div>
</template>

<script>
export default {
    data() {
        return {
            newQuestion: ''
        };
    },
    methods: {
        submit() {
            this.$emit('submit-question', this.newQuestion);
            this.newQuestion = '';
        }
    }
};
</script>
