<template>
    <nav>
        <ul class="flex flex-col md:flex-row md:space-x-5 font-bold text-blue-600 ">
            <li>
                <Link href="/"
                      :class="{'text-blue-900 no-underline' : $page.component === 'Home'}"
                      class="underline hover:text-blue-900"
            >Home
                </Link>
            </li>
            <li>
                <Link href="/users"
                      :class="{'text-blue-900 no-underline' : $page.component === 'Users/Index'}"
                      class="hover:text-blue-900 underline"
                >Users
                </Link>
            </li>
            <li>
                <Link href="/settings"
                      :class="{'text-blue-900 no-underline' : $page.url.startsWith('/settings')}"
                      class="hover:text-blue-900 underline"
                >Settings
                </Link>
            </li>
            <li>
                <Link :href="route('logout')"
                      method="post" as="button"
                      class="hover:text-blue-900 underline"
                >Logout</Link></li>
            <li>
                <NavLink href="/" :active="$page.component === 'Home'" >Home</NavLink>
            </li>
        </ul>
    </nav>
</template>

<script setup>

import {Link} from "@inertiajs/inertia-vue3";
import NavLink from "../Shared/NavLink.vue"


</script>

<style scoped>

</style>
