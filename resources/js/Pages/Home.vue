<template>
    <Head>
        <title>Home</title>
        <meta type="description" content="Information about home page" head-key="description">
    </Head>

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


defineProps({
    frameworks: Array,
    time : String,
    layout: Layout
})


</script>

<style scoped>

</style>
