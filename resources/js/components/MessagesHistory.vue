<template>
    <div class="message-content-inner">			
        <div v-for="message in messages" :class="`message-bubble ${message.to_id == contact.id ? 'me':''}`" :key="message.id">
            <div class="message-bubble-inner">
                <div class="message-avatar"><img src="/images/user-avatar-placeholder.png" alt="" /></div>
                <div class="message-text"><p>{{ message.text }}</p></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
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