<template>

    <Head>
        <title>Users</title>
    </Head>


    <div class="flex flex-col md:flex-row justify-between mb-5 items-center">
        <div class="items-center">
            <h1 class="text-xl">This is a users page</h1>
            <Link v-if="can.createUser" href="/users/create" class=" text-xs bg-gray-400 hover:bg-gray-500 rounded shadow-md px-0.5">Create new user</Link>
        </div>
        <input v-model="search" type="text" placeholder="Search..." class="rounded-xl bg-gray-300">
    </div>

    <table class="min-w-full border-collapse block md:table">
        <thead class="block md:table-header-group">
        <tr class="border border-grey-500 md:border-none block md:table-row absolute top-full md:top-auto left-full md:left-auto  md:relative ">
            <th class="bg-gray-500 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">ID</th>
            <th class="bg-gray-500 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Name</th>
            <th class="bg-gray-500 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Actions</th>
        </tr>
        </thead>
        <tbody class="block md:table-row-group">

        <tr v-for="user in users.data" :key="user.id" class="bg-gray-300 border border-grey-500 md:border-none block md:table-row">
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Id</span>{{user.id}}</td>
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Name</span>{{user.name}}</td>
            <td class="p-2 md:border md:border-grey-500 text-left md:text-center block md:table-cell">
                <span class="inline-block  w-1/3 md:hidden font-bold">Actions</span>
                <Link v-if="user.can.edit" :href="'/users/'+user.id +'/edit'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded">Edit</Link>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="flex justify-center">
        <Pagination :link="users.links.prev">Prev</Pagination>
        <Pagination :link="users.links.first">1</Pagination>
        <div class="mt-5">
            <span
                v-if="users.meta.current_page != users.meta.last_page && users.meta.current_page != users.meta.from"
                class="border bg-gray-400 rounded hover:bg-gray-500 bg-gray-400 px-1 shadow-lg bg-gray-500 text-xl"
            >
               {{users.meta.current_page}}
            </span>
        </div>
        <Pagination v-if="users.links.last !== users.links.first" :link="users.links.last">{{users.meta.last_page}}</Pagination>
        <Pagination :link="users.links.next">Next</Pagination>
    </div>
    <div>
        <select v-model="pagination_count" @change="UpdatePagination_count" name="pagination_count" id="pagination_count" class="bg-gray-100">
            <option  value="30">30</option>
            <option  value="60">60</option>
            <option value="90">90</option>
        </select>
        <div> {{pagination_count}}</div>
    </div>


</template>

<script>
import Layout from "@/Shared/Layout.vue"
export default {
    layout: Layout,
}
</script>

<script setup>

// import Pagination from "@/Shared/Pagination.vue";
import { Link } from "@inertiajs/inertia-vue3";
import {ref, watch, defineAsyncComponent, computed} from "vue";
import {Inertia} from "@inertiajs/inertia"
// import {throttle} from "lodash/function";
import {debounce} from "lodash/function";


let props = defineProps({
    users: Object,
    filters: Object,
    can: Object,
    pagination_count: String
})

const emit = defineEmits([
    'update:pagination_count'
])

function UpdatePagination_count(e) {
    let value = e.target.value
    console.log('elo elo')
    Inertia.get('/users',  {
        pagination_count : e.target.value,
        search: search.value,
        }, {
        preserveState: true,
        replace: true,
        preserveScroll: true,

    })
    emit('update:pagination_count', value);
}

let Pagination = defineAsyncComponent( () => {
    return import("@/Shared/Pagination.vue");
} )

let search = ref(props.filters.search);

watch(search, debounce( (value) => {
    Inertia.get('/users', {
        search: value,
        pagination_count : pagination_count.value
    }, {
        replace: true,
        preserveState : true,
    });
}, 300));

</script>

<style scoped>

</style>
