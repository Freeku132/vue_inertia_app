<template>
    <div class="mt-5 space-x-2">
        <Link
            v-for="link in links"
            :class="{'shadow-lg text-xl' : 'http://localhost' + $page.url ===  link.url, 'text-gray-500' : !link.url}"
            class="border border-yellow-300 rounded bg-yellow-200 px-1"
            :href="link.url"
            v-html="link.label">

        </Link>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    links : Object
})

</script>

<style scoped>

</style>
