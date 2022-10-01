<template>
        <Link
              :class="{'text-blue-900 no-underline' : active}"
              class="underline hover:text-blue-900"
        ><slot/>
        </Link>
</template>

<script setup>

import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    active: Boolean,
})

</script>

<style scoped>

</style>
