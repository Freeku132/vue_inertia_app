<template>

    <div>
        <header class="flex justify-end">
            <button
                v-if="supported"
                class=" bg-gray-300 rounded px-2"
                @click="copy"
             >
            {{copied ? 'Copied' : 'Copy'}}
            </button>
        </header>
    <pre>
        <code ref="block">
            {{code}}
        </code>
    </pre>
    </div>
</template>

<script setup>

import {onMounted, ref} from "vue";
import {highlightElement} from "@/Services/SyntaxHighlighting";
import {useClipboard} from '@/Composables/useClipboard';

let block = ref(null);


onMounted(() =>
    //highlight(),
    highlightElement(block.value),
);

let {copy, copied, supported} = useClipboard(props.code);
// let copied = ref(false)
// let copyToClipboard = () =>{
//     if( navigator && navigator.clipboard){
//     navigator.clipboard.writeText(props.code);
//
//     copied.value = true;
//
//     setTimeout( () => {
//         copied.value = false
//     }, 3000)
//         return;
//     }
//
//     alert('Browser error')
// };



let props = defineProps({
    code : String
})

</script>

<style scoped>

</style>
