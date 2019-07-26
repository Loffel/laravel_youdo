<template>
    <div class="message-content">
        <div class="messages-headline">
            <h4>{{contact ? contact.name : ''}}</h4>
            <a v-if="contact" href="#" class="message-action"><i class="icon-feather-trash-2"></i> Удалить диалог</a>
        </div>
        <MessagesHistory v-if="contact" :contact="contact" :messages="messages"/>
        <MessageComposer v-if="contact" @send="sendMessage"/>
    </div>
</template>

<script>
    import MessagesHistory from './MessagesHistory';
    import MessageComposer from './MessageComposer';

    export default {
        props: {
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type: Array,
                default: []
            }
        },
        methods: {
            sendMessage(text){
                if(!this.contact) return;

                axios.post('/messenger/conversation/send', {
                    contact_id: this.contact.id,
                    text: text
                }).then((response) => {
                    this.$emit('new', response.data);
                });
            }
        },
        components:{
            MessagesHistory,
            MessageComposer
        }
        
    }
</script>

