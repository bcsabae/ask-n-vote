<script setup>
import SubmitQuestion from '../../Components/SubmitQuestion.vue';
import QuestionList from '../../Components/QuestionList.vue';
import {onBeforeUnmount, onMounted} from "vue";
import { router } from '@inertiajs/vue3'

const props = defineProps({
    unansweredQuestions: Array,
    answeredQuestions: Array,
    userQuestions: Array,
    upvoted: Array,
    name: String,
    active: Boolean,
})

let interval = null

function createQuestion(questionText) {
    router.post(route('questions.store'), {
        'question_text': questionText,
    })
}

function upvoteQuestion(questionId) {
    router.post(route('questions.upvote', questionId), {},{
        preserveScroll: true
    });
}

function downvoteQuestion(questionId) {
    router.put(route('questions.downvote', questionId), {},{
        preserveScroll: true
    });
}

function deleteQuestion(questionId) {
    router.delete(route('questions.destroy', questionId), {
        preserveScroll: true
    });
}

function updateData() {
    router.reload({
        preserveState: true ,
        preserveScroll: true,
    })
}

onMounted(() => {
    interval = setInterval(function () {
        updateData();
    }, 3000);
})

onBeforeUnmount(() => {
    clearInterval(interval);
})
</script>

<template>
    <div class="bg-gray-800 sm:py-12">
        <div class="lg:w-3/5 md:w-4/5 px-4 sm:px-8 md:px-0 flex flex-col mx-auto">
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
