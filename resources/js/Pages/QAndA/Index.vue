<template>
    <div class="bg-gray-800 py-24">
        <div class="w-3/5 flex flex-col mx-auto">
            <SubmitQuestion @submit-question="createQuestion"/>
            <QuestionList
                :questions="questions"
                :upvoted="upvoted"
                @upvote="upvoteQuestion"
                @downvote="downvoteQuestion"
            />
        </div>
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
            console.log('need to crete question ' + questionText)
            this.$inertia.post(route('questions.store'), {
                'question_text': questionText,
            })
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
