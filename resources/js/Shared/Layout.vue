<template>
    <Head>
        <title>My App</title>
        <meta type="description" content="Information about my app" head-key="description">
    </Head>
    <div class="bg-blend-color-burn bg-gray-100">
        <header class="bg-neutral-400 shadow-2xl rounded-b-2xl flex items-center justify-between px-8 py-2 mb-10">
            <h1 class="text-4xl font-bold">
                My First Modern App
                <p class="text-sm">Welcome back, {{$page.props.auth.user.username}}</p>
            </h1>
            <Nav />
        </header>
            <div class="text-black font-bold max-w-4xl p-6 mx-auto shadow-2xl">
                <slot />
            </div>
    </div>
</template>

<script setup>
import Nav from "@/Shared/Nav.vue";
import { Head } from "@inertiajs/inertia-vue3";


defineProps({
    auth: Object,
})





</script>

<style scoped>

</style>
