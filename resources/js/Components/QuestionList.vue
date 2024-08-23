<template>
    <div class="bg-gray-800">
        <h2>Hello world</h2>
        <div class="w-3/5 flex flex-col mx-auto">
            <transition-group
                name="fade"
                tag="div"
                class="flex flex-col"
                enter-active-class="transition ease-out duration-300"
                leave-active-class="transition ease-in duration-300"
                move-class="transition ease-in-out duration-300"
            >
                <QuestionItem
                    v-for="question in questions"
                    :key="question.id"
                    :question="question"
                    :upvoted="upvoted.includes(question.id)"
                    @upvote="handleUpvote"
                    @downvote="handleDownvote"
                />
            </transition-group>

        </div>
    </div>
</template>

<script>
import QuestionItem from './QuestionItem.vue';

export default {
    components: {
        QuestionItem,
    },
    props: ['questions', 'upvoted'],
    methods: {
        handleUpvote(questionId) {
            console.log("Upvote captured for " + questionId)
            this.$emit('upvote', questionId);
        },
        handleDownvote(questionId) {
            console.log("Downvote captured for " + questionId)
            this.$emit('downvote', questionId);
        }
    }
};
</script>
