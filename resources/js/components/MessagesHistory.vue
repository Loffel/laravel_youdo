<template>
    <div class="message-content-inner" ref="history">			
        <div v-for="message in messages" :class="`message-bubble ${message.to_id == contact.id ? 'me':''}`" :key="message.id">
            <div class="message-bubble-inner">
                <div class="message-avatar"><img :src="contact.avatar" alt="" /></div>
                <div class="message-text"><p>{{ message.text }}</p></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</template>

<script>
import { setTimeout } from 'timers';
    export default {
        props: {
            contact: {
                type: Object
            },
            messages: {
                type: Array,
                required: true
            }
        },
        methods: {
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.history.scrollTop = this.$refs.history.scrollHeight - this.$refs.history.clientHeight;
                }, 50);
            }
        },
        watch: {
            contact(contact){
                this.scrollToBottom();
            },
            messages(messages){
                this.scrollToBottom();
            }
        }
    }
</script>