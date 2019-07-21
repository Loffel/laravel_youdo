<template>
    <ul v-if="contact">
        <li v-for="message in messages" :class="`col-6 ${message.to_id == contact.id ? 'float-right text-right':'float-left text-left'}`" :key="message.id" style="clear:both">
            {{ message.text }}
        </li>
    </ul>
</template>

<script>
    export default {
        props: {
            contact: {
                type: Object
            },
            messages: {
                type: Array,
                required: true
            }
        }
    }
</script>