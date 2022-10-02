<template>

    <Head title="Create User"/>

    <h1>
        Hello World
    </h1>

    <form @submit.prevent="submit" class="max-w-md mx-auto">
        <label class="block ml-2 mb-0.5 uppercase font-bold text-xs text-gray-700 mt-4"
               for="name">
            Name
        </label>
        <input v-model="form.name" class="border border-gray-400 p-2 w-full  rounded-xl"
               type="text"
               name="name"
               id="name"


        />
        <div class="text-red-900 text-xs" v-if="errors.name" v-text="errors.name"></div>
        <label class="block ml-2 mb-0.5 uppercase font-bold text-xs text-gray-700 mt-4"
               for="email">
            Email
        </label>
        <input v-model="form.email" class="border border-gray-400 p-2 w-full  rounded-xl"
               type="email"
               name="email"
               id="email"

        />
        <div class="text-red-900 text-xs" v-if="$page.props.errors.email" v-text="$page.props.errors.email"></div>
        <label class="block ml-2 mb-0.5 uppercase font-bold text-xs text-gray-700 mt-4"
               for="password">
            Password
        </label>
        <input v-model="form.password" class="border border-gray-400 p-2 w-full  rounded-xl"
               type="password"
               name="password"
               id="password"


        />
        <div class="text-red-900 text-xs" v-if="form.errors.password" v-text="form.errors.password"></div>
        <button type="submit" class="bg-yellow-400 px-1 rounded hover:bg-yellow-500 mt-4 disabled:opacity-25 " :disabled="form.processing"> Create! </button>
    </form>

</template>

<script>
import Layout from "@/Shared/Layout.vue"

export default {
    layout : Layout,
}
</script>

<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";

defineProps({
    errors: Object
})

let form = useForm ({
    name:'',
    email:'',
    password:'',
});


let submit = () =>{

    form.post('/users');
}

</script>

<style scoped>

</style>
