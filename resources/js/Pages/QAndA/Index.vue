<template>
    <div class="bg-gray-800 py-12">
        <div class="w-3/5 flex flex-col mx-auto">
            <div class="py-12">
                <div class="mb-12">
                    <h1 class="text-5xl font-extrabold">{{ name }}, welcome!</h1>
                </div>
                <SubmitQuestion @submit-question="createQuestion"/>
            </div>
            <div class="py-6">
                <div class="mb-4">
                    <h2 class="text-2xl font-extrabold">Your questions</h2>
                </div>
                <QuestionList
                    :questions="userQuestions"
                    :user-question-list="true"
                />
            </div>

            <div class="py-6">
                <div class="mb-4">
                    <h2 class="text-2xl font-extrabold">Other's questions</h2>
                </div>
                <QuestionList
                    :questions="questions"
                    :upvoted="upvoted"
                    @upvote="upvoteQuestion"
                    @downvote="downvoteQuestion"
                />
            </div>
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
        userQuestions: Array,
        upvoted: Array,
        name: String,
    },
    methods: {
        createQuestion(questionText) {
            console.log('need to crete question ' + questionText)
            this.$inertia.post(route('questions.store'), {
                'question_text': questionText,
                'asked_by': this.name,
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
