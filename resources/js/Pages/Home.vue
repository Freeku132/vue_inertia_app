<template>
    <Head>
        <title>Home</title>
        <meta type="description" content="Information about home page" head-key="description">
    </Head>


    <div>
        <pre>
            <code>
            class Test
            {
            public function __construct()
            {
            //
            }
            }
            </code>
        </pre>
    </div>

    <div class="code">
        <pre>
            <code ref="code">
            class Test
            {
                public function __construct()
                {
                     //
                }
            }
            </code>
        </pre>
    </div>

    <div>
        <Highlight :code="snippet"/>
    </div>


        <h1> Hi everyone</h1>
        <p> In this series, we will use the following frameworks</p>
        <ul>
            <li v-for="framework in frameworks" v-text="framework"></li>
        </ul>

        <div class="mt-96">
            <p>The current time is {{ time }}</p>
        </div>
        <div class="mt-96">
            <p>The current time is {{ time }}</p>
        </div>
        <div class="mt-96">
            <p>The current time is {{ time }}</p>
        </div>

        <Link
            href="/"
            class="bg-gray-100 text-blue-400"
            preserve-scroll
        >Refresh</Link>



</template>

<script>
import Layout from "@/Shared/Layout.vue"

export default {
    layout : Layout,
}
</script>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import {highlight, highlightElement} from "@/Services/SyntaxHighlighting";
import {onMounted} from "vue";
import {ref} from "vue";
import Highlight from "@/Components/Highlight.vue";

const code = ref('')


onMounted(() =>
    //highlight(),
    highlightElement(code.value),
);

let snippet = `
  class Test
            {
                public function __construct()
                {
                     //
                }
            }
`.trim();

defineProps({
    frameworks: Array,
    time : String,
    layout: Layout
})


</script>

<style scoped>
div.code {
    white-space: pre;
}
</style>
