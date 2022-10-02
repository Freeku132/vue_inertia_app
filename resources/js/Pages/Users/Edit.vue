<template>
    <Head title="Edit User"/>

    <h1>
        Edit user
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
        <button type="submit" class="bg-yellow-400 px-1 rounded hover:bg-yellow-500 mt-4 disabled:opacity-25 " :disabled="form.processing"> Edit! </button>
    </form>

</template>

<script>
import Layout from "@/Shared/Layout.vue"

export default {
    layout : Layout,
}
</script>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";


let props = defineProps({
    errors: Object,
    user: Object
})

let form = useForm({
    id: props.user.id,
    name: props.user.name,
    email: props.user.email,
    password: '',
})

let submit = () =>{

    form.post('/users/' + props.user.id + '/update');
}

</script>

<style scoped>

</style>
