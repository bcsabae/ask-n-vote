<template>
    <div>
        <QuestionList
            :questions="questions"
            :upvoted="upvoted"
            @upvote="upvoteQuestion"
            @downvote="downvoteQuestion"
        />
    </div>
</template>

<script>
import SubmitQuestion from '../../Components/SubmitQuestion.vue';
import QuestionList from '../../Components/QuestionList.vue';

export default {
    components: { SubmitQuestion, QuestionList },
    props: {
        questions: Array,
        upvoted: Array,
    },
    methods: {
        createQuestion(questionText) {
            // Send new question to API and update this.questions
        },
        upvoteQuestion(questionId) {
            this.$inertia.post(route('questions.upvote', questionId), {},{
                preserveScroll: true
            });
        },
        downvoteQuestion(questionId) {
            this.$inertia.put(route('questions.downvote', questionId), {},{
                preserveScroll: true
            });
        }
    }
};
</script>
