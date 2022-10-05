<template>
    <div class="mt-5 space-x-2">
        <Link
            :class="{'shadow-lg bg-gray-500 text-xl' : 'http://localhost' + $page.url ===  link,
             'text-gray-500' : !link,
              }"
            class="border bg-gray-400 rounded hover:bg-gray-500 bg-gray-400 px-1 m-1"
            :href="link"
            >
            <slot/>
        </Link>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    link : String,
})

</script>

<style scoped>

</style>
