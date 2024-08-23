<template>
    <div class="py-4">
        <Card>
            <template #content>
                <div class="flex justify-between">
                    <div class="flex items-center justify-center">
                        <div class="my-auto">
                            <p class="text-gray-500 italic mb-2 text-sm">{{ question.asked_by }}</p>
                            <h3 class="font-black text-2xl">{{ question.question_text }}</h3>
                        </div>
                    </div>
                    <div class="gap-4 mt-1 flex justify-end">
                        <div class="flex flex-col text-center">
                            <Button
                                icon="pi pi-star"
                                severity="contrast"
                                rounded
                                :outlined="!upvoted"
                                aria-label="Upvote"
                                @click="upvote"
                                :disabled="userQuestion"/>
                            <p class="pt-2 text-center">
                                {{ question.upvotes }}
                            </p>
                        </div>
                    </div>
                </div>
            </template>
        </Card>
    </div>
</template>

<script>
import Card from 'primevue/card';
import Button from 'primevue/button';

export default {
    props: {
        question: Object,
        upvoted: Boolean,
        userQuestion: {
            type: Boolean,
            default: () => false
        }
    },
    components: {
        Card,
        Button,
    },
    methods: {
        upvote() {
            if(this.upvoted) this.$emit('downvote', this.question.id);
            else this.$emit('upvote', this.question.id);
        }
    }
};
</script>
