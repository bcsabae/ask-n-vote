<script setup>
import Card from 'primevue/card';
import Button from 'primevue/button';

const props = defineProps({
    question: Object,
    upvoted: Boolean,
    userQuestion: {
        type: Boolean,
        default: () => false
    }
})

const emit = defineEmits(['upvote', 'delete'])

function upvote() {
    if(props.upvoted) emit('downvote', props.question.id);
    else emit('upvote', props.question.id);
}

function deleteUserQuestion() {
    emit('delete', props.question.id);
}
</script>

<template>
    <div class="py-4">
        <Card>
            <template #content>
                <div class="flex justify-between">
                    <div class="flex items-center justify-center">
                        <div class="my-auto">
                            <p v-if="!userQuestion" class="text-gray-500 italic mb-2 text-sm">asked by {{ question.guest.name }}</p>
                            <p v-else-if="!question.is_answered"
                               @click="deleteUserQuestion"
                               class="text-gray-500 italic mb-2 text-sm hover:underline hover:cursor-pointer">
                                Revoke this question
                            </p>
                            <h3 class="font-black text-2xl">
                                {{ question.question_text + (question.is_answered ? " (answered)" : "")}}
                            </h3>
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
                                :disabled="userQuestion || question.is_answered"/>
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
