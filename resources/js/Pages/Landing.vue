<script setup>
import LandingLayout from "@/Layouts/LandingLayout.vue";
import {onMounted, ref} from "vue";
import CTA from "@/Components/CTA.vue";
import FeatureCard from "@/Components/FeatureCard.vue";

const words = [
    "Ask.",
    "Vote.",
    "as simple as that",
    "AskNVote"
]

const text = ref("")
let wordIndex = 0;
let index = 0;
const speed = 50;
const delay = 1000;

function type() {
    let word = words[wordIndex];
    if (index === 0) text.value = "";
    if (index <= word.length) {
        text.value += word.charAt(index);
        index++;
        setTimeout(type, speed);
    }
    else if (wordIndex < words.length){
        index = 0;
        wordIndex += 1;
        if (wordIndex !== words.length) {
            setTimeout(type, speed + delay);
        }
    }
}

onMounted(() => {
    type()
})
</script>

<template>
    <LandingLayout title="AskNVote" has-waves>
        <h1 class="relative font-black text-gray-700 text-9xl py-36 z-10">{{ text }}</h1>

        <div class="text-center text-6xl font-bold px-64 py-24">
            <h2>Introducing the simplest Q&A pool available.</h2>
            <div class="text-2xl py-12">
                <p>Let your audience ask questions in a Q&A style. One-click project setup, super easy UI, no hidden switches.</p>
                <p class="mt-12 text-3xl italic">AskNVote does one thing, but does that perfectly.</p>
            </div>
        </div>


        <!-- Mi ez - web screenshottal -->
        <div class="flex flex-row" id="product">
            <div class="h-full my-auto mx-auto w-full">
                <h3 class="py-24 text-4xl font-black text-center">The simplest Q&A system</h3>
                <div class="mx-auto flex flex-row w-4/6 justify-between">
                    <div class="hover:border-t border-gray-400 dark:border-gray-100 text-2xl w-1/2">
                        <h4 class="text-4xl py-6">Your audience</h4>
                        <p class="py-1">asks questions</p>
                        <p class="py-1">upvote questions</p>
                    </div>
                    <div class="hover:border-t border-gray-400 dark:border-gray-100 text-2xl w-1/2">
                        <h4 class="text-4xl py-6">You</h4>
                        <p class="py-1">mark questions as answered</p>
                        <p class="py-1">moderate questions</p>
                    </div>
                </div>
                <p class="py-24 text-5xl font-black text-center italic">That's basically it!</p>
            </div>
            <div class="relative ms-auto border-gray-900 dark:border-gray-700 bg-gray-900 border-[14px] rounded-[2.5rem] h-[600px] w-[300px]">
                <div class="h-[32px] w-[3px] bg-gray-900 dark:bg-gray-700 absolute -start-[17px] top-[72px] rounded-s-lg"></div>
                <div class="h-[46px] w-[3px] bg-gray-900 dark:bg-gray-700 absolute -start-[17px] top-[124px] rounded-s-lg"></div>
                <div class="h-[46px] w-[3px] bg-gray-900 dark:bg-gray-700 absolute -start-[17px] top-[178px] rounded-s-lg"></div>
                <div class="h-[64px] w-[3px] bg-gray-900 dark:bg-gray-700 absolute -end-[17px] top-[142px] rounded-e-lg"></div>
                <div class="rounded-[2rem] overflow-hidden w-[272px] h-[572px] bg-white dark:bg-gray-900">
                    <img src="/images/guest_view.png" class="w-[272px] h-[572px]" alt="App guest view">
                </div>
            </div>
        </div>
        <div class="flex justify-center w-full py-24">
            <CTA :href="route('register')" text="join the platform - it's free!"/>
        </div>



        <!-- How to use -->
        <div class="my-24">
            <h3 class="text-6xl font-black mb-52">How to use</h3>
            <div class="flex flex-col-reverse lg:flex-row items-center gap-x-32">
                <div class="text-4xl w-5/6 text-center lg:text-start">
                    <p class="my-12">Create a session with one click</p>
                    <p class="my-12">Share your session with your audience.</p>
                </div>
                <div class="w-2/3">
                    <div class="border-gray-900 dark:border-gray-400 bg-white border-4 p-1 rounded-2xl">
                        <img src="/images/sessions.png" class="object-fit" alt="App guest view">
                    </div>
                </div>
            </div>
            <div class="flex flex-col-reverse lg:flex-row items-center gap-x-32">
                <div class="w-2/3">
                    <div class="border-gray-900 dark:border-gray-400 bg-white border-4 p-1 rounded-2xl">
                        <img src="/images/dashboard.png" class="object-fit" alt="App guest view">
                    </div>
                </div>
                <div class="text-4xl w-5/6 text-center lg:text-start">
                    <p class="my-12">Attendees can ask and upvote questions</p>
                    <p class="my-12">You can moderate or mark questions as answered in real-time</p>
                </div>
            </div>
        </div>
        <!-- Features -->
        <div class="" id="features">
            <h3 class="text-4xl italic text-center font-bold mb-12">Simplest solution to a simple problem</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-x-12 gap-y-24 items-center py-8 px-24">
                <FeatureCard text="Join sessions with code" icon="pi-share-alt" />
                <FeatureCard text="One-click session creation" icon="pi-file-plus" />
                <FeatureCard text="One-click join for attendees" icon="pi-user" />
                <FeatureCard text="Upvote questions" icon="pi-sort-amount-up" />
                <FeatureCard text="Ask questions before or during the session" icon="pi-clock" />
                <FeatureCard text="Easy and safe moderation" icon="pi-ban" />
            </div>
        </div>
        <!-- Pricing -->
        <div class="mb-64" id="pricing">
            <p class="text-4xl font-bold py-24 text-center italic">While in the initial phase, we invite you to try AskNVote for free!</p>
            <div class="mx-auto py-6 bg-gray-50 dark:bg-gray-800 w-64 flex flex-col items-center justify-center gap-y-4 hover:shadow-xl shadow-md rounded-2xl">
                <p class="text-4xl font-black py-4">Free</p>
                <div class="text-gray-600 dark:text-gray-300 text-sm flex flex-col gap-y-2 text-center italic">
                    <p>Single user</p>
                    <p>10 sessions</p>
                    <p>250 attendees / session</p>
                    <p>No credit card required</p>
                </div>
                <div class="py-4 mt-4">
                    <CTA :href="route('register')" text="Join now!"></CTA>
                </div>
            </div>
        </div>
    </LandingLayout>
</template>
