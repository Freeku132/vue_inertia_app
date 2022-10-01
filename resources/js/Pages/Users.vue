<template>

    <Head>
        <title>Users</title>
    </Head>


    <div class="flex flex-col md:flex-row justify-between mb-5 items-center">
        <h1 class="text-xl">This is a users page</h1>
        <input v-model="search" type="text" placeholder="Search..." class="rounded-xl bg-blue-200">
    </div>

    <table class="min-w-full border-collapse block md:table">
        <thead class="block md:table-header-group">
        <tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
            <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">ID</th>
            <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Name</th>
            <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Actions</th>
        </tr>
        </thead>
        <tbody class="block md:table-row-group">

        <tr v-for="user in users.data" :key="user.id" class="bg-gray-300 border border-grey-500 md:border-none block md:table-row">
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Id</span>{{user.id}}</td>
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Name</span>{{user.name}}</td>
            <td class="p-2 md:border md:border-grey-500 text-center block md:table-cell">
                <span class="inline-block w-1/3 md:hidden font-bold">Actions</span>
                <Link href="/users/${user.id}/edit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded">Edit</Link>
            </td>
        </tr>
        </tbody>
    </table>


    <Pagination :links="users.links"/>


</template>

<script>

import Layout from "@/Shared/Layout.vue"


export default {
    layout : Layout,
}

</script>

<script setup>

import Pagination from "@/Shared/Pagination.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { ref, watch } from "vue";
import {Inertia} from "@inertiajs/inertia"


let props = defineProps({
    users: Object,
    filters: Object,
})

let search = ref(props.filters.search);

watch(search, value => {
    Inertia.get('/users', {search: value}, {
        preserveState : true,
        replace: true
    });
})

</script>

<style scoped>

</style>
