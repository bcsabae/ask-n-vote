<script setup>
import QuestionItem from './QuestionItem.vue';

const props = defineProps({
    questions: Array,
    upvoted: {
        type: Array,
        default: () => []
    },
    userQuestionList: {
        type: Boolean,
        default: () => false
    }
})

const emit = defineEmits(['upvote', 'downvote', 'delete'])

function handleUpvote(questionId) {
    emit('upvote', questionId);
}

function handleDownvote(questionId) {
    emit('downvote', questionId);
}

function handleDelete(questionId) {
    emit('delete', questionId);
}
</script>

<template>
    <div>
        <transition-group
            name="fade"
            tag="div"
            class="flex flex-col"
            enter-active-class="transition ease-out duration-300"
            leave-active-class="transition ease-in duration-300"
            move-class="transition ease-in-out duration-300"
        >
            <QuestionItem
                v-for="question in props.questions"
                :key="question.id"
                :question="question"
                :upvoted="upvoted.includes(question.id)"
                :user-question="userQuestionList"
                @upvote="handleUpvote"
                @downvote="handleDownvote"
                @delete="handleDelete"
            />
        </transition-group>
    </div>
</template>
