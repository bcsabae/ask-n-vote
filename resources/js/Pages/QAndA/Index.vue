<template>
    <div class="bg-gray-800 py-12">
        <div class="w-3/5 flex flex-col mx-auto">
            <div class="py-12">
                <div class="mb-12">
                    <h1 class="text-5xl font-extrabold">{{ name }}, welcome!</h1>
                </div>
                <SubmitQuestion @submit-question="createQuestion" :active="active"/>
            </div>
            <div class="py-6">
                <div class="mb-4">
                    <h2 class="text-2xl font-extrabold">Your questions</h2>
                </div>
                <QuestionList
                    v-if="userQuestions.length"
                    :questions="userQuestions"
                    :user-question-list="true"
                    @delete="deleteQuestion"
                />
                <p v-else class="italic text-gray-500">
                    Your questions will appear here.
                </p>
            </div>

            <div class="py-6">
                <div class="mb-4">
                    <h2 class="text-2xl font-extrabold">Other's questions</h2>
                </div>
                <QuestionList
                    :questions="unansweredQuestions"
                    :upvoted="upvoted"
                    @upvote="upvoteQuestion"
                    @downvote="downvoteQuestion"
                />
            </div>

            <div class="py-6">
                <div class="mb-4">
                    <h2 class="text-2xl font-extrabold">Answered questions</h2>
                </div>
                <QuestionList
                    :questions="answeredQuestions"
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
        unansweredQuestions: Array,
        answeredQuestions: Array,
        userQuestions: Array,
        upvoted: Array,
        name: String,
        active: Boolean,
    },
    methods: {
        createQuestion(questionText) {
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
        },
        deleteQuestion(questionId) {
            this.$inertia.delete(route('questions.destroy', questionId), {
                preserveScroll: true
            });
        },
        updateData() {
            this.$inertia.reload({
                preserveState: true ,
                preserveScroll: true,
            })
        },
    },
    created() {
        this.interval = setInterval(function () {
            this.updateData();
        }.bind(this), 3000);
    },
    beforeDestroy() {
        clearInterval(this.interval);
    }
};
</script>
